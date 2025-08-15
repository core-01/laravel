@extends('front.master.master')
@section('main-content')

<style>
.tnc-btn{
    float: left;
    display: flex;
    border-radius: 8%;
    background: #51a1e6;
    padding: 5px;
    border: none;
}
</style>
  <section class="page-banner">
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>User Dashboard</h1>
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
       @include('front.master.english-user-sidebar')
        <div class="col-md-8 col-lg-9">
            <h3>Welcome {{Session::get('customer')->costomer_name}}!</h3>
            
            @if ($bankDtail)
                             @php
                          $loanRequest = DB::table('loan_requests')->where('loan_request_number',$bankDtail->loan_request_number)
                          ->select('user_status','term_and_condition','user_accept_t_N_c')->first(); 
                     @endphp
                    @if ($loanDetail && $loanDetail->procces_status_btn=="Processed" && $loanRequest->user_accept_t_N_c =="Accepted") 

                    <?php

                          $emi_due = DB::table('genrate_emis')->where(['loan_request_number'=>Session::get('customer')->loan_request_number, 'payment_status'=>'Pending'])->orderBy('id','desc')->first();
                          $emi_generated = DB::table('genrate_emis')->where(['loan_request_number'=>Session::get('customer')->loan_request_number])->count(); 
 
                          ?>
                          @if ($emi_generated>0)
                                @if ($emi_due)
                                <h4 style="color:red"> Your installment payment of Rs {{$emi_due?number_format(($emi_due->due_amount+$emi_due->due_other_charge),2):''}} is due on {{$emi_due?date('d/M/Y',strtotime($emi_due->emi_due_date)):''}}. Keep money in the account and avoid penalties.</h4>
                                @endif
                          @else
                          <h4 style="color:green"> Your processed successfully please check your account.<h4>

                          @endif
                   @else 
                    

                        @if ($loanRequest->user_status == "Accepted" && $loanRequest->term_and_condition == "")
                        <h4 style="color:green">Please wait for 24-48 hrs for the loan Terms and Conditions.</h4>
                         
                        @elseif ($loanRequest->user_status == "Accepted" && $loanRequest->term_and_condition != "" && $loanRequest->user_accept_t_N_c == "")
                        <?php
                          $profile =DB::table('loan_requests')->where('loan_request_number',Session::get('customer')->loan_request_number)->orderBy('id','desc')->first();
                            ?>

                                  <div class="col-lg-11">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $profile?$profile->name:'' }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Father Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $profile?$profile->father_name:'' }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $profile?$profile->email:'' }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Mobile</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $profile?$profile->mobile:'' }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Present Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $profile?$profile->present_address:'' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-body">
                                          <form action="user-accept-tNc" method="post" data-parsley-validate>
                                            @csrf
                                            <p>
                                        
                                                      <input type="checkbox" value="accept" id="checkbox" name="term_and_condition" required data-parsley-error-message="Please accept term and conditions."> I agree with all
                                                      <a href="{{url('upload/tNc',[$loanRequest->term_and_condition]) }}" target="_blank"  >terms and conditions</a></p>  
                                                  


                                                <div class="row">
                                                    <div class="col-sm-11">
                                                      <input type="submit" class="tnc-btn" value="I Accept" />
                                                    </div>
                                                </div>

                                                </form>

                    
                    
                      </div>
                          @else
                          <h4 style="color:green"> – Your application processed successfully. Loan details will reflect post review of application and further verification.</h4>
                        @endif 
             @endif
            
           
                
            
            @endif

            @if (!$bankDtail)
            @if ($loanDetail)
              
          
            <h5 class="mt-sm-2 mb-sm-2">Applied Loan Details </h5>
            <div class="table-responsive">
                <table class="table table-hover tbl tbl">
                    <thead>
                      <tr>
                        <th>Parameter</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Amount approved</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->approve_loan_amount:'' }}</td>
                      </tr>
                      <tr>
                        <td>Loan Duration</td>
                        <td>{{ $loanDetail?$loanDetail->loan_duration:'' }} Months</td>
                      </tr>
                      <tr>
                        <td>Effective annualized interest rate (in %) - reducing balance method</td>
                        <td>{{ $loanDetail?$loanDetail->interest.'%':'' }}</td>
                      </tr>

                      <tr>
                        <td> Total interest charge during the entire tenure of the loan (in Rupees) </td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->total_interest_charge:'' }}</td>
                      </tr>
                      <tr>
                        <td>EMI Amount (in Rupees)</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->emi_amount:'' }}</td>
                      </tr>
                      <tr>
                        <td>Other up-front charges (break-up of each component to be given below) (in Rupees)</td>
                        <td>{{$loanDetail?'₹'.$loanDetail->up_front_charges:''}}</td>
                      </tr>
                      <tr>
                        <td>Processing fees (in Rupees)</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->processing_fees:'' }}</td>
                      </tr>
                      <tr>
                        <td>Others charge {{$loanDetail && $loanDetail->other_charge_reason?"(".$loanDetail->other_charge_reason.")":''}} (in Rupees)</td>
                        <td>{{$loanDetail?'₹'.$loanDetail->other_charge:''}}</td>
                      </tr>
                      
                    </tbody>
              </table>
            </div>
      <form action="apply-now" method="post" enctype="multipart/form-data" id="form">
        @csrf
            <!-- <p><input type="checkbox" value="accept" id="checkbox" name="checkbox" required data-parsley-error-message="Please accept term and conditions."> I agree with all <a href="#" data-toggle="modal" data-target="#exampleModal2" >terms and conditions</a></p> -->

            <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                              <div class="col-sm-12">
                                  <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>

                                  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                                  <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>

                                  <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>

                                  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                                  <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>

                                  <!-- <div class="form-group">
                                    <a href="applynow.html">
                                      <input type="submit" value="Apply Now" class="btn btn-success float-right"></a>
                                  </div> -->
                              </div>
                          </div>
                           
                        </div>                  
                      </div>
                    </div>
                  </div>
        </div>
       </div>
              <div class="form-group" style="margin-bottom:20px;" >
                <!-- <a href="applynow.html"> -->
                <input type="submit" value="Continue" class="btn btn-success float-right"  id="acceptBtn">
              <!-- </a> -->
                </div>
    </div>
</form>
@endif
@endif

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