<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmiDetail;
use App\Models\ApproveLoan  ;
use App\Models\TotalEmi ;
use Session;
use Carbon\Carbon;
use Validator;
class EmiPayController extends Controller
{
    public function customerpaidEmi(Request $request){
        dd($request->all());
        // var_dump(Carbon::now());
        $transaction_id ="TYGFG".rand(1111,9999);
        $emiDetail1 =  EmiDetail::where('transaction_id',$transaction_id)->count();
        if($emiDetail1>0){
            $transaction_id ="TYGFG".rand(1111,9999);
        }
        
        $emiDetail = new EmiDetail();
        $emiDetail->loan_request_number = Session::get('customer')->loan_request_number;
        $emiDetail->username = Session::get('customer')->username;
        $emiDetail->transaction_id = $transaction_id;
        $emiDetail->transaction_date = date('d-m-Y');
        $emiDetail->emi_amount = $request->emi_amount;
        $emiDetail->paid_amount = $request->payble_amount;
        $emiDetail->interest_amount = $request->intrest_amount;
        $emiDetail->late_charge = $request->late_fees;
        $dates =$request->next_emi_date;
        $new_date =(((new Carbon($request->current_emi_date))->addMonths(1)));
        // dd($new_date->toDateString());
       
        $emiDetail->next_emi_date = $new_date->toDateString();
        $emiDetail->pay_amount = $request->payble_amount;
        // $emiDetail->due_amount = $request->transaction_id;
        $emiDetail->status = "Success";

        $res = $emiDetail->save();
        if($res){

            $total_emi = TotalEmi::where('id',$request->emi_id)->first();
            $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount);
            $total_emi->late_fees = intval($request->late_fees) + intval($total_emi->late_fees);
            $total_emi->due_amount = $request->total_payble_amount ? intval($request->total_payble_amount) - intval($request->payble_amount) :'0';
            $total_emi->payment_status =$request->decreement_emi=='1'?'Paid':'Pending';
            // $total_emi->emi_due_date =$new_date->toDateString();
            $res = $total_emi->save();


        $loan = ApproveLoan::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        // dd($loan);
        $loan->total_payble_due_amount = ($loan->total_payble_due_amount-$request->emi_amount) - $request->intrest_amount;
        $loan->total_receve_late_charge = $loan->total_receve_late_charge + $request->late_fees;
        $loan->next_emi_date = $new_date;
        $loan->due_emi = $loan->due_emi-$request->decreement_emi;

        if((intval($loan->due_emi) - intval($request->decreement_emi)) < 1){
        $loan->payment_status = "Final Paid";
        
        }else{
            $loan->payment_status = "Paid";
        }
        
        $res1 =$loan->save();
        if($res1){
            return redirect('user-dashboard')->with('success','Your Emi paid successfully !!');
        }

        }

    }

    public function adminpaidEmi(Request $request){
        // dd($request->all());
       
        $validate = Validator::make($request->all(),[
            'transaction_id' => 'required|unique:emi_details,transaction_id',
            'transaction_date' => 'required',
        ]);
        if($validate->fails()){
            return back()->with('error' ,$validate->errors()->first())
            ->WithInput($request->all())
            ->withErrors($validate->errors());
        }

        $emiDetail = new EmiDetail();
        $emiDetail->loan_request_number = $request->loan_request_number;
        $emiDetail->username = $request->username;
        $emiDetail->transaction_id = $request->transaction_id;
        $emiDetail->transaction_date = $request->transaction_date;
        $emiDetail->emi_amount = $request->emi_amount;
        $emiDetail->interest_amount = $request->Intrest;
        $emiDetail->late_charge = $request->late_fees;
        $emiDetail->other_charge = $request->other_charge;
        $emiDetail->total_emi = 1;
        $emiDetail->emi_id = $request->emi_id;
        $emiDetail->extra_intrest_amount = $request->Intrest;

        $dates =$request->next_emi_date;
        $new_date =(((new Carbon($request->current_emi_date))->addMonths(intval($request->decreement_emi))));
        // dd($new_date->toDateString());
       
        $emiDetail->next_emi_date = $new_date->toDateString();
        $emiDetail->pay_amount = $request->payble_amount;
        // $emiDetail->due_amount = $request->transaction_id;
        $emiDetail->status = "Success";

        $res = $emiDetail->save();
        if($res){

            $total_emi = TotalEmi::where('id',$request->emi_id)->first();
            $count_payment1  = $total_emi->count_payment;
            $due_amount1  = $total_emi->due_amount;

            $total_emi->count_payment = $total_emi->count_payment+1;
            $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount);
            $total_emi->late_fees = intval($request->late_fees) + intval($total_emi->late_fees);
            $total_emi->due_amount =intval($due_amount1) - intval($request->emi_amount);
            $total_emi->payment_status =( intval($due_amount1) - intval($request->emi_amount) ) <=0 ?'Paid':'Pending';
            $total_emi->extra_intrest_amount =$request->Intrest;
            $res = $total_emi->save();
            
        $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
        // dd($loan);
        $total_due_amount = $loan->due_emi;
            
            if($count_payment1 > 0){

            $loan->total_payble_due_amount = ($loan->total_payble_due_amount - $due_amount1) + (intval($request->total_payble_amount) - intval($request->payble_amount));

            }else{

                $loan->total_payble_due_amount = ($loan->total_payble_due_amount-$request->emi_amount) + (intval($request->total_payble_amount) - intval($request->payble_amount));
            }
            // $loan->total_payble_due_amount = (($total_emi->due_amount - $request->emi_amount) - $request->Intrest) + (intval($request->total_payble_amount) - intval($request->payble_amount));
      
        $loan->total_receve_late_charge = $loan->total_receve_late_charge + $request->late_fees;
        $loan->total_receved_extra_intrest_amount = $loan->total_receved_extra_intrest_amount + $request->Intrest;
        // $loan->next_emi_date = $new_date->toDateString();
        $loan->due_emi = ( intval($due_amount1) - intval($request->emi_amount) ) <=0? intval($loan->due_emi) - 1:intval($loan->due_emi) - 0;

        if(intval($due_amount1) - intval($request->emi_amount) <=0){

        $loan->payment_status =  $total_due_amount >1?'Paid':'Final Paid';  
        
        }else{  
            $loan->payment_status ='Pending'; 
        }
        $res1 =$loan->save();
        if($res1){
            return back()->with('success','Your Emi paid successfully !!');
        }

        }

    }


    // customer pay all due payment

    public function customerPayTotalDueEmi(Request $request){
        // dd($request->all());
        // dd(floatval($request->total_emi_due_amount) +floatval($request->total_intrest_amount) + floatval($request->total_late_fees)+ floatval($request->total_other_charge));
        $total_pay_emi =0;
        if(count($request->emi_id)>0){
            for($i=0; $i < count($request->emi_id); $i++){

                
                $dates =$request->next_emi_date[$i];
                $new_date =(((new Carbon($request->current_emi_date[$i]))->addMonths(1)));
                // dd($new_date->toDateString());
                
                
                    $total_emi = TotalEmi::where('id',$request->emi_id[$i])->first();
                    $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount[$i]);
                    $total_emi->late_fees = intval($request->late_fees[$i]) + intval($total_emi->late_fees);
                    $total_emi->due_amount = $request->total_payble_amount[$i] ? intval($request->total_payble_amount[$i]) - intval($request->payble_amount[$i]) :'0';
                    $total_emi->payment_status =$request->decreement_emi[$i]=='1'?'Paid':'Pending';
                    $total_emi->extra_intrest_amount =$request->intrest_amount[$i];
                    $res = $total_emi->save();
        
        
                        $loan = ApproveLoan::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
                        $total_due_amount = $loan->due_emi;
                        // dd($total_due_amount);
                        $loan->total_payble_due_amount = ($loan->total_payble_due_amount-$request->emi_amount[$i]);
                        $loan->total_receve_late_charge = $loan->total_receve_late_charge + $request->late_fees[$i];
                        $loan->next_emi_date = $new_date;
                        $loan->due_emi = $loan->due_emi-$request->decreement_emi[$i];
                        $loan->total_receved_extra_intrest_amount = $loan->total_receved_extra_intrest_amount + $request->intrest_amount[$i];
                
                        if((intval($total_due_amount) - intval($request->decreement_emi[$i])) < 1){
                        $loan->payment_status = "Final Paid"; 
                     }else{
                      $loan->payment_status = "Paid";
                       }
                
                $res1 =$loan->save();
                if($res1){
                    $total_pay_emi = $total_pay_emi+1;
                    // return redirect('user-dashboard')->with('success','Your Emi paid successfully !!');
                }
        
                

            }
            if($total_pay_emi==count($request->emi_id)){

                $transaction_id ="TYGFG".rand(1111,9999);
                $emiDetail1 =  EmiDetail::where('transaction_id',$transaction_id)->count();
                if($emiDetail1>0){
                    $transaction_id ="TYGFG".rand(1111,9999);
                }

                $emiDetail = new EmiDetail();
                $emiDetail->loan_request_number = Session::get('customer')->loan_request_number;
                $emiDetail->username = Session::get('customer')->username;
                $emiDetail->transaction_id = $transaction_id;
                $emiDetail->transaction_date = date('d-m-Y');
                $emiDetail->emi_amount = $request->total_emi_due_amount;
                $emiDetail->paid_amount = floatval($request->total_emi_due_amount) +floatval($request->total_intrest_amount) + floatval($request->total_late_fees)+ floatval($request->total_other_charge);
                $emiDetail->interest_amount = $request->total_intrest_amount;
                $emiDetail->late_charge = $request->total_late_fees;
                $emiDetail->other_charge = $request->total_other_charge;
                $emiDetail->total_emi = count($request->emi_id);
                $emiDetail->emi_id = implode(',',$request->emi_id);
                $emiDetail->pay_amount = floatval($request->total_emi_due_amount) + floatval($request->total_intrest_amount) + floatval($request->total_late_fees)+floatval($request->total_other_charge);
                $emiDetail->extra_intrest_amount =$request->total_intrest_amount;
                $emiDetail->status = "Success";
                $res = $emiDetail->save();
                    return redirect('user-dashboard')->with('success','Your Emi paid successfully !!');

            }

        }else{
        return redirect('user-dashboard'); 
    }
}


public function addChargeInEmi(Request $request){
    $total_emi = TotalEmi::where('id',$request->emi_id)->first();
    $total_emi->other_charge_reason =$request->fees_reson;
    $total_emi->other_charge_amount =$request->fees_amount;
    $res = $total_emi->save();

    if($res){
        return back()->with('success','Added');
    }

}



}
