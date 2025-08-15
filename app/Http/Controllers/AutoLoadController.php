<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRequest;
use App\Models\Distributor; 
use App\Models\BankDetail; 
use App\Models\ApproveLoan; 
use App\Models\TotalEmi; 
use App\Models\GenrateEmi; 
   use App\Models\CustomerAuth; 
    use Carbon\Carbon;
use Session;

class AutoLoadController extends Controller
{


     public function generateEmi(){
          
        $emiData = TotalEmi::where(['payment_status'=>'Upcoming','emi_generated'=>0])->get(); 
        
        foreach ($emiData as $item){
            $todaydate = Date('Y-m-d');
            $new_date =(((new Carbon($todaydate))->addMonths(1)));
            $add_day =(((new Carbon($todaydate))->addDays(10)));
            
            $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));
            
            $status = (date('Y-m-d',strtotime($item->emi_due_date)) >= $todaydate && date('Y-m-d',strtotime($item->emi_due_date)) <= $add_day->toDateString() || date('Y-m-d',strtotime($item->emi_due_date)) < $add_day );
            if($status){
                // dd($item);
              // dd($item->id,$status,$item->emi_due_date < $add_day->toDateString());
                $lastGenerate = GenrateEmi::where(['username'=>$item->username, 'loan_request_number'=>$item->loan_request_number,'payment_status'=>'Pending'])->orderBy('id','desc')->first();
                if($lastGenerate){
                    $lastEmiPendingAmount = $lastGenerate->due_amount + $lastGenerate->due_other_charge;
                    $late_fees = ($lastEmiPendingAmount/100)*2;
                    if($late_fees < 300){
                        $late_fees =300;
                    }
                   
                    $oneMonth = $item->rate_of_intrest/12;
                    $late_interest = ($lastEmiPendingAmount/100)*$oneMonth;
                    $lastEmiPendingAmount_total =( $lastGenerate->due_amount + $late_fees + $late_interest);
                    
                    
                    

                    $generateEmi = new GenrateEmi();
                   
                    $generateEmi->username   =          $item->username;
                    $generateEmi->emi_due_date   =        $item->emi_due_date ;
                    $generateEmi->emi_amount   =        $item->emi_amount;
                    $generateEmi->paid_amount   =        0;
                    $generateEmi->late_fees   =         $late_fees;
                    $generateEmi->due_late_fees   =      $late_fees;
                    $generateEmi->due_amount   =        round(($item->due_amount)+$lastEmiPendingAmount_total);
                    $generateEmi->payment_status   =    'Pending';
                    $generateEmi->loan_request_number  =  $item->loan_request_number;
                    $generateEmi->intrest   =           round($late_interest);
                    $generateEmi->rate_of_intrest   =   $item->rate_of_intrest;
                    $generateEmi->count_payment   =     0;
                    $generateEmi->emi_id   =            $item->id;
                    $generateEmi->total_emi   =        $lastGenerate->total_emi+1;
                    $generateEmi->last_emi_amount   =   round($lastEmiPendingAmount_total);
                    $generateEmi->save();

                    // $generateEmi->paid_date   => $item->username;    
                }else{

                    $lastGenerate = GenrateEmi::where(['username'=>$item->username, 'loan_request_number'=>$item->loan_request_number,'payment_status'=>'Paid'])->latest()->first();
                    $late_fee =0;
                    if($lastGenerate && $lastGenerate->late_pay==1){
                        $late_fee = ($lastGenerate->paid_amount/100)*2;
                        if($late_fee<300){
                            $late_fee =300;
                        }
                    } 
                    $generateEmi = new GenrateEmi();
                   
                    $generateEmi->username   =          $item->username;
                    $generateEmi->emi_due_date   =       $item->emi_due_date;
                    $generateEmi->emi_amount   =        floatval($item->emi_amount)+$late_fee;
                    $generateEmi->paid_amount   =        0;
                    $generateEmi->late_fees   =         $late_fee;
                    $generateEmi->due_amount   =        round(floatval($item->due_amount));
                    $generateEmi->payment_status   =   'Pending';
                    $generateEmi->loan_request_number=  $item->loan_request_number;
                    $generateEmi->intrest   =  0;
                    $generateEmi->rate_of_intrest   =   $item->rate_of_intrest;
                    $generateEmi->count_payment   =     0;
                    $generateEmi->emi_id   =    $item->id;  
                    $generateEmi->total_emi   = 1;  
                    $generateEmi->save(); 
                }

                $emidata1 = TotalEmi::where('id',$item->id)->update(['payment_status'=>'Pending','emi_generated'=>1]);
                $approved = ApproveLoan::where('loan_request_number',$item->loan_request_number)->first();
                if($approved){
                  $approved->next_emi_date =$item->emi_due_date; 
                    $approved->payment_status ="Pending";
                    $approved->save();

                }
                
          
          }
}
        // GenrateEmi
     }
    //
    public function updateEmi(){


        $emidata1 = TotalEmi::where('payment_status','Upcoming')->get();
        // dd(count($emidata1));
         foreach ($emidata1 as $item){
                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(10)));
                                     
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


    }
    
    
public function checkDuedate(){
    $todaydate = Date('Y-m-d');
       
    $approved_loan = \DB::table('approve_loans')->where(['procces_status_btn'=>'Processed'])->get();
    $approved_loan = \DB::table('approve_loans')->get();
    if(count($approved_loan)>0){
        foreach($approved_loan as $apLoan){
        $emis1 = \DB::table('total_emis')->where(['loan_request_number'=>$apLoan->loan_request_number,'payment_status'=>'Pending'])->get();
        if(count($emis1)>0){
            $other_charge=0;
            $late_fees=0;
            $secondEmi=0;
            $secondEmi_intrest=0;
            $decreement_emi =1;
            $last_due_date="";
            foreach($emis1 as $item){
                    
                    $due_date=date('d-m-Y',strtotime($item->emi_due_date));
                    $due_date1=date('d-m-Y',strtotime($item->emi_due_date));

                                $to =Carbon::parse($item->emi_due_date);

                    if($to->toDateString() < date('Y-m-d')){

                                $from =Carbon::parse(date('Y-m-d'));
                                $days = $to->diffInDays($from);
                               
                                if(($item->due_amount/100*2)*$days <=300){
                                    $late_fees = 300;
                                }else{

                                    $late_fees = intval(($item->due_amount/100*2)*$days);
                                   
                                }
                               
                            }
                            $intrest=  intval($item->due_amount)/100 * intval($item->rate_of_intrest);
                            $pay_emi = $item->due_amount;
                            $payble_amount= intval($item->due_amount+$late_fees+$intrest)+$item->other_charge_amount;

                            $last_due_date= $item->emi_due_date;
                            $mobile= $item->username;
                            $other_charge = $other_charge + $item->other_charge_amount;
                            
            }

            $from =Carbon::parse(date('Y-m-d'));
            $to =Carbon::parse($last_due_date);
            $days = $to->diffInDays($from);
           

            if($last_due_date !="" && date( 'Y-m-d',strtotime($last_due_date))> date('Y-m-d') && $days == 3){
                dd(date('Y-m-d',strtotime($last_due_date))> date('Y-m-d'), $days,$mobile);
            $Msg=urlencode("आपके ".$payble_amount." रुपये किश्त का भुगतान ".date('d-M-Y',strtotime($last_due_date))." को देय है। खाते में पैसा रखें और जुर्माने से बचें. त्रिशोदया");
            $Password='kitt4539KI';
            $SenderID='TRISMA';
            $UserID='trishyodayabiz';
            $EntityID='1701168248526543905';
            $TemplateID='1707168732207212767';
            $Phno= $mobile;
            
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: SASASAs'
                ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                echo $response;
            //     echo ($dueDay).'<br>';
            //     echo $emiData->username;
            // dd($payble_amount,$last_due_date);
            }

        }
        }
    }
}


     public function test(){
        $todaydate = Date('Y-m-d');
       
        // $approved_loan = \DB::table('approve_loans')->where(['procces_status_btn'=>'Processed'])->get();
        $approved_loan = \DB::table('approve_loans')->get();
      

        if(count($approved_loan)>0){
            $emis = \DB::table('total_emis')->get();
            if(count($emis)>0){
                foreach($emis as $emiData){
                    $dueDate = Carbon::createFromDate(date('Y-m-d',strtotime($emiData->emi_due_date)));
                    $dueDay = $dueDate->diffInDays($todaydate);
                    
                    if(date('Y-m-d',strtotime($emiData->emi_due_date)) > date('Y-m-d')  && $dueDay==3){
                            // dd($dueDay);
                                
                             $approvedLoan =\DB::table('approve_loans')->where('loan_request_number',$emiData->loan_request_number)->first();
                            $dueAmount = $emiData->due_amount+ (intval($emiData->due_amount)/100 * $approvedLoan->interest);
                               $Phno= $emiData->username;
                            //   $Msg=urlencode("आपके व्यक्तिगत ऋण का भुगतान ".$dueAmount." को देय है। आपकी ईएमआई ".$emiData->due_amount." रुपये है। कृपया देरी शुल्क से बचने के लिए जल्दी भुगतान करें. अनदेखा करें, यदि पहले से ही भुगतान किया गया है। कृपया अपनी किस्त को नीचे दिए गए बैंक विवरणों में स्थानांतरित करें
                               $Msg=urlencode("आपके ".$dueAmount." रुपये किश्त का भुगतान ".date('d-M-Y',strtotime($emiData->emi_due_date))." को देय है। खाते में पैसा रखें और जुर्माने से बचें. त्रिशोदया");
                               $Password='kitt4539KI';
                               $SenderID='TRISMA';
                               $UserID='trishyodayabiz';
                               $EntityID='1701168248526543905';
                               $TemplateID='1707168732207212767';
                       
                               
                       $curl = curl_init();
                       
                       curl_setopt_array($curl, array(
                         CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                         CURLOPT_RETURNTRANSFER => true,
                         CURLOPT_ENCODING => '',
                         CURLOPT_MAXREDIRS => 10,
                         CURLOPT_TIMEOUT => 0,
                         CURLOPT_FOLLOWLOCATION => true,
                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                         CURLOPT_CUSTOMREQUEST => 'POST',
                         CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                         CURLOPT_HTTPHEADER => array(
                           'Authorization: SASASAs'
                         ),
                       ));
                       
                       $response = curl_exec($curl);
                       
                       curl_close($curl);
                       echo $response;
                        echo ($dueDay).'<br>';
                        echo $emiData->username;
                    }
                }
            }

        }
    }
    
    

    public function sevenDayMessage(){
        $todaydate = Date('Y-m-d');
       
        $approved_loan = \DB::table('approve_loans')->get();
        if(count($approved_loan)>0){
            $emis = \DB::table('total_emis')->where(['payment_status'=>'Pending'])->get();
            if(count($emis)>0){
                foreach($emis as $emiData){
                    $dueDate = Carbon::createFromDate(date('Y-m-d',strtotime($emiData->emi_due_date)));
                    $dueDay = $dueDate->diffInDays($todaydate);
                    
                    if(date('Y-m-d',strtotime($emiData->emi_due_date)) < date('Y-m-d')  && $dueDay%7==0){
                            // dd($dueDay);
                                
                            $due_date=date('d-m-Y',strtotime($emiData->emi_due_date));
                            $due_date1=date('d-m-Y',strtotime($emiData->emi_due_date));
        
                                        $to =Carbon::parse($emiData->emi_due_date);
        
                            if($to->toDateString() < date('Y-m-d')){
        
                                        $from =Carbon::parse(date('Y-m-d'));
                                        $days = $to->diffInDays($from);
                                       
                                        if(($emiData->due_amount/100*2)*$days <=300){
                                            $late_fees = 300;
                                        }else{
        
                                            $late_fees = intval(($emiData->due_amount/100*2)*$days);
                                           
                                        }
                                       
                                    }
                                $approvedLoan =\DB::table('approve_loans')->where('loan_request_number',$emiData->loan_request_number)->first();
                                $dueAmount = $emiData->due_amount+ (intval($emiData->due_amount)/100 * $approvedLoan->interest)+$late_fees;
                                $Phno= $emiData->username;
                            //   $Msg=urlencode("आपके व्यक्तिगत ऋण का भुगतान ".$dueAmount." को देय है। आपकी ईएमआई ".$emiData->due_amount." रुपये है। कृपया देरी शुल्क से बचने के लिए जल्दी भुगतान करें. अनदेखा करें, यदि पहले से ही भुगतान किया गया है। कृपया अपनी किस्त को नीचे दिए गए बैंक विवरणों में स्थानांतरित करें
                               $Msg=urlencode("आपके ऋण की बकाया राशि रु. न ".$dueAmount.", कानूनी कार्यवाही से बचने के लिए कृपया अपनी शेष राशि का भुगतान तुरंत करें।  त्रिशोदया");
                               $Password='kitt4539KI';
                               $SenderID='TRISMA';
                               $UserID='trishyodayabiz';
                               $EntityID='1701168248526543905';
                               $TemplateID='1707168732212654357';
                       
                               
                       $curl = curl_init();
                       
                       curl_setopt_array($curl, array(
                         CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                         CURLOPT_RETURNTRANSFER => true,
                         CURLOPT_ENCODING => '',
                         CURLOPT_MAXREDIRS => 10,
                         CURLOPT_TIMEOUT => 0,
                         CURLOPT_FOLLOWLOCATION => true,
                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                         CURLOPT_CUSTOMREQUEST => 'POST',
                         CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                         CURLOPT_HTTPHEADER => array(
                           'Authorization: SASASAs'
                         ),
                       ));
                       
                       $response = curl_exec($curl);
                       
                       curl_close($curl);
                       echo $response;
                        echo ($dueDay).'<br>';
                        echo $emiData->username;
                    }
                }
            }

        }
    }
    


    //sevenday messege test

    
public function checkDuedate1(){
    $todaydate = Date('Y-m-d');
       
    $approved_loan = \DB::table('approve_loans')->where(['procces_status_btn'=>'Processed'])->get();
    $approved_loan = \DB::table('approve_loans')->get();
    if(count($approved_loan)>0){
        foreach($approved_loan as $apLoan){
        $emis1 = \DB::table('total_emis')->where(['loan_request_number'=>$apLoan->loan_request_number,'payment_status'=>'Pending'])->where('emi_due_date','<',date('Y-m-d'))->get();
        if(count($emis1)>0){
            $other_charge=0;
            $late_fees=0;
            $secondEmi=0;
            $secondEmi_intrest=0;
            $decreement_emi =1;
            $last_due_date="";
            foreach($emis1 as $item){
                    
                    $due_date=date('d-m-Y',strtotime($item->emi_due_date));
                    $due_date1=date('d-m-Y',strtotime($item->emi_due_date));

                                $to =Carbon::parse($item->emi_due_date);

                    if($to->toDateString() < date('Y-m-d')){

                                $from =Carbon::parse(date('Y-m-d'));
                                $days = $to->diffInDays($from);
                               
                                if(($item->due_amount/100*2)*$days <=300){
                                    $late_fees = 300;
                                }else{

                                    $late_fees = intval(($item->due_amount/100*2)*$days);
                                   
                                }
                               
                            }
                            $intrest=  $intrest+ intval($item->due_amount)/100 * intval($item->rate_of_intrest);
                            $pay_emi = $pay_emi+$item->due_amount;
                            $payble_amount= $payble_amount + intval($item->due_amount+$late_fees+$intrest)+$item->other_charge_amount;

                            $last_due_date= $last_due_date+$item->emi_due_date;
                            $mobile= $item->username;
                            $other_charge = $other_charge + $item->other_charge_amount;
                            
            }

            $from =Carbon::parse(date('Y-m-d'));
            $to =Carbon::parse($last_due_date);
            $days = $to->diffInDays($from);
           

            if($last_due_date !="" && date( 'Y-m-d',strtotime($last_due_date))<date('Y-m-d') && $days == 7){
                // dd(date('Y-m-d',strtotime($last_due_date))< date('Y-m-d'), $days,$mobile);
            $Msg=urlencode("आपके ".$payble_amount." रुपये किश्त का भुगतान ".date('d-M-Y',strtotime($last_due_date))." को देय है। खाते में पैसा रखें और जुर्माने से बचें. त्रिशोदया");
            $Password='kitt4539KI';
            $SenderID='TRISMA';
            $UserID='trishyodayabiz';
            $EntityID='1701168248526543905';
            $TemplateID='1707168732207212767';
            $Phno= $mobile;
            
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: SASASAs'
                ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                echo $response;
            //     echo ($dueDay).'<br>';
            //     echo $emiData->username;
            // dd($payble_amount,$last_due_date);
            }

        }
        }
    }
}



//three days ago message 
        function threeDayAgoMessage(){
            $loan = ApproveLoan::where('status','Approved')->get();
            if(count($loan)>0){
                $todaydate = Date('Y-m-d');
                foreach($loan as $loanItem){
                $lastGenerate = GenrateEmi::where(['loan_request_number'=>$loanItem->loan_request_number,'payment_status'=>'Pending'])->orderBy('id','desc')->first();
                   
                // dd($lastGenerate);
                if($lastGenerate){
                        $dueDate = Carbon::createFromDate(date('Y-m-d',strtotime($lastGenerate->emi_due_date)));
                        $dueDay = $dueDate->diffInDays($todaydate);

                        if(date('Y-m-d',strtotime($lastGenerate->emi_due_date)) > date('Y-m-d')  && $dueDay==3){


                            $dueAmount = $lastGenerate->due_amount+ $lastGenerate->due_other_charge;
                            $Phno= $lastGenerate->username;
                         //   $Msg=urlencode("आपके व्यक्तिगत ऋण का भुगतान ".$dueAmount." को देय है। आपकी ईएमआई ".$emiData->due_amount." रुपये है। कृपया देरी शुल्क से बचने के लिए जल्दी भुगतान करें. अनदेखा करें, यदि पहले से ही भुगतान किया गया है। कृपया अपनी किस्त को नीचे दिए गए बैंक विवरणों में स्थानांतरित करें
                            $Msg=urlencode("आपके ".$dueAmount." रुपये किश्त का भुगतान ".date('d-M-Y',strtotime($lastGenerate->emi_due_date))." को देय है। खाते में पैसा रखें और जुर्माने से बचें. त्रिशोदया");
                            $Password='kitt4539KI';
                            $SenderID='TRISMA';
                            $UserID='trishyodayabiz';
                            $EntityID='1701168248526543905';
                            $TemplateID='1707168732207212767';
                    
                            
                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: SASASAs'
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    echo $response;
                     echo ($dueDay).'<br>';
                     echo $lastGenerate->username;


                     //end message
                        }


                    }
                }
            }
        }
  

        function sevenDayAfterMessage(){

            $loan = ApproveLoan::where('status','Approved')->get();
            if(count($loan)>0){
                $todaydate = Date('Y-m-d');
                foreach($loan as $loanItem){
                $lastGenerate = GenrateEmi::where(['loan_request_number'=>$loanItem->loan_request_number,'payment_status'=>'Pending'])->orderBy('id','desc')->first();
                   
                // dd($lastGenerate);
                if($lastGenerate){
                        $dueDate = Carbon::createFromDate(date('Y-m-d',strtotime($lastGenerate->emi_due_date)));
                        $dueDay = $dueDate->diffInDays($todaydate);

                        if(date('Y-m-d',strtotime($lastGenerate->emi_due_date)) < date('Y-m-d')  && $dueDay%7 ==0){


                            $dueAmount = $lastGenerate->due_amount+ $lastGenerate->due_other_charge;
                            $Phno= $lastGenerate->username;
                         //   $Msg=urlencode("आपके व्यक्तिगत ऋण का भुगतान ".$dueAmount." को देय है। आपकी ईएमआई ".$emiData->due_amount." रुपये है। कृपया देरी शुल्क से बचने के लिए जल्दी भुगतान करें. अनदेखा करें, यदि पहले से ही भुगतान किया गया है। कृपया अपनी किस्त को नीचे दिए गए बैंक विवरणों में स्थानांतरित करें
                         $Msg=urlencode("आपके ऋण की बकाया राशि रु. न ".$dueAmount.", कानूनी कार्यवाही से बचने के लिए कृपया अपनी शेष राशि का भुगतान तुरंत करें।  त्रिशोदया");
                         $Password='kitt4539KI';
                         $SenderID='TRISMA';
                         $UserID='trishyodayabiz';
                         $EntityID='1701168248526543905';
                         $TemplateID='1707168732212654357';
                    
                            
                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=trishyodayabiz&Password=kitt4539KI&SenderID=TRISMA&Phno='.$Phno.'&Msg='.$Msg.'&EntityID=1701168248526543905&TemplateID='.$TemplateID,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => array('name' => 'Amit kumar','email' => 'amitkumar7867@gmail.com','password' => '1234561212'),
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: SASASAs'
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    echo $response;
                     echo ($dueDay).'<br>';
                     echo $lastGenerate->username;


                     //end message
                        }


                    }
                }
            }
        }



}
