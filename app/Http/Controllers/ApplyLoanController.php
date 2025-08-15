<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRequest;
use App\Models\ApproveLoan;
use App\Models\CustomerAuth;
use App\Models\BankDetail;
use App\Models\TotalEmi;
use App\Util\AmountInWordsUtil;
use App\Util\TextReportPDFService;
use Carbon\Carbon;

use Validator;
use Str;
use Session;
use DB;

class ApplyLoanController extends Controller
{

    protected $textReportPDFService;

    public function __construct(TextReportPDFService $textReportPDFService)
    {
        $this->textReportPDFService = $textReportPDFService;
    }
    
    public function generateLoanNumber(){
        $loan_number = 'TRISH'.rand(1111111,9999999);
        $exist = LoanRequest::where('loan_request_number',$loan_number)->count();
        if($exist>0){
            $this->generateLoanNumber();
        }else{
            return $loan_number;
        }
    }

    public function applyloan(Request $request){
       
        $validator =Validator::make($request->all(),[
                'name'=> 'required',
                // 'email'=> 'email',
                // 'mobile'=> 'required|numeric|between:8,11',
                'mobile'=> 'required|numeric|unique:loan_requests,mobile',
                'loan_amount'=> 'required',
                'photo'=> 'required|mimes:jpg,jpeg,png',
                'adhar_card.*'=> 'required',
                'pan_card'=> 'required|mimes:jpg,jpeg,pdf',
                'bank_statement.*'=> 'required',
                'pan_number' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/|unique:loan_requests,pan_number',
                'aadhar_number' => 'required|string|unique:loan_requests,aadhar_number',


        ]);
        if($validator->fails()){
            return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        if(empty($request->bank_statement)){
            return back()->with(['message'=>'Please upload bank statement','alert-type'=>'error']);
        }
        if(empty($request->adhar_card)){
         return back()->with(['message'=>'Please upload Aadhar Image','alert-type'=>'error']);
        }
       

        $loanReq = new LoanRequest();
        $today = date('d-m-Y');
        $loanReq->loan_request_number = $this->generateLoanNumber();
        $loanReq->name = $request->name;
        $loanReq->email = $request->email;
        $loanReq->mobile = $request->mobile;
        $loanReq->loan_amount = $request->loan_amount;
        $loanReq->existing_loan = $request->existing_emi;
        $loanReq->request_date = date('Y-m-d');
        $loanReq->loan_status = "Pending";
        $loanReq->pan_number = strtoupper($request->pan_number);
        $loanReq->aadhar_number = $request->aadhar_number;

        if($request->photo){
            $filename ='IMG'.rand(11111,99999).'.'.$request->photo->extension();
            $request->photo->move(public_path('upload/photo'),$filename);
            $loanReq->photo = $filename;
        }

        if($request->adhar_card){
            // $filename ='ADHAR'.rand(11111,99999).'.'.$request->adhar_card->extension();
            // $request->adhar_card->move(public_path('upload/adhar_card'),$filename);
            $loanReq->adhar_card = addslashes(json_encode($request->input("adhar_card")));
        }
       
        if($request->pan_card){
            $filename ='PAN'.rand(11111,99999).'.'.$request->pan_card->extension();
            $request->pan_card->move(public_path('upload/pan_card'),$filename);
            $loanReq->pan_card = $filename;
        }
       
        if($request->bank_statement){
            // $filename ='STATEMENT'.rand(11111,99999).'.'.$request->bank_statement->extension();
            // $request->bank_statement->move(public_path('upload/bank_statement'),$filename);
            $loanReq->bank_statement = addslashes(json_encode($request->input("bank_statement")));
        }
        
        $loanReq->source = $request->source;
        $loanReq->distributor_id = $request->id;

        $res = $loanReq->save();
        if($res){

//            $Phno= $request->mobile;
//         $Msg=urlencode("आपके व्यक्तिगत ऋण का भुगतान 87878 को देय है। आपकी ईएमआई 7878 रुपये है। कृपया देरी शुल्क से बचने के लिए जल्दी भुगतान करें. अनदेखा करें, यदि पहले से ही भुगतान किया गया है। कृपया अपनी किस्त को नीचे दिए गए बैंक विवरणों में स्थानांतरित करें।Trishodaya Micro Association");
//         $Password='kitt4539KI';
//         $SenderID='TRISMA';
//         $UserID='trishyodayabiz';
//         $EntityID='1701168248526543905';
//         $TemplateID='1707168602725422231';

        
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
//   CURLOPT_HTTPHEADER => array(
//     'Authorization: SASASAs'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;
        
            return back()->with(['message'=>'applied successfully','alert-type'=>'success']);
        }
    }


    public function approved(Request $request){
        // dd($request->all());
        
       
        
        $loanReq =LoanRequest::where('loan_request_number',$request->loan_request_number)->first();
        $loan1 = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
        $customer = CustomerAuth::where('username',$loanReq->mobile)->first();
        // dd($customer);
        if($loanReq){

            //add custumer Auth
            // dd($request->reject_reason != null);
            if($request->reject_reason == null){
            if(!$customer){
                $password = trim(substr($loanReq->name, 0, 4)).rand(1111,9999);
            $customer = new CustomerAuth();
            $customer->costomer_name = $loanReq->name;
            $customer->loan_request_number = $loanReq->loan_request_number;
            $customer->username = $loanReq->mobile;
            $customer->password = $password;
            $res = $customer->save();
    
            }
        }

            // add aprove and reject 
            if($loan1){
            $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
            }else{
                $loan =new ApproveLoan();
            }
            $today = date('d-m-Y');
            $loan->loan_request_number = $loanReq->loan_request_number;
            $loan->status = $request->status;
            $loan->loan_duration = $request->loan_duration;
            $loan->approve_loan_amount = $request->loan_amount;
            $loan->interest = $request->rate_of_intrest;
            $loan->emi_amount = $request->emi_amount;
            $loan->processing_fees = $request->processing_fees;
            $loan->total_interest_charge = $request->total_interest_charge;
            $loan->other_charge = $request->other_charge;
            $loan->other_charge_reason = $request->other_charge_reason;
            $loan->approved_date = date('d-m-Y', strtotime($today));

            if($request->reject_reason){
                $loan->reject_reason =$request->reject_reason;
                
            }
            $res = $loan->save();
            if($res){
                $loanReq->loan_status = $request->status;
                $loanReq->save();

               
                return redirect('loanrequest')->with(['message'=>$request->status.' successfully !!','alert-type'=>"success"]);
            }
        }

       
    }

    private function getReportVariables(LoanRequest $loanReq)
    {
        $loan_request_number = $loanReq -> loan_request_number;

        $approveLoan = ApproveLoan::where('loan_request_number',$loan_request_number)->first();

        $bankDtail = BankDetail::where('loan_request_number',$loan_request_number)->first();

        $approvedAmountFloat = (float)$approveLoan->approve_loan_amount;

        return array(
            'user_id' => $loanReq -> mobile,
            'contact_number' => $loanReq -> mobile,
            'applyy_date' => $loanReq->request_date,
            'name' => $loanReq->name,
            'pan_number' => $loanReq->pan_number,
            'yearly_income' => $loanReq->family_income,
            'existing_loan' => $loanReq->existing_loan,
            'roi' => $approveLoan->interest,
            'loan_amount' => $approveLoan->approve_loan_amount,
            'parent_name' => $loanReq-> father_name,
            'address' => $loanReq -> present_address,
            'present_address' => $loanReq -> mobile,
            'loan_amount_w'=> AmountInWordsUtil::getIndianCurrency($approvedAmountFloat),
            'processing_fees'=> $approveLoan->processing_fees,
            'cheque_number' => $loanReq->cheque_no_received,
            'bank_name' => $bankDtail->bank_name,
            'witness_name1'=>$loanReq->witness_1,
            'witness_name2'=>$loanReq->witness_2,
            'witness_address1'=>$loanReq->witness_1_address,
            'witness_address2'=>$loanReq->witness_2_address,
            'witness_contact_number1'=>$loanReq->witness_1_contact_det,
            'witness_contact_number2'=>$loanReq->witness_2_contact_det,
            'witness_relation1'=>$loanReq->witness_1_relation,
            'witness_relation2'=>$loanReq->witness_2_relation,
            'total_charges'=>$approveLoan->processing_fees+$approveLoan->other_charge,
            'disbursed_amount'=>$approveLoan->approve_loan_amount-$approveLoan->processing_fees-$approveLoan->other_charge,
            'tenure'=>$approveLoan->loan_duration,
            'current_date'=>Carbon::now()->toDateString(),
            'other_charges'=>$approveLoan->other_charge,
            'emi_amount'=>$approveLoan->emi_amount,
            'interest'=>$approveLoan->total_interest_charge
        );
    }
    
    public function getbankDetail(Request $request){
        //dd($request->all());

        $validator = Validator::make($request->all(),[
            'bank_name' => 'required',
            'branch_name' => 'required',
            'ifscCode' => 'required',
            'account_number' => 'required',
            'witness_1' => 'nullable|string',
        ]);

        if($validator->fails()){
            return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
            ->withErrors($validator->errors())
            ->withInput($request->all());
        }
        // dd($request->all());
        $customer = CustomerAuth::where('username',Session::get('customer')->username)->first();
        if($customer){
        $bankDtail1 = BankDetail::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        if($bankDtail1){
        $bankDtail = BankDetail::where('loan_request_number',Session::get('customer')->loan_request_number)->first();

        }else{
            $bankDtail = new BankDetail();
        }
        $bankDtail->loan_request_number = Session::get('customer')->loan_request_number;
        $bankDtail->username = Session::get('customer')->username;
        $bankDtail->bank_name = $request->bank_name;
        $bankDtail->branch_name = $request->branch_name;
        $bankDtail->ifscCode = $request->ifscCode;
        $bankDtail->account_number = $request->account_number;

        $res= $bankDtail->save();
        if($res){
        $loanReq =LoanRequest::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
            $loanReq->user_status= "Accepted";

            $loanReq->father_name= $request->father_name;
            $loanReq->mother_name= $request->mother_name;
            $loanReq->alternate_mobile= $request->alternate_mobile;
            $loanReq->profession= $request->profession;
            $loanReq->reason= $request->reason;
            $loanReq->employer_company_name= $request->employer_company_name;
            $loanReq->salary= $request->salary;
            $loanReq->spause= $request->spause;
            $loanReq->present_address= $request->present_address;
            $loanReq->pincode= $request->pincode;
            $loanReq->permanent_address= $request->permanent_address;
            
            $loanReq->witness_1= $request->witness_1;
            $loanReq->witness_1_contact_det= $request->witness_1_contact_det;
            $loanReq->witness_1_address= $request->witness_1_address;
            $loanReq->witness_1_relation= $request->witness_1_relation;

            $loanReq->witness_2= $request->witness_2;
            $loanReq->witness_2_contact_det= $request->witness_2_contact_det;
            $loanReq->witness_2_address= $request->witness_2_address;
            $loanReq->witness_2_relation= $request->witness_2_relation;

            $loanReq->qualification= $request->qualification;
            $loanReq->cheque_no_received= $request->cheque_no_received;
            $loanReq->no_of_years_in_present_Job= $request->no_of_years_in_present_Job;
            $loanReq->no_of_employee_in_company= $request->no_of_employee_in_company;
            $loanReq->family_income= $request->family_income;
            $loanReq->other_loan_details= $request->other_loan_details;
            $loanReq->rent_paid= $request->rent_paid;
            
            $report_code = 'TERMS_AND_CONDITION';
            $language_code = 'H'; //Default later will add option in Loan req screen.

            $report_variables = $this->getReportVariables($loanReq);

            $file_name = trim(substr($loanReq->name,0,4)).time().'TNC'.rand(1,100).'.pdf';
            //dd('File name is :::'.$file_name);
            $status = $this->textReportPDFService->generatePDF($report_code,$language_code,$report_variables,$file_name);
            
            if($status == 'SUCCESS')
            {
                $loanReq->term_and_condition = $file_name;
            }

            //return 'File :'.$status." Generated Successfully";
           
            $loanReq->save();
            return redirect('user-dashboard')->with('success',"Your application has been submitted successfully");
        }
    }

    }

    
    public function applyNow(Request $request){
        $bankDtail = BankDetail::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        
        return redirect('bank-detail');
        
    }
    
    public function bankDetail(Request $request){
        $bankDtail = BankDetail::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.applynow',['bankDtail'=>$bankDtail]);
        
            }
            elseif(Session::has('language') && Session::get('language')=="en"){
                return view('front.applynow',['bankDtail'=>$bankDtail]);
           
            }
            else{
                return view('front.applynow',['bankDtail'=>$bankDtail]);
        
                }
    }

    public function findIfsc(Request $request){
        $json = @file_get_contents(
            "https://ifsc.razorpay.com/".$request->ifscCode);
        $arr = json_decode($json);
        if(isset($arr->BRANCH)){
            return response()->json($arr);

        }else{
            return response()->json('Invalid IFSC Code');
        }
    }


    public function approvedloan(Request $request){
        // dd (( ($request->loan_amount/100)*$request->rate_of_intrest)+$request->processing_fees+$request->loan_amount);
// dd((($request->loan_amount/$request->loan_duration)/100)*$request->rate_of_intrest);
        $validator =Validator::make($request->all(),[
         
            'transection_id'=> 'required|unique:approve_loans,transaction_id',
          
    ]);
    if($validator->fails()){
        return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
        ->withInput($request->all())
        ->withErrors($validator->errors());
    }

        $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
       
        // $loan->status = $request->status;
        $loan->loan_duration = $request->loan_duration;
        $loan->approve_loan_amount = $request->loan_amount;

        $loan->principal_loan_amount = $request->loan_amount;
        $loan->total_intrest = ($request->loan_amount/100)*$request->rate_of_intrest; 
        $loan->interest =  $request->rate_of_intrest;
        $loan->emi_amount = $request->emi_amount;
        $loan->processing_fees = $request->processing_fees;
        $loan->first_emi_date = $request->EMI_date;
        $loan->next_emi_date = $request->EMI_date;
        $loan->transaction_id = $request->transection_id;
        $loan->total_payble_amount = ($request->emi_amount*$request->loan_duration);
        $loan->total_payble_due_amount = ($request->emi_amount*$request->loan_duration);
        // $loan->total_payble_amount =( ($request->loan_amount/100)*$request->rate_of_intrest)+$request->processing_fees+$request->loan_amount;
        // $loan->total_payble_due_amount =( ($request->loan_amount/100)*$request->rate_of_intrest)+$request->processing_fees+$request->loan_amount;
        $loan->due_emi = $request->loan_duration;
        $loan->loan_trasnfer_date = date('d-m-Y');
        $loan->procces_status_btn = "Processed";
        $res =$loan->save();
        if($res){

            $user = \DB::table('customer_auths')->where('loan_request_number',$request->loan_request_number)->first();
            for($i=0; $i < intval($request->loan_duration);$i++){
                $create_emi = new TotalEmi();
                $create_emi->loan_request_number = $request->loan_request_number;
                $create_emi->username = $user?$user->username:'';
                $create_emi->emi_due_date =  (((new Carbon($request->EMI_date))->addMonths($i)))->toDateString();
                $create_emi->emi_amount = $request->emi_amount;
                $create_emi->intrest = (($request->loan_amount/$request->loan_duration)/100)*$request->rate_of_intrest;
                $create_emi->paid_amount = 0;
                $create_emi->late_fees = 0;
                $create_emi->due_amount = $request->emi_amount;
                $create_emi->rate_of_intrest = $request->rate_of_intrest;
                $create_emi->payment_status = 'Upcoming';
                $create_emi->save();
            }

            // $loanReq =LoanRequest::where('loan_request_number',$request->loan_request_number)->first();
            // $loanReq->loan_status= $request->status;
            // $loanReq->save();
            return redirect('loan-approved')->with('success','Processed successfully !!');
        }
    }

    public function customerpaidEmi(Request $request){
        dd($request->all());
    }

    public function filterdata(Request $request){
        $loan =DB::table('loan_requests')
        ->leftjoin('approve_loans', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')
        ->leftjoin('bank_details', 'loan_requests.loan_request_number', '=', 'bank_details.loan_request_number')
        ->leftjoin('customer_auths', 'loan_requests.loan_request_number', '=', 'customer_auths.loan_request_number')
        ->select('loan_requests.id as Loanid','loan_requests.loan_request_number as loan__request_number','loan_requests.*','approve_loans.*'
        ,'approve_loans.*','bank_details.*','customer_auths.*'
        )
      
        ->where('loan_requests.loan_status',$request->status)->get();

        if($request->status == null){
            $loan =DB::table('loan_requests')
        ->leftjoin('approve_loans', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')
        ->leftjoin('bank_details', 'loan_requests.loan_request_number', '=', 'bank_details.loan_request_number')
        ->leftjoin('customer_auths', 'loan_requests.loan_request_number', '=', 'customer_auths.loan_request_number')
        ->select('loan_requests.id as Loanid','loan_requests.loan_request_number as loan__request_number','loan_requests.*','approve_loans.*'
        ,'approve_loans.*','bank_details.*','customer_auths.*'
        )->get();
        }
        // dd($loan);
       return response()->json($loan);
    }

    public function filterdatabydate(Request $request){
        $loan =DB::table('loan_requests')
        ->leftjoin('approve_loans', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')
        ->leftjoin('bank_details', 'loan_requests.loan_request_number', '=', 'bank_details.loan_request_number')
        ->leftjoin('customer_auths', 'loan_requests.loan_request_number', '=', 'customer_auths.loan_request_number')
        ->select('loan_requests.id as Loanid','loan_requests.loan_request_number as loan__request_number','loan_requests.*','approve_loans.*'
        ,'approve_loans.*','bank_details.*','customer_auths.*'
        )
      
        ->where('loan_requests.created_at','>=',$request->start_date)->where('loan_requests.created_at','<=',$request->end_date)->get();
        // dd($loan);
       return response()->json($loan);
    }

    public function uploadPDF(Request $req){
        
        $filename ='STATEMENT'.rand(11111,99999).'.'.$req->file->extension();
        $req->file->move(public_path('/bankstatement'),$filename);
        return '/bankstatement/'.$filename;
    }
    public function uploadImage(Request $req){
        
        $filename ='aadhar'.rand(11111,99999).'.'.$req->file->extension();
        $req->file->move(public_path('/aadhar'),$filename);
        return '/aadhar/'.$filename;
    }
    public function bankDupdate(Request $req){
        $update = LoanRequest::where('id',$req->id)->first();
        $update->father_name = $req->father_name;
        $update->mother_name = $req->mother_name;
        $update->alternate_mobile = $req->alternate_mobile;
        $update->profession = $req->profession;
        $update->reason = $req->reason;
        $update->employer_company_name = $req->employer_company_name;
        $update->salary = $req->salary;
        $update->spause = $req->spause;
        $update->present_address = $req->present_address;
        $update->pincode = $req->pincode;
        $update->permanent_address = $req->permanent_address;
        $update->witness_1   = $req->witness_1;
        $update->witness_1_contact_det   = $req->witness_1_contact_det;
        $update->witness_1_address   = $req->witness_1_address;
        $update->witness_1_relation  = $req->witness_1_relation;

        $update->witness_2 = $req->witness_2;
        $update->witness_2_contact_det = $req->witness_2_contact_det;
        $update->witness_2_address = $req->witness_2_address;
        $update->witness_2_relation = $req->witness_2_relation;

        $update->qualification = $req->qualification;
        $update->cheque_no_received = $req->cheque_no_received;
        $update->no_of_years_in_present_Job = $req->no_of_years_in_present_Job;
        $update->no_of_employee_in_company = $req->no_of_employee_in_company;
        $update->family_income = $req->family_income;
        $update->other_loan_details = $req->other_loan_details;
        $update->rent_paid = $req->rent_paid;

        $update->save();
        return back()->with('success','Bank Details update successfully !!');
    }




    public function uploadTermNCondition(Request $request){
        // dd($request->all());
        // $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
        $loan = LoanRequest::where('loan_request_number',$request->loan_request_number)->first();

        if($loan && $request->has('term_and_condition')){
            if(\File::exists(public_path('upload/tNc/'.$loan->term_and_condition))){
                \File::delete(public_path('upload/tNc/'.$loan->term_and_condition));
            }
            $filename = trim(substr($loan->name,0,4)).time().'TNC'.rand(1,100).'.'.$request->term_and_condition->extension();
            $request->term_and_condition->move(public_path('upload/tNc'),$filename);
            $loan->term_and_condition = $filename;
            $res = $loan->save();
            if($res){
                return back()->with('success','Updated successfully !!');
            }
        }


    }

            public function userAcceptTNc(Request $request){
                $validator = Validator::make($request->all(),[
                    'term_and_condition' =>'required',
                ],
                [
                    'term_and_condition.required' =>'Please Accept Term And Condition',
                ] );
                if($validator->fails()){
                    return back()->with('error',$validator->errors()->first());
                }
                 

                $loan_request_number = Session::get('customer')->loan_request_number;
               
                 $loan = LoanRequest::where('loan_request_number',$loan_request_number)->first(); 
                 if($loan && $request->term_and_condition != ""){ 
                     $loan->user_accept_t_N_c = "Accepted";
                     $res =  $loan->save();
                     if($res){
                        return back()->with('success','– Your application processed successfully. Loan details will reflect post review of application and further verification.');
                     }
                 }else{
                    return back()->with('error','something went wrong. please Again !');

                 }
            }



}
