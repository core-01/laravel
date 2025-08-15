<?php
namespace App\Http\Controllers;
// require 'vendor/autoload.php';

use Illuminate\Http\Request; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key; 
use Carbon\Carbon;


use Illuminate\Support\Facades\Http;
class Payment extends Controller
{

    // protected $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
        $this->jwt_secrect = "koVpdfgmTmMR0hpWABcTyxZWgmsS0hXg";
    }

 
 

function orderCreate(Request $request)
{
    
    $payAmount = floatval($request->total_emi_due_amount) + floatval($request->total_intrest_amount) + floatval($request->total_late_fees)+floatval($request->total_other_charge);
        
        $mydata = ['name'=>'Amit kumar',   'dob'=>'18-07-1997'];
                        // Set the timezone
                    $timezone = 'Asia/Kolkata';
                    
                    // Create a Carbon instance with the current date and time in the specified timezone
                    $dateTime = Carbon::now($timezone);
                    
                    // Format the Carbon instance to the desired format
                        $formattedDate = $dateTime->format('Y-m-d\TH:i:sP');
    //  dd(Carbon::now());
         $headers = ["alg" => "HS256", "clientid" =>'uattrisov2'];
        $orderId = 'ORD'.rand(1111111111,999999999999999);
        $payload = [
          "mercid" => 'UATTRISOV2',
          "orderid" => $orderId, // must be unique for every request
          "amount" => "1",
          "order_date" => $formattedDate,
          "currency" => "356", // for INR
          "ru" => 'https://letsfin.in/payment-response',
          "additional_info" => [
            "additional_info1" => 'scsdcsd',
            "additional_info2" => 'dsaasaasd',
          ],
          "itemcode" => "DIRECT",
          "device" => [
            "init_channel" => "internet",
            "ip" => request()->ip(),
            //"mac" => '',  //not mandatory 
            //"imei" => '14134234343242', //not mandatory
            "accept_header" => "text/html", 
            "user_agent"=> "Windows 10",
           // "fingerprintid" => '' //not mandatory
          ]
        ];
        
       

        // $this->load->library('jwt');
       
        // dd(new Key($key, 'HS256'));
        $curl_payload = $this->jwt->encode($payload, $this->jwt_secrect, "HS256", null ,$headers); // you should use Firebase/JWT library to encrypt the response
 
 
        $ch = curl_init( 'https://uat1.billdesk.com/u2/payments/ve1_2/orders/create' ); 

       
        $ch_headers = array(
            "Content-Type: application/jose",
            "accept: application/jose",
            "BD-Traceid: ".$orderId,
            "BD-Timestamp: 20200817132207"
        );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $ch_headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $curl_payload);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        // dd(curl_exec($ch));          
        $result = curl_exec($ch); 

        curl_close($ch);
        echo($result);
        // die;
        
        // return view('paymentCheck');
        
        
        /*****************************************/
                 // Billdesk Response
        /*****************************************/
        
        $launch_billdesk = false;
        // try { 




                
            $key = 'koVpdfgmTmMR0hpWABcTyxZWgmsS0hXg';
            $result_decoded = JWT::decode($result, new Key($key, 'HS256'), $headers = new \stdClass());
            // dd($decoded);
            // die;
            // $result_decoded = $this->jwt->decode($result, 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4', ['HS256']); 
 
             
            $result_array = (array) $result_decoded;
                // dd($result_array);
            if ($result_decoded->status == 'ACTIVE') {
                $authToken = $result_array['links'][1]->headers->authorization;
                 return view('paymentCheck',compact('result_array','authToken'));
            } else { // Response error
                echo "Response error";
            }
                            
        // } catch (\Exception $e) {
        //   echo $e;
        // }
  
    }

    public function paymentTest(Request $request){


         // Set up Guzzle client
         $client = new Client();

         // BillDesk API endpoint
         $url = 'https://secure.billdesk.com/pgidsk/PGIMerchantRequest';
 
         // Your BillDesk API credentials
         $merchantId = 'UATTRISOV2';
         $securityId = 'koVpdfgmTmMR0hpWABcTyxZWgmsS0hXg';
 
         // Payment data
         $data = [
             'merchantId' => $merchantId,
             'securityId' => $securityId,
             'amount' => $request->input('amount'),
             'orderId' => $request->input('orderId'),
             // Add other required parameters
         ];
 
         // Make a POST request to BillDesk API
         $response = $client->post($url, [
             'form_params' => $data,
         ]);
 
         // Process the response from BillDesk
         $responseData = json_decode($response->getBody(), true);
 
         // Handle the response and redirect the user accordingly
         if ($responseData['status'] === 'success') {
             // Payment successful
             return redirect()->route('payment.success');
         } else {
             // Payment failed
             return redirect()->route('payment.failure');
         }


    }

    // public function paymentTestView(){
    //     return view('paymentCheck');
    // }

 
    
public function paymentTestView(Request $request)
{
    $merchantId = config('services.billdesk.merchant_id');
    $secretKey = config('services.billdesk.secret_key');

    $oid =rand(11111,999999);
    $orderData = [
        // Define your order data here
        'amount' => 100.00,
        'orderId' => $oid,
        // Other order details...
    ];

    // Make a request to BillDesk API
    $response = Http::post('https://api.billdesk.com/create-order', [
        'merchantId' => $merchantId,
        'orderData' => $orderData,
    ]);
dd($response);
    // Handle the API response
    $responseData = $response->json();

    if ($responseData['status'] === 'success') {
        // Payment was successful
        // Handle success and update your database
        return redirect()->route('payment-success');
    } else {
        // Payment failed
        // Handle failure and redirect to an error page
        return redirect()->route('payment-error');
    }
}
}


