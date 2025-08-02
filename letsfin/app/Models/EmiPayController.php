<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmiDetail;
use App\Models\ApproveLoan  ;
use Session;
use Carbon\Carbon;
class EmiPayController extends Controller
{
    public function customerpaidEmi(Request $request){
        // dd($request->all());
        // var_dump(Carbon::now());
        $emiDetail = new EmiDetail();
        $emiDetail->loan_request_number = Session::get('customer')->loan_request_number;
        $emiDetail->username = Session::get('customer')->username;
        $emiDetail->transaction_id = "TYGFG".rand(1111,9999);
        $emiDetail->transaction_date = date('d-m-Y');
        $emiDetail->emi_amount = $request->emi_amount;
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

        $loan = ApproveLoan::where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        // dd($loan);
        $loan->total_payble_due_amount = $loan->total_payble_due_amount-$request->emi_amount;
        $loan->late_charge = $request->late_fees;
        $loan->next_emi_date = $new_date;
        $loan->due_emi = $loan->due_emi-1;
        $res1 =$loan->save();
        if($res1){
            return redirect('user-dashboard')->with('success','Your Emi paid successfully !!');
        }

        }

    }

    public function adminpaidEmi(Request $request){
        // dd($request->all());
        // var_dump(Carbon::now());
        $emiDetail = new EmiDetail();
        $emiDetail->loan_request_number = $request->loan_request_number;
        // $emiDetail->username = Session::get('customer')->username;
        $emiDetail->transaction_id = $request->transaction_id;
        $emiDetail->transaction_date = $request->transaction_date;
        $emiDetail->emi_amount = $request->emi_amount;
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

        $loan = ApproveLoan::where('loan_request_number',$request->loan_request_number)->first();
        // dd($loan);
        $loan->total_payble_due_amount = $loan->total_payble_due_amount - $request->emi_amount;
        $loan->late_charge = $request->late_fees;
        $loan->next_emi_date = $new_date->toDateString();
        $loan->due_emi = $loan->due_emi-1;
        $res1 =$loan->save();
        if($res1){
            return back()->with('success','Your Emi paid successfully !!');
        }

        }

    }
}
