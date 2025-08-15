@extends('front.master.master')
@section('main-content')

<?php
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
</style>
<section class="page-banner">
    <div class="image-layer lazy-image">
        <div class="bottom-rotten-curve alternate"></div>
        <div class="auto-container">
            <h1>Payment detail</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class="active">Payment detail</li>
            </ul>
        </div>
    </div>
</section>

<section class="about-bg pt-5 pb-5" style="background: transparent;">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-8 offset-sm-2 aos-animate" data-aos="fade-up">
                <div class="row">

                    @if ($loanDetail)

                    <?php
                        $late_fees=0;
                        $secondEmi=0;
                        $secondEmi_intrest=0;
                        $decreement_emi =1;
                        $due_date=date('d-m-Y',strtotime($loanDetail->next_emi_date));
                        $intrest =  $loanDetail->emi_amount/100*$loanDetail->interest;

                                    $to =Carbon::parse($loanDetail->next_emi_date);

                        if($to->toDateString() < date('Y-m-d')){
                            $due_date = (((new Carbon($loanDetail->next_emi_date))->addMonths(1)));
                           
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                            // dd(($loanDetail->emi_amount/100*2)*$days);

                                    if(($loanDetail->emi_amount/100*2) <=300){
                                        $late_fees = 300;
                                    }else{

                                        $late_fees = intval(($loanDetail->emi_amount/100*2) );
                                        
                                    }
                                    if($loanDetail->due_emi > 1){
                                    $decreement_emi =2;
                                    $secondEmi = $loanDetail->emi_amount;
                                    $secondEmi_intrest = $loanDetail->emi_amount/100*$loanDetail->interest;
                                    }
                                    // dd($days);
                                }
                                $intrest=  $intrest +$secondEmi_intrest;
                                $pay_emi = $loanDetail->emi_amount + $secondEmi;
                                $payble_amount= $loanDetail->emi_amount+$late_fees+$intrest+$secondEmi;
                        ?>


                    <form action="../customer-paidEmi" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pay_emi_amount" value="{{$loanDetail->emi_amount}}">
                        <input type="hidden" value="{{$loanDetail->next_emi_date}}" name="current_emi_date" />
                        <!-- <input type="hidden" value="8000" name="current_due_amount" /> -->
                        <input type="hidden" value="{{$loanDetail?$loanDetail->emi_amount:''}}" name="emi_amount" />
                        <input type="hidden" value="{{date('d-m-Y', strtotime( $due_date))}}" name="next_emi_date" />
                        <input type="hidden" value="{{ $payble_amount }}" name="payble_amount" />
                        <input type="hidden" value="{{$late_fees}}" name="late_fees" />
                        <input type="hidden" value="{{$decreement_emi}}" name="decreement_emi" />

                        <div class="column" style="background-color:#aaa;">
                            <h4>EMI Amount</h4>
                            <p>{{$pay_emi}}</p>
                        </div>

                        <?php 
                       
                    ?>

                        <div class="column" style="background-color:#bbb;">
                            <h4>Intrest</h4>
                            <p>₹{{ $intrest }}</p>
                        </div>
                      
                        <div class="column" style="background-color:#ccc;">
                            <h4>Late fee</h4>
                            <p>₹{{ $late_fees }}</p>
                        </div>

                        <div class="column" style="background-color:#ddd;">
                            <h4>Due Date</h4>
                            <p>{{$loanDetail?date('d-m-Y',strtotime($loanDetail->next_emi_date)):''}}</p>

                        </div>

                        <!-- <div class="column" style="background-color:#ddd;">
                            <h4>Due Amount</h4>

                            <p>₹8000</p>
                        </div> -->


                        <div class="column" style="background-color:#aaa;">
                            <h4>Payble Amount</h4>

                            <p>₹{{$payble_amount}}</p>
                        </div>

                        
                        </div>


                        <div class="container">

                        <div class="form-group" style="margin-top:20px;display:flex; justify-content:center;">
                            <!-- <a href="applynow.html"> -->
                            <input type="submit" value="Pay Now" class="btn btn-primary" style="display:flex; justify-content:center;">
                            <!-- </a> -->
                        </div>
                        </div>
                </div>
                </form>
                @endif


            </div>

        </div>
</section>

<div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn">
</div>
@endsection