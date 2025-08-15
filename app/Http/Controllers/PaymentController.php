<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key; 
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function paymentResponse(Request $req){
        // dd($req->transaction_response);
          $key = 'koVpdfgmTmMR0hpWABcTyxZWgmsS0hXg';
         $result_decoded = JWT::decode($req->transaction_response, new Key($key, 'HS256'));
         dd($result_decoded);
        return response()->json('Payment response url');
    }
}
