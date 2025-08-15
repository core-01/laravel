@extends('front.master.master')
@section('main-content')
  <section class="page-banner">
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>उपयोगकर्ता डैशबोर्ड</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="{{ route('index') }}">घर</a></li>
          <li class="active">उपयोगकर्ता डैशबोर्ड</li>
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
          
            <?php
        //   dd(Session::get('customer'));
          $emi_due = DB::table('genrate_emis')->where(['loan_request_number'=>Session::get('customer')->loan_request_number, 'payment_status'=>'Pending'])->orderBy('id','desc')->first();
            $emi_genrated = DB::table('genrate_emis')->where(['loan_request_number'=>Session::get('customer')->loan_request_number])->count();
            // dd($emi_due);
          ?>
      @include('front.master.hindi-user-sidebar')
        <div class="col-md-8 col-lg-9">
            <h3>आपका स्वागत है {{Session::get('customer')->costomer_name}}!</h3>
            @if ($bankDtail)
            
             @if ($emi_due)
               <h4 style="color:red">
                    आपके  ₹{{$emi_due?number_format(($emi_due->due_amount+$emi_due->due_other_charge),2):''}} रुपये किश्त का भुगतान  {{$emi_due?date('d/M/Y',strtotime($emi_due->emi_due_date)):''}} को देय है। खाते में पैसा रखें और जुर्माने से बचें |
                     </h4>
             @elseif($emi_genrated>0)
             
              @else 
            <h4 style="color:green">{{$loanDetail && $loanDetail->procces_status_btn=="Processed"?'आपकी प्रक्रिया सफलतापूर्वक पूरी हो गई है, कृपया अपने खाते की जाँच करें|':'– आपका आवेदन सफलतापूर्वक संसाधित किया गया। ऋण विवरण आवेदन की समीक्षा और आगे के सत्यापन को दर्शाएगा।'}}</h4>
                 @endif
            
            @endif

            @if (!$bankDtail)
            @if ($loanDetail)
              
          
            <h5 class="mt-sm-2 mb-sm-2">लागू ऋण विवरण </h5>
            <div class="table-responsive">
                <table class="table table-hover tbl tbl">
                    <thead>
                      <tr>
                        <th>पैरामीटर</th>
                        <th>जानकारी</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>स्वीकृत राशि</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->approve_loan_amount:'' }}</td>
                      </tr>
                      <tr>
                        <td>ऋण अवधि</td>
                        <td>{{ $loanDetail?$loanDetail->loan_duration:'' }} Months</td>
                      </tr>
                      <tr>
                        <td>प्रभावी वार्षिक ब्याज दर (% में) - शेष राशि को कम करना</td>
                        <td>{{ $loanDetail?$loanDetail->interest.'%':'' }}</td>
                      </tr>

                      <tr>
                        <td> ऋण की पूरी अवधि के दौरान कुल ब्याज प्रभार (रुपये में) </td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->total_interest_charge:'' }}</td>
                      </tr>
                      <tr>
                        <td>किश्त राशि (रुपये में)</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->emi_amount:'' }}</td>
                      </tr>
                      <tr>
                        <td>अन्य अप-फ्रंट शुल्क (प्रत्येक घटक का ब्रेक-अप नीचे दिया गया है) (रुपये में)</td>
                        <td>{{$loanDetail?'₹'.$loanDetail->up_front_charges:''}}</td>
                      </tr>
                      <tr>
                        <td>प्रोसेसिंग फीस (रुपये में)</td>
                        <td>{{ $loanDetail?'₹'.$loanDetail->processing_fees:'' }}</td>
                      </tr>
                      <tr>
                        <td>अन्य {{$loanDetail && $loanDetail->other_charge_reason?"(".$loanDetail->other_charge_reason.")":''}}  (रुपये में)</td>
                        <td>{{$loanDetail?'₹'.$loanDetail->other_charge:''}}</td>
                      </tr>
                      
                    </tbody>
              </table>
            </div>
      <form action="apply-now" method="post" enctype="multipart/form-data" id="form">
        @csrf
            <p><input type="checkbox" value="accept" id="checkbox" name="checkbox" required data-parsley-error-message="Please accept term and conditions."> मैं सभी <a href="#" data-toggle="modal" data-target="#exampleModal2" >नियमों और शर्तों</a> से सहमत हूं</p>

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
                <input type="submit" value="I accept" class="btn btn-success float-right" style="display:none;" id="acceptBtn">
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