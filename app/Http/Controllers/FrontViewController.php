<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankDetail;
use App\Models\ApproveLoan;
use App\Models\TotalEmi;
use DB;
use Session;
use Carbon\Carbon;

class FrontViewController extends Controller
{

    public function setLanguage($lan){
     
        Session::put('language',$lan);
        return back();
}
    public function index(){

        if(!Session::has('language')){
        return view('front.index');

        }
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.index');

        }elseif(Session::has('language') && Session::get('language')=="en"){
          
        return view('front.index');

        }else{
        return view('front.index');

        }
    }
    public function aboutUs(){

        if(Session::has('language') && Session::get('language')=="Hi"){
        return view('front.hindi.aboutus');
          

        }elseif(Session::has('language') && Session::get('language')=="en"){
        return view('front.aboutus');
        //
        }
        else{
            return view('front.aboutus');
    
            }
        // return view('front.aboutus');
    }

    public function applyLoan(){
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.apply-loan');
    
            }elseif(Session::has('language') && Session::get('language')=="en"){
             return view('front.apply-loan');
           
            }
            else{
                return view('front.apply-loan');
        
                }
    }

    public function applyLoanBackup(){
        return view('front.apply-loanbackup');
    }

    public function applyNow(){
        if(Session::has('language') && Session::get('language')=="Hi"){
        return view('front.hindi.apply-loan');
    
        }elseif(Session::has('language') && Session::get('language')=="en"){
            return view('front.apply-loan');
       
        }else{
            return view('front.apply-loan');
    
            }
    }

    public function contactUs(){
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.contact-us');
    
        }elseif(Session::has('language') && Session::get('language')=="en"){
        return view('front.contact-us');
       
        }else{
            return view('front.contact-us');
    
            }
    }

    public function userDashboard(){
                                    $status =false;
                                    $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                                     $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('loan_requests.loan_request_number',Session::get('customer')->loan_request_number)->first();
                                     if($emidata && $emidata->next_emi_date !=""){
                                        
                                     $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString() ||$emidata->next_emi_date < $todaydate );
                                    //  $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString());
                                     }
                                      // dd($status);
                                    if($status){
                                      $pay_status = ApproveLoan::where('loan_request_number',$emidata->loan_request_number)->first();
                                     $pay_status->payment_status ="Pending";
                                     $res = $pay_status->save();
                                     if($res){

                                      //  echo ($emidata->approve_loan_amount);
                                     }
                                    //  echo ($emidata->loan_request_number);

                                
                                    }



        $bankDtail = BankDetail::where('loan_request_number',Session::get('customer')->loan_request_number)->first();

        $loanDetail = DB::table('approve_loans')->where('loan_request_number',Session::get('customer')->loan_request_number)->where('status','Approved')->first();
        

        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.dashboard',['loanDetail'=>$loanDetail, 'bankDtail'=>$bankDtail]);

    
        }elseif(Session::has('language') && Session::get('language')=="en"){
            return view('front.dashboard',['loanDetail'=>$loanDetail, 'bankDtail'=>$bankDtail]);

       
        }else{
            return view('front.dashboard',['loanDetail'=>$loanDetail, 'bankDtail'=>$bankDtail]);


    
            }
    }

    public function eligibility(){
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.eligibility');
    
        }elseif(Session::has('language') && Session::get('language')=="en"){
        return view('front.eligibility');
       
        }else{
            return view('front.eligibility');

    
            }

    }
     
    public function register(){

        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.register');

    
        }elseif(Session::has('language') && Session::get('language')=="en"){
            return view('front.register');

       
        }else{
            // return view('front.eligibility');
            return view('front.register');

    
            }


    }

    public function loanDetails(){

                                    $status =false;
                                    $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                                     $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('loan_requests.loan_request_number',Session::get('customer')->loan_request_number)->first();
                                     if($emidata && $emidata->next_emi_date !=""){
                                        
                                     $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString() ||$emidata->next_emi_date < $todaydate );
                                    //  $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString());
                                     }
                                      // dd($status);
                                    if($status){
                                      $pay_status = ApproveLoan::where('loan_request_number',$emidata->loan_request_number)->first();
                                     $pay_status->payment_status ="Pending";
                                     $res = $pay_status->save();
                                     if($res){

                                      //  echo ($emidata->approve_loan_amount);
                                     }
                                    //  echo ($emidata->loan_request_number);

                                
                                    }
        $loanDetail =DB::table('approve_loans')->where('loan_request_number',Session::get('customer')->loan_request_number)->where('procces_status_btn','Processed')->first();
        // dd($loanDetail);
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.loan-detail',['loanDetail'=>$loanDetail]);


    
        }elseif(Session::has('language') && Session::get('language')=="en"){
               return view('front.loan-detail',['loanDetail'=>$loanDetail]);


       
        }else{
            return view('front.loan-detail',['loanDetail'=>$loanDetail]);


    
            }
    }

    public function payemi(){
        $loanDetail =DB::table('approve_loans')->where('loan_request_number',Session::get('customer')->loan_request_number)->where('procces_status_btn','Processed')->first();
        // dd($loanDetail);
        if(Session::has('language') && Session::get('language')=="Hi"){
           
            return view('front.hindi.pay-emi',['loanDetail'=>$loanDetail]);
        
            }elseif(Session::has('language') && Session::get('language')=="en"){
           
                 return view('front.pay-emi',['loanDetail'=>$loanDetail]);
           
            }else{
               
                return view('front.pay-emi',['loanDetail'=>$loanDetail]);
        
                }
       
    }
    

    public function transectionHistory(){
        $history =DB::table('emi_details')->where('loan_request_number',Session::get('customer')->loan_request_number)->orderBy('id','desc')->get();
        // dd($loanDetail);
        if(Session::has('language') && Session::get('language')=="Hi"){
           
            return view('front.hindi.transection-history',['history'=>$history]);
        
            }elseif(Session::has('language') && Session::get('language')=="en"){
           
                return view('front.transection-history',['history'=>$history]);
           
            }else{
               
                return view('front.transection-history',['history'=>$history]);
    
        
                }
       
    }




    public function myProfile(){
        $profile =DB::table('loan_requests')->where('loan_request_number',Session::get('customer')->loan_request_number)->orderBy('id','desc')->first();
        $bankDtail =DB::table('bank_details')->where('loan_request_number',Session::get('customer')->loan_request_number)->first();
        // dd($loanDetail);
        if(Session::has('language') && Session::get('language')=="Hi"){
           
        return view('front.hindi.my-profile',['profile'=>$profile,'bankDtail'=>$bankDtail]);
    
        }elseif(Session::has('language') && Session::get('language')=="en"){
       
            return view('front.my-profile',['profile'=>$profile,'bankDtail'=>$bankDtail]);
       
        }else{
           
        return view('front.my-profile',['profile'=>$profile,'bankDtail'=>$bankDtail]);

    
            }
    }


    public function customerEmi(){
        // $emi = TotalEmi::where('username',Session::get('customer')->username)->get();
        $emi = TotalEmi::where(['username'=>Session::get('customer')->username,'payment_status'=>'Pending'])->get();
        // dd($emi);
        if(Session::has('language') && Session::get('language')=="Hi"){
            return view('front.hindi.customer-emi',compact('emi'));

        }elseif(Session::has('language') && Session::get('language')=="en"){
          
            return view('front.customer-emi',compact('emi'));

        }else{
            return view('front.customer-emi',compact('emi'));

        }
         
    }

      public function forgotPassword(){
        return view('front.forgotpassword');
    }

    public function distributorForgotPassword(){
        return view('distributor.fogot-password');
    }


}
