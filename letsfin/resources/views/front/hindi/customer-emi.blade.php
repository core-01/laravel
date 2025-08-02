@extends('front.master.hindi-master')
@section('main-content')

<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
    use Carbon\Carbon;
?>
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.loginbtn {
    background: linear-gradient(200deg,#0085ff .33%,#9340fa 85.46%);
    box-shadow: 0 15px 30px -15px rgb(90 92 248 / 60%);
    border-color: #fff;
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section class="page-banner">
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>Transaction History</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="{{ route('index') }}">Home</a></li>
          <li class="active">User Dashboard</li>
        </ul>
        
      </div>
    </div>
  </section>
  <!-- <section class="about-sec-1">
    <div class="container">
      <h2>Trishodaya Micro Association<br />
        <span>FINANCING THE UNFINANCED</span>
      </h2>
    </div>
  </section> -->


  <section class="about-bg-2 pt-4 pb-4">
    <div class="container">
      <div class="row m-text-c">
      @include('front.master.hindi-user-sidebar')
        <div class="col-md-8 col-lg-9">
        <!--<h3>आपका स्वागत है {{Session::get('customer')->costomer_name}}!</h3>-->
      
        <div class="row">
        @if (count($emi)>0)
                        <div class="table-responsive col-sm-12">
                            <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                 
                                    <tr>
                                        <th width="2%"> क्रमांक</th>
                                        <th style="min-width:140px">भुगतान तिथि</th>
                                        <th>किस्त राशि </th>
                                        <th>चुकाई गई राशि</th>
                                        <th>किस्त देय राशि </th>
                                        <th>देर से ब्याज</th>
                                        <th>विलम्ब शुल्क</th>
                                        <th>देय राशि </th>
                                        <th>अन्य चार्ज</th>
                                      
                                    </tr>
                                 
                                </thead>
                                <tbody>

                                <?php
                                  $total_emi_due_amount = 0; 
                                  $total_intrest_amount = 0; 
                                  $total_late_fees = 0; 
                                ?>
                               
                                 
                                @foreach ($emi as $item)

                                <?php
      

                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                                    //  $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('loan_requests.loan_request_number',$item->loan_request_number)->first();
                                    //  $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString());
                                      // dd($status);
                                    // if($status){
                                    //   $pay_status = ApproveLoan::where('loan_request_number',$emidata->loan_request_number)->first();
                                    //  $pay_status->payment_status ="Pending";
                                    //  $res = $pay_status->save();
                                    //  if($res){

                                    //   //  echo ($emidata->approve_loan_amount);
                                    //  }
                                    // //  echo ($emidata->loan_request_number);

                                
                                    // }
                                    //  dd($item->next_emi_date <="2023-10-10" && $item->next_emi_date >="2023-01-10");
                                ?>


                    <?php
                    
                        $late_fees=0;
                        $secondEmi=0;
                        $secondEmi_intrest=0;
                        $decreement_emi =1;
                        $due_date=date('d-m-Y',strtotime($item->emi_due_date));
                        $due_date1=date('d-m-Y',strtotime($item->emi_due_date));
                        $intrest =  0;

                                    $to =Carbon::parse($item->emi_due_date);
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                                    // dd($to,$from,$days);
                        if($to->toDateString() < date('Y-m-d')){

                        //   $due_date = (((new Carbon($item->emi_due_date))->addMonths(1)));
                        //   $due_date2 = (((new Carbon($item->emi_due_date))->addMonths(1)));
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                                     


                                    if(($item->due_amount/100*2) <=300){
                                        $late_fees = 300;
                                    }else{

                                        $late_fees = floatval(($item->due_amount/100*2));
                                       
                                    }
                                    $oneDayIntrest=  (floatval($item->due_amount)/100 * floatval($item->rate_of_intrest))/30;
                                  $intrest=$oneDayIntrest*$days;
                                    // if($emidata->due_emi > 1){
                                    //   $decreement_emi =2;
                                    // $secondEmi = $emidata->emi_amount;
                                    // $secondEmi_intrest = $emidata->emi_amount/100*$emidata->interest;
                                    // }
                                    // dd($days);
                                }
                                // $intrest=  intval($item->due_amount)/100 * intval($item->rate_of_intrest);
                                ?>
                                @if ($to->toDateString() > date('Y-m-d') && $days < 6 || $to->toDateString() < date('Y-m-d'))
                                <?php
                                $pay_emi = $item->due_amount;
                                $payble_amount= floatval($item->due_amount+$late_fees+$intrest)+$item->other_charge_amount;

                                $total_emi_due_amount = $total_emi_due_amount + $item->due_amount;
                                $total_intrest_amount = $total_intrest_amount + $intrest;
                                $total_late_fees = $total_late_fees + $late_fees;
                        ?>
                        
                                      
                                   
                                    <tr>
                                        <td >{{ $loop->index+1 }}</td>
                                        <td>{{ date('d-M-Y',strtotime($item->emi_due_date)) }}</td>
                                        <td>{{ $item->emi_amount }}</td>
                                        <td>

                                          ₹{{ $item->paid_amount>0?number_format($item->paid_amount,2):0 }}

                                        </td>
                                        <td>₹{{ $item->due_amount }}</td>
                                        <td>₹{{ number_format($intrest,2) }}</td>
                                        <td>₹{{ number_format($late_fees,2) }}</td>
                                    <td>₹{{ number_format($payble_amount,2) }}</td>
                     <td width="150">
                                        
                                        <!--<form action="{{url('customer-paidEmi')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="emi_id" value="{{$item->id}}">
                        <input type="hidden" name="pay_emi_amount" value="{{$item->emi_amount}}">
                        <input type="hidden" value="{{$item->emi_due_date}}" name="current_emi_date" />
                        <input type="hidden" value="{{$item->emi_amount }}" name="emi_amount" />
                        <input type="hidden" value="{{date('d-m-Y', strtotime( $due_date))}}" name="next_emi_date" />
                        <input type="hidden" value="{{ $payble_amount }}" name="payble_amount" />
                        <input type="hidden" value="{{ $payble_amount }}" name="total_payble_amount" />
                        <input type="hidden" value="{{$late_fees}}" name="late_fees" />
                        <input type="hidden" value="{{$decreement_emi}}" name="decreement_emi" />
                        <input type="hidden" value="{{intval($intrest)}}" name="intrest_amount" />


                                            <button  class="btn  loginbtn"  style=" background:{{ $item->payment_status=='Paid'?'#5cb85c':'Yellow' }};" >Pay now</button>
                            </form> -->
                            @if($item->other_charge_reason && $item->other_charge_amount)
                                      <b>Reason: </b>{{ $item->other_charge_reason }}
                                      <b>Amount: </b>{{ $item->other_charge_amount }} <br> 
                                
                              @endif
                                        </td>
                                      
                                    </tr>

                                    @endif
                                  @endforeach
                                 
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>TGGDGH8765467</td>
                                        <td>03/02/2023</td>
                                        <td>2500</td>
                                        <td>0</td>
                                        <td ><a href="#" class="btn  loginbtn"  style="background:#5cb85c;" >Success</a></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>TGGGGH87444467</td>
                                        <td>03/03/2023</td>
                                        <td>2500</td>
                                        <td>0</td>
                                        <td ><a href="#" class="btn  loginbtn"  style="background:red;" >Failed</a></td>
                                    </tr> -->
                                 
                                </tbody>
                            </table>
                            <h4>कुल देय राशि</h4>
                            <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                <form action="{{url('customer-pay-total-due-emi')}}" method="post" enctype="multipart/form-data">
                        @csrf
                         


                          <?php

                        $other_charge =0;

                            ?>
                            @foreach ($emi as $item)

                            
                      <?php
                        $late_fees=0;
                        $secondEmi=0;
                        $secondEmi_intrest=0;
                        $decreement_emi =1;
                        $due_date=date('d-m-Y',strtotime($item->emi_due_date));
                        $due_date1=date('d-m-Y',strtotime($item->emi_due_date));
                        $intrest =  0;
                        $payble_amount=0;

                                    $to =Carbon::parse($item->emi_due_date);
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                                  ?>
                                    @if ($to->toDateString() > date('Y-m-d') && $days < 6 || $to->toDateString() < date('Y-m-d'))
                                  <?php
                        if($to->toDateString() < date('Y-m-d')){

                        //   $due_date = (((new Carbon($item->emi_due_date))->addMonths(1)));
                        //   $due_date2 = (((new Carbon($item->emi_due_date))->addMonths(1)));
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                                   
                                    if(($item->due_amount/100*2) <=300){
                                        $late_fees = 300;
                                    }else{

                                        $late_fees = floatval(($item->due_amount/100*2));
                                       
                                    }
                                    $oneDayIntrest=  (floatval($item->due_amount)/100 * floatval($item->rate_of_intrest))/30;
                                    $intrest=$oneDayIntrest*$days;
                                     
                                }
                                // $intrest=  intval($item->due_amount)/100 * intval($item->rate_of_intrest);
                                $pay_emi = $item->due_amount;
                                $payble_amount= floatval($item->due_amount+$late_fees+$intrest)+$item->other_charge_amount;

                                // $total_emi_due_amount = $total_emi_due_amount + $item->due_amount;
                                // $total_intrest_amount = $total_intrest_amount + $intrest;

                                $other_charge = $other_charge + $item->other_charge_amount;
                                // dd($other_charge,$payble_amount);
                        ?>
                        
                        <tr>
                            <input type="hidden" name="emi_id[]" value="{{$item->id}}">
                        <input type="hidden" name="pay_emi_amount[]" value="{{$item->emi_amount}}">
                        <input type="hidden" value="{{$item->emi_due_date}}" name="current_emi_date[]" />
                        <!-- <input type="hidden" value="8000" name="current_due_amount" /> -->
                        <input type="hidden" value="{{$item->emi_amount }}" name="emi_amount[]" />
                        <input type="hidden" value="{{date('d-m-Y', strtotime( $due_date))}}" name="next_emi_date[]" />
                        <input type="hidden" value="{{ $payble_amount }}" name="payble_amount[]" />
                        <input type="hidden" value="{{ $payble_amount }}" name="total_payble_amount[]" />
                        <input type="hidden" value="{{$late_fees}}" name="late_fees[]" />
                        <input type="hidden" value="{{$decreement_emi}}" name="decreement_emi[]" />
                        <input type="hidden" value="{{floatval($intrest)}}" name="intrest_amount[]" />


                        <input type="hidden" value="{{floatval($total_emi_due_amount)}}" name="total_emi_due_amount" />
                        <input type="hidden" value="{{floatval($total_intrest_amount)}}" name="total_intrest_amount" />
                        <input type="hidden" value="{{floatval($total_late_fees)}}" name="total_late_fees" />
                        <input type="hidden" value="{{floatval($other_charge)}}" name="total_other_charge" />
                                @endif
                            @endforeach
                          
                          <!-- {{ $other_charge,$payble_amount }} -->
                            <th><span style="font-size:30px">₹{{number_format($total_emi_due_amount + $total_intrest_amount + $total_late_fees+  $other_charge,2)}}</span></th>
                            <th>
                            <button  class="btn  loginbtn"  style=" background:Yellow;" >अभी भुगतान करें</button>
                            </th>
                          </tr>
                              </form>
                                </thead>
                                <tbody>
                                <!-- <tr>
                          <td>Total</td>
                          <td>Amount</td>
                        </tr> -->
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h3 style="color:#5ec372; ">You do not have any pending payment</h3>
                        @endif
                    </div>
          

  </section>


  <div class="back-to-top" title="Go to top"><img src="{{ asset('front/images/gototop-btn.png') }}" alt="go to top btn"></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>

    $(document).ready(function(){
      $('#checkbox').on('click',function(){
        console.log( $('#checkbox').is(':checked'));
        if( $('#checkbox').is(':checked')){
            $('#acceptBtn').css('display','block');
        }else{
          $('#acceptBtn').css('display','none');

        }
      });
    });

    </script>
  @endsection