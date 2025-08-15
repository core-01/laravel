<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAuth;
use Validator;
use Session;
class customerAuthController extends Controller
{
    public function customerLogin(Request $request){

        $validator =Validator::make($request->all(),[
            'username' => 'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>"error"])
            ->withInput($request->all())
            ->withError($validator->errors());
        }
        $customer = CustomerAuth::where('username',$request->username)->first();
        if($customer){
            if($customer->password == $request->password){
                    Session::put('customer',$customer);
                    return redirect('/user-dashboard');
            }
            else{
                return back()->with(['message'=>'inavalid credential.','alert-type'=>'error']);
            }
        }else{
            return back()->with(['message'=>'inavalid username and password.','alert-type'=>'error']);
        }
    }

    public function customerLogout(){
        if(Session::has('customer')){
            Session::forget('customer');
            return redirect('/');
        }else{
            return back();
        }
    }
    
    
    
    
    
    
public function customerForgotPassword(Request $request){
    // dd($request->all());

    $validator = Validator::make($request->all(),[
        'mobile'=> 'required',
        // 'newPassword'=> 'required',
        'confirm_password'=> 'same:new_password',
    ]);
    if($validator->fails()){
        if(\Session::has('otpData')){

            $otpData =\Session::has('otpData')?\Session::get('otpData'):array();
            return back()->with(['otp'=>$otpData['otp'],'mobile'=>$otpData['mobile'],'error'=>$validator->errors()->first()])
            ->withErrors($validator->errors())
            ->withInput($request->all());
        }else{
            return back()-> with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
        ->withErrors($validator->errors())
        ->withInput($request->all());
        }
       
    }

    $user = CustomerAuth::where(['username'=>$request->mobile])->first();
    
    if($user){
    if($request->otp){
        $otpData =\Session::has('otpData')?\Session::get('otpData'):array();
        if(count($otpData)>0){
            $dateTimeObject1 = date_create($otpData['current_time']); 
            $currentTime = date('Y-m-d H:i');
            $dateTimeObject2 = date_create($currentTime); 

              
                // Calculating the difference between DateTime Objects
                $interval = date_diff($dateTimeObject1, $dateTimeObject2); 
                echo ("Difference in days is: ");
                
                // Printing the result in days format
                echo $interval->format('%R%a days');
                echo "\n<br/>";
                $min = $interval->days * 24 * 60;
                $min += $interval->h * 60;
                $min += $interval->i;
                 
                // echo("Difference in minutes is: ");
                // echo $min.' minutes';
                if($min<=5 && $request->otp ==$otpData['otp'] && $request->mobile==$otpData['mobile']){
                    // dd('dscd');
                    try{
                        // $user->password =\Hash::make($request->new_password);
                        $user->password =$request->new_password;
                        $res = $user->save();
                        if($res){
                            return redirect('/')->with('success','Password Change Successfully. ');

                        }
                   
                    }catch(\Exception $e){
                        dd($e);
                        return back()->with('error','Something went wrong');
                    }
                }else{
                    return redirect('forgot-password')->with(['otp'=>$otpData['otp'],'mobile'=>$otpData['mobile'],'error'=>'Invalid OTP']);
                }
            // dd($otpData);

        }else{
            return redirect('forgot-password')->with('error','Somthing went wrong.');

        }


        }else{
            $otp =rand(1111,9999); 
            $otp =1234; 
                $mobile= $request->mobile;

                $Msg=urlencode("आपके ".'hhhh'." रुपये किश्त का भुगतान ".'sdcdssd'." को देय है। खाते में पैसा रखें और जुर्माने से बचें. त्रिशोदया");
                $Msg=urlencode("OTP .$otp. for Account recovery of login id .$mobile.. Do not share with anyone. Trishodaya");
                $Password='kitt4539KI';
                $SenderID='TRISMA';
                $UserID='trishyodayabiz';
                $EntityID='1701168248526543905';
                $TemplateID='1707169285133765415';
                $Phno= $user->username;
                
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
                    // echo $response;
                    // echo ($dueDay).'<br>';
                    // echo $emiData->username;
                   $json_res = json_decode($response);
                //    dd($json_res);
                // dd($payble_amount,$last_due_date);


                $otpData =[
                    'otp'=>$otp,
                    'current_time' =>date('Y-m-d H:i'),
                    'mobile' =>$user->username,
                ];
                \Session::put('otpData',$otpData);

                return redirect('forgot-password')->with(['otp'=>$otp,'mobile'=>$mobile,'success'=>$json_res->Status=="OK"?'OTP send successfully Your Register Mobile Number':'Something went wrong please after some time']);
        }

    }else{
        return back()->with('error','Invalid Mobile number');
    }
}


}
