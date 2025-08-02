@extends('front.master.master')
@section('main-content')
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="page-banner">
    <div class="image-layer lazy-image">
        <div class="bottom-rotten-curve alternate"></div>
        <div class="auto-container">
            <h1>ऋण विवरण</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">घर</a></li>
                <li class="active">ऋण विवरण</li>
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
                    @if ($loanDetail)
                    
                    <div class="column" style="background-color:#aaa;">
                        <h4>ऋण अवधि</h4>
                        <p>{{$loanDetail?$loanDetail->loan_duration.' Months':''}}</p>
                    </div>
                    <div class="column" style="background-color:#bbb;">
                        <h4>ऋण की राशि</h4>
                        <p>{{$loanDetail?'₹'.$loanDetail->approve_loan_amount:''}}</p>
                    </div>

                    <div class="column" style="background-color:#ccc;">
                        <h4>ब्याज</h4>
                        <p>{{$loanDetail?$loanDetail->interest.'%':''}}</p>
                    </div>
                    <div class="column" style="background-color:#ddd;">
                        <h4>क़िस्त राशि </h4>
                        <p>{{$loanDetail?'₹'.$loanDetail->emi_amount:''}}</p>
                    </div>
                    <!--<div class="column" style="background-color:#aaa;">-->
                    <!--    <h4>प्रोसेसिंग फीस</h4>-->
                    <!--    <p>{{$loanDetail?'₹'.$loanDetail->processing_fees:''}}</p>-->
                    <!--</div>-->

                    <div class="column" style="background-color:#bbb;">
                        <h4>लेन-देन आईडी</h4>
                        <p>{{$loanDetail?$loanDetail->transaction_id:''}}</p>
                    </div>

                    <!--<div class="column" style="background-color:#ccc;">-->
                    <!--    <h4>किस्त तारीख</h4>-->
                    <!--    <p>{{$loanDetail?date('d-m-Y', strtotime($loanDetail->next_emi_date)):''}}</p>-->
                    <!--</div>-->

                    <div class="column" style="background-color:#ddd;">
                        <h4>कुल बकाया राशि</h4>
                        <p>₹{{ $loanDetail?$loanDetail->total_payble_due_amount:'' }}</p>
                    </div>

                    <div class="container">
                        @if($loanDetail->payment_status == "Pending")
                    <form action="pay-emi" method="get" enctype="multipart/form-data" >
                        <!-- @csrf -->
                        <div class="form-group" style="margin-top:20px;display:flex; justify-content:center;">
                            <!-- <a href="applynow.html"> -->
                            <!--<input type="submit" value="किस्त का भुगतान करें" class="btn btn-primary" style="display:flex; justify-content:center;">-->
                            <!-- </a> -->
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
                @endif


</section>
<div class="back-to-top" title="Go to top"><img src="{{ asset('front/images/gototop-btn.png') }}" alt="go to top btn">
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#checkbox').on('click', function() {
        console.log($('#checkbox').is(':checked'));
        if ($('#checkbox').is(':checked')) {
            $('#acceptBtn').css('display', 'block');
        } else {
            $('#acceptBtn').css('display', 'none');

        }
    });
});
</script>
@endsection