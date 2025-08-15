<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmiDetail;
use App\Models\ApproveLoan  ;
use App\Models\TotalEmi ;
use App\Models\GenrateEmi;
use Session;
use Carbon\Carbon;
use Validator;
class EmiPayController extends Controller
{
    

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
            $intrest = $total_emi->intrest;

            $unpaid_intrest = $intrest- $total_emi->paid_intrest;
            if($request->emi_amount <= $unpaid_intrest){
                $total_emi->paid_intrest = $total_emi->paid_intrest + $request->emi_amount;
                $paid_emi_amount = 0;
            }else if($request->emi_amount > $unpaid_intrest){
                $total_emi->paid_intrest =$total_emi->paid_intrest + $unpaid_intrest;
                $paid_emi_amount = $request->emi_amount-$unpaid_intrest;
            }

            $total_emi->count_payment = $total_emi->count_payment+1;
            $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount);
            $total_emi->late_fees = intval($request->late_fees) + intval($total_emi->late_fees);
            $total_emi->due_amount =intval($due_amount1) - intval($request->emi_amount);
            $total_emi->payment_status =( intval($due_amount1) - intval($request->emi_amount) ) <=0 ?'Paid':'Pending';
            $total_emi->extra_intrest_amount =$request->Intrest;
            $res = $total_emi->save();
            
        $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
        // dd($loan);

        
        $one_month_principal_amount = $loan->principal_loan_amount/$loan->loan_duration;
          $one_month_intrest = (($loan->principal_loan_amount/$loan->loan_duration)/100)*$loan->intrest;
            
                  
                     $loan->principal_loan_amount = ($loan->principal_loan_amount - $paid_emi_amount);
 

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
        $validate = Validator::make($request->all(),[
            // 'transaction_id' => 'required|unique:emi_details,transaction_id',
            // 'transaction_date' => 'required',
        ]);
        if($validate->fails()){
            return back()->with('error' ,$validate->errors()->first())
            ->WithInput($request->all())
            ->withErrors($validate->errors());
        }

            $emi = TotalEmi::where('username',Session::get('customer')->username)->first();
 
        $transaction_id = 'TRA'.rand(1111111,999999).'ID'.rand(1111,9999);
        $emiDetail = new EmiDetail();
        $emiDetail->loan_request_number = $emi->loan_request_number;
        $emiDetail->username = $emi->username;
        $emiDetail->transaction_id = $transaction_id;
        $emiDetail->transaction_date = date('Y-m-d');
        $emiDetail->emi_amount = $request->emi_amount;
        $emiDetail->interest_amount = $request->Intrest;
        $emiDetail->late_charge = $request->late_fees;
        $emiDetail->other_charge = $request->other_charge;
        $emiDetail->total_emi = $request->total_emi;
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
        // dd($emiDetail);
        if($res){ 

            $total_emi = GenrateEmi::where('id',$request->emi_id)->first();

            if(date('Y-m-d') > $total_emi->emi_due_date){
                $latePay = 1;
            }else{
                $latePay = 0; 
            }

            $count_payment1  = $total_emi->count_payment;
            $due_amount1  = $total_emi->due_amount;
            $intrest = $total_emi->intrest;

             $total_emi->paid_intrest = $total_emi->paid_intrest + $request->Intrest; 

            $total_emi->count_payment = $total_emi->count_payment + 1;
            $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount);
            $total_emi->late_fees =  intval($total_emi->late_fees) - intval($request->late_fees);
            $total_emi->due_amount =intval($due_amount1) - intval($request->payble_amount- $request->other_charge );
            $total_emi->other_charge_amount = intval($total_emi->other_charge_amount)- intval($request->other_charge ); 

            $total_emi->late_pay = $latePay;
            $total_emi->payment_status = 'Pending';
            $total_emi->extra_intrest_amount = $total_emi->extra_intrest_amount + $request->Intrest;
            $res = $total_emi->save();


            $currentPayEmi = GenrateEmi::where('id',$request->emi_id)->first();
 
            if($total_emi->due_amount < 1){
                $loan = ApproveLoan::where(['loan_request_number'=>$currentPayEmi ->loan_request_number])->first();
                $loan->due_emi =  $loan->due_emi-  $total_emi->total_emi;
                $loan->total_payble_due_amount =  floatval($loan->total_payble_due_amount) - floatval($loan->emi_amount*$total_emi->total_emi);
                $loan->payment_status =  'Paid';
                $loan->save();


                 $appPendingEmi = GenrateEmi::where(['loan_request_number'=>$currentPayEmi->loan_request_number])->get();
                if(count($appPendingEmi)){
                    foreach($appPendingEmi as $emiItem){ 
                        $emiItem->payment_status ="Paid";
                        $emiItem->due_amount =0;
                        // $emiItem->intrest ==0;
                        // $emiItem->late_fees ==0;
                        $emiItem->save(); 
                    }
                }

                $TotalEmi = TotalEmi::where(['loan_request_number'=>$currentPayEmi ->loan_request_number,'emi_generated'=>1])->get();
                if(count($TotalEmi)){
                    foreach($TotalEmi as $emiItem){ 
                        $emiItem->payment_status ="Paid";
                        $emiItem->save();
                    }
                } 

                // dd($TotalEmi);

            }
             
            return back()->with('success','Your Emi paid successfully !!');
       
        }

}


public function addChargeInEmi(Request $request){
    $total_emi = GenrateEmi::where('id',$request->emi_id)->first();
    $total_emi->other_charge_reason =$request->fees_reson;
    $total_emi->other_charge_amount =$request->fees_amount;
    $total_emi->due_other_charge =$request->fees_amount;
    $res = $total_emi->save();

    if($res){
        return back()->with('success','Added');
    }

}




            public function adminpaidEmi1(Request $request){
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

                if($request->payble_amount < 0){
                    return back()->with('error','something went wrong');
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

                    $total_emi = GenrateEmi::where('id',$request->emi_id)->first();
                    
                    if(date('Y-m-d') > $total_emi->emi_due_date){
                        $latePay = 1;
                    }else{
                        $latePay = 0; 
                    } 

                    $count_payment1  = $total_emi->count_payment;
                    $due_amount1  = $total_emi->due_amount;
                    $intrest = $total_emi->intrest; 
                    $paid_intrest = $total_emi->paid_intrest;
                    $total_due_late_fees = $total_emi->due_late_fees; 

                    $total_emi->paid_intrest = $total_emi->paid_intrest + $request->Intrest;  

                    $total_emi->count_payment = $total_emi->count_payment+1;
                    $total_emi->paid_amount =intval($total_emi->paid_amount) + intval($request->payble_amount);
                    $total_emi->due_late_fees =  intval($total_emi->due_late_fees) - intval($request->late_fees);
                    $total_emi->due_amount =($due_amount1) - ($request->payble_amount - $request->other_charge -($total_due_late_fees - $request->late_fees) -( $paid_intrest- $request->Intrest ));
                    $total_emi->due_other_charge = intval($total_emi->due_other_charge) - intval($request->other_charge); 

                    $total_emi->late_pay = $latePay;
                    $total_emi->payment_status = 'Pending';
                    $total_emi->extra_intrest_amount = $total_emi->extra_intrest_amount + $request->Intrest;
                    
                    $res = $total_emi->save(); 
                    // dd($total_emi);
                    $currentPayEmi = GenrateEmi::where('id',$request->emi_id)->first();

                    
                    if($total_emi->due_amount < 1){
                        $loan = ApproveLoan::where(['loan_request_number'=>$request->loan_request_number])->first();
                        $loan->due_emi =  $loan->due_emi-  $total_emi->total_emi;
                        $loan->total_payble_due_amount =  floatval($loan->total_payble_due_amount) - floatval($loan->emi_amount*$total_emi->total_emi);
                        $loan->payment_status =  'Paid';
                        $loan->save();
 

                         $appPendingEmi = GenrateEmi::where(['loan_request_number'=>$request->loan_request_number])->get();
                        if(count($appPendingEmi)){
                            foreach($appPendingEmi as $emiItem){ 
                                $emiItem->payment_status ="Paid";
                                $emiItem->due_amount =0;
                                // $emiItem->intrest ==0;
                                // $emiItem->late_fees ==0;
                                $emiItem->save(); 
                            }
                        }

                        $TotalEmi = TotalEmi::where(['loan_request_number'=>$request->loan_request_number,'emi_generated'=>1])->get();
                        if(count($TotalEmi)){
                            foreach($TotalEmi as $emiItem){ 
                                $emiItem->payment_status ="Paid";
                                $emiItem->save();
                            }
                        } 

                    }
                    
                 
                
                    return back()->with('success','Your Emi paid successfully !!');
              

                }

            }





}
