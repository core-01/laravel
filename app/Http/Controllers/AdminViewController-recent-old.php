<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRequest;
use App\Models\Distributor; 
use App\Models\BankDetail; 
use App\Models\ApproveLoan; 
use App\Models\TotalEmi; 
use App\Models\EmiDetail; 
   use App\Models\CustomerAuth; 
    use Carbon\Carbon;
use Session;


class AdminViewController extends Controller
{

   

    public function emiTransactionHistory(Request $request){

        $select_type ="Mobile";
        $fillter_value ="";
        $end_date ="";
        if($request->fillter_value){
            if($request->fillter_by == "Mobile"){

            $exists =EmiDetail::where('username',$request->fillter_value)->latest()->get();
            if(count($exists) <= 0){
                return back()->with('failed','Record Not Found !')
                ->withInput($request->all());
            }
        }
        }


        $payment_history = EmiDetail::latest()->paginate(20);
        if($request->fillter_value){
            if($request->fillter_by == "Mobile"){

                $payment_history = EmiDetail::where('username',$request->fillter_value)->latest()->paginate(20);
                $select_type ="Mobile";
                $fillter_value = $request->fillter_value;
            }else if($request->fillter_by == "Transaction Id"){
                $payment_history = EmiDetail::where('transaction_id',$request->fillter_value)->latest()->paginate(20);
                $select_type ="transaction_id";
                $fillter_value = $request->fillter_value;


            }else if($request->fillter_by == "Date"){
                // $payment_history = EmiDetail::where('transaction_date',date('Y-m-d',strtotime($request->fillter_value)))->latest()->paginate(20);
                $payment_history = EmiDetail::whereBetween('transaction_date',[date('Y-m-d',strtotime($request->fillter_value)),date('Y-m-d',strtotime($request->end_date))])->latest()->paginate(20);
                $select_type ="date";
                $fillter_value = $request->fillter_value;
                $end_date = $request->end_date;


            }else if($request->fillter_by == "Name"){
                $user = \DB::table('customer_auths')->where('costomer_name','like',$request->fillter_value.'%')->select('loan_request_number')->get();
                $loan_request_numbers =array();
                if(count($user)>0){
                    foreach($user as $user_id){
                        $loan_request_numbers[] =$user_id->loan_request_number;
                    }
                    $payment_history = EmiDetail::whereRaw('FIND_IN_SET(?,loan_request_number)',$loan_request_numbers)->latest()->paginate(20);
                }else{
                    $payment_history =array();
                }

                // $payment_history = EmiDetail::where('transaction_date',date('Y-m-d',strtotime($request->fillter_value)))->latest()->paginate(20);
                // $payment_history = EmiDetail::whereBetween('transaction_date',[date('Y-m-d',strtotime($request->fillter_value)),date('Y-m-d',strtotime($request->end_date))])->latest()->paginate(20);
                $select_type ="Name";
                $fillter_value = $request->fillter_value;
                $end_date = $request->end_date;


            }
            // dd($payment_history);


        }
        return view('admin.transaction-history',compact('payment_history','select_type','fillter_value','end_date'));
    }
    public function adminLogin(){
        if(Session::has('admin')){
            return redirect('admin-dashboard');
        }
        return view('admin.index');
    }

    public function changePassword(){
        return view('admin.change-password');
    }

  

    public function adminDashboard(){

        $emidata1 = TotalEmi::where('payment_status','Upcoming')->orwhere('payment_status','Pending')->get();
        // dd(count($emidata1));
         foreach ($emidata1 as $item){
                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(20)));
                                     
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));
                                     
                                     $status = ($item->emi_due_date >= $todaydate && $item->emi_due_date <= $add_day->toDateString() || $item->emi_due_date < $add_day );
                                     if($status){
                                        // dd($item->id,$status,$item->emi_due_date < $add_day->toDateString());
                                        $emidata1 = TotalEmi::where('id',$item->id)->update(['payment_status'=>'Pending']);
                                        
                                   
                                    }
         }

       $approvedData = ApproveLoan::where('due_emi','>' ,0)->get();
       foreach($approvedData as $apData){
        $pendingEmi = TotalEmi::where(['loan_request_number'=>$apData->loan_request_number,'payment_status'=>'Pending'])->get();
        if(count($pendingEmi)>0){
            $apData->payment_status ="Pending";
            $apData->save();
        }else{
             $apData->payment_status ="Paid";
            $apData->save();
        }
       }





        return view('admin.dashboard');
    }
    
    public function loanrequest(){
        $loanReq = LoanRequest::orderBy('id', 'DESC')->paginate(20);
        $bankDetail = BankDetail::all();
        // $bankDetail->loan_request_number
        // dd()
        return view('admin.loanrequest',['loanReq'=>$loanReq,'bankDetail'=>$bankDetail]);
    }

    public function loanAproved(){
        $loanReq = LoanRequest::where('user_status','Accepted')->orderBy('id', 'DESC')->paginate(20);
        $bankDetail = BankDetail::all();
        // $bankDetail->loan_request_number
        // dd()
        return view('admin.approveLoan',['loanReq'=>$loanReq,'bankDetail'=>$bankDetail]);
    }
    public function viewAndPayEMI(Request $request){
        $emi=array();
        if($request->mobile){

            $emi =TotalEmi::where('username',$request->mobile)->get();
            if(count($emi) <= 0){
                return back()->with('failed','Record Not Found !')
                ->withInput($request->all());
            }
        }
        
        return view('admin.view-and-pay-emi',compact('emi'));
    }

    public function distributor(){
        $distributor =  Distributor::orderBy('id', 'DESC')->paginate(20);

        return view('admin.distributor',['distributor'=>$distributor]);
    }

    public function viewFile(Request $request){
        return view('admin.viewFile',['image'=>$request->id]);
    }

    public function ApprovedLoan($id){
        $loan = ApproveLoan::where('loan_request_number',$id)->first();
        return view('admin.approved-loan',['loan'=>$loan]);
    }
    public function emiDetails(){
        $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->get();
        
        return view('admin.customer-emi-detail',['emidata'=>$emidata]);
    }

    public function dueEmi(){
    
         
          $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('approve_loans.payment_status','Pending')->paginate(20);
        //  dd($emidata);
        return view('admin.due-emi',['dueEmidata'=>$emidata]);
    }

    public function paidEmi(){
       
         
        $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('approve_loans.payment_status','Paid')->paginate(20);
        // $emidata = \DB::table('approve_loans')->where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('approve_loans.payment_status','Paid')->select('approve_loans.*','loan_requests.*')->paginate(20);
        
        return view('admin.paid-emi',['paidEmidata'=>$emidata]);
    }
    
     public function addExcelFile(){
        return view('admin.add-excel-file');
    }
    public function addExcalEmi(){
        return view('admin.add-excal-emi');
        
    }

    public function viewAndPay($loan_request_number){
        $emi =TotalEmi::where(['loan_request_number'=>base64_decode($loan_request_number),'payment_status'=>'Pending'])->get();
        // dd(count($emi)>0);
        return view('admin.view-and-pay-emi',compact('emi'));
    }


    public function getStatement(Request $request){
        $loanReq = \DB::table('loan_requests')->where('loan_request_number',$request->id)->first();
        $statement = json_decode(stripslashes($loanReq->bank_statement));
        $adharCard = json_decode(stripslashes($loanReq->adhar_card));
        // dd($statement);

        return response()->json(['statement'=>$statement,'adhar'=>$adharCard]);
    }

   
   public function queries(){
    $query = \DB::table('contacts')->latest()->paginate(20);
    return view('admin.query',compact('query'));
   }

   public function deleteQuery($id){
    $query = \DB::table('contacts')->where('id',base64_decode($id))->first();
    if($query){
        $res = \DB::table('contacts')->where('id',base64_decode($id))->delete();
        if($res){
            return back()->with('success','Deleted Successfully!');
        }
    }else{
        return back()->with('error','Somthing went Wrong.');
    } 
   }

}
