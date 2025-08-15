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
      @include('front.master.hindi-user-sidebar')
        <div class="col-md-8 col-lg-9">
         
            <h3 class="mb-sm-3">बैंक का विवरण</h3>
            <div class="table-responsive">
                <div class="enquiry-form">
                <form action="../getbankDetail" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                @csrf
            <div class="row">
            
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>बैंक का नाम <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="कृपया अपनी बैंक का नाम दर्ज करें"
                       placeholder="" required name="bank_name" id="bank_name" value="{{$bankDtail?$bankDtail->bank_name:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>शाखा का नाम <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="कृपया अपनी शाखा दर्ज करें " required
                       placeholder=""  name="branch_name" id="branch_name"  value="{{$bankDtail?$bankDtail->branch_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>खाता संख्या    <span>*</span></label>
                      <input type="number" class="form-control" data-parsley-error-message="कृपयाअपना खाता नंबर दर्ज करें"
                       placeholder="" required name="account_number" id="account_number" value="{{$bankDtail?$bankDtail->account_number:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>आईएफएससी कोड <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="कृपया आईएफएससी कोड दर्ज करें"
                       name="ifscCode" id="ifscCode" data-parsley-maxlength="11" data-parsley-type="alphanum"  value="{{$bankDtail?$bankDtail->ifscCode:''}}">
                  </div>
                </div>
                <div class="col-sm-12"><span style="color: #131238; font-size: 13px; ">अन्य विवरण</span></div>

                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>पिता का नाम <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="अपने पिता का नाम दर्ज करें"
                       placeholder="" required name="father_name" id="father_name" value="{{$bankDtail?$bankDtail->father_name:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>माता का नाम <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="अपनी माता का नाम दर्ज करें"
                       name="mother_name" id="mother_name" value="{{$bankDtail?$bankDtail->mother_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>अन्य मोबाइल नंबर</label>
                      <input type="number" class="form-control" data-parsley-error-message="कोई अन्य मोबाइल नंबर दर्ज करें"
                       placeholder="" name="alternate_mobile" id="alternate_mobile" value="{{$bankDtail?$bankDtail->alternate_mobile:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>व्यवसाय <span></span></label>
                      <input type="text" class="form-control" placeholder=""   data-parsley-error-message="अपनी व्यवसाय दर्ज करें"
                       name="profession" id="profession" value="{{$bankDtail?$bankDtail->profession:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>ऋण लेने का कारन </label>
                      <input type="text" class="form-control" data-parsley-error-message="ऋण लेने का कारन दर्ज करें."
                       placeholder=""  name="reason" id="reason" value="{{$bankDtail?$bankDtail->reason:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>नियोक्ता/कम्पनी नाम </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="अपनी कम्पनी का नाम दर्ज करें"
                       name="employer_company_name" id="employer_company_name" value="{{$bankDtail?$bankDtail->employer_company_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>आय/वेतन <span>*</span></label>
                      <input type="number" class="form-control" data-parsley-error-message="अपनी आय दर्ज करें"
                       placeholder="" required name="salary" id="salary" value="{{$bankDtail?$bankDtail->salary:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>जीवनसाथी </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="अपने जीवन शाथी का नाम दर्ज करें"
                       name="spause" id="spause" value="{{$bankDtail?$bankDtail->spause:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>वर्तमान पता <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="कृपया अपना वर्तमान पता दर्ज करें"
                       placeholder="" required name="present_address" id="present_address" value="{{$bankDtail?$bankDtail->present_address:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>पिनकोड <span>*</span></label>
                      <input type="number" class="form-control" placeholder="" required data-parsley-error-message="कृपया अपना पिनकोड दर्ज करें"
                       name="pincode" id="pincode" value="{{$bankDtail?$bankDtail->pincode:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>स्थायी पता <span> </span></label>
                      <input type="text" class="form-control" data-parsley-error-message="अपना स्थायी पता दर्ज करें"
                       placeholder=""   name="permanent_address" id="permanent_address" value="{{$bankDtail?$bankDtail->permanent_address:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>गवाह 1 </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 1."
                       name="witness_1" id="witness_1" value="{{$bankDtail?$bankDtail->witness_1:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>गवाह 2 </label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter Witness 2."
                       placeholder=""  name="witness_2" id="witness_2" value="{{$bankDtail?$bankDtail->witness_2:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>योग्यता <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="अपनी योग्यता दर्ज करें"
                       name="qualification" id="qualification" value="{{$bankDtail?$bankDtail->qualification:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>3 चेक नं. प्राप्त </label>
                      <input type="number" class="form-control" data-parsley-error-message="Please enter 3 Cheque no.  receivedr."
                       placeholder=""  name="cheque_no_received" id="cheque_no_received" value="{{$bankDtail?$bankDtail->cheque_no_received:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>वर्तमान नौकरी में कुल माह की संख्या </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="वर्तमान नौकरी में कुल माह की संख्या दर्ज करें"
                       name="no_of_years_in_present_Job" id="no_of_years_in_present_Job" value="{{$bankDtail?$bankDtail->no_of_years_in_present_Job:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>कंपनी में कर्मचारी की संख्या  </label>
                      <input type="text" class="form-control" data-parsley-error-message="अपनी कंपनी में कुल कर्मचारी की संख्या दर्ज करें"
                       placeholder=""  name="no_of_employee_in_company" id="no_of_employee_in_company" value="{{$bankDtail?$bankDtail->no_of_employee_in_company:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>पारिवारिक आय</label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="अपनी पारिवारिक आय दर्ज करें"
                       name="family_income" id="family_income" value="{{$bankDtail?$bankDtail->family_income:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>अन्य ऋण विवरण </label>
                      <input type="text" class="form-control" data-parsley-error-message="अन्य ऋण दर्ज करें "
                       placeholder=""  name="other_loan_details" id="other_loan_details" value="{{$bankDtail?$bankDtail->other_loan_details:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>किराया चुकाया </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Rent Paid."
                       name="rent_paid" id="rent_paid" value="{{$bankDtail?$bankDtail->rent_paid:''}}">
                  </div>
                </div>
                <div class="col-sm-8 text-right pr-sm-0">
                     <button href="#" class="btnpora btn-rd2 aos-init bdr-radius0">जमा करें</button>
                </div>   
                              
            </div>
          </form>
            
         </div>
            </div>

            

        </div>
        
      </div>
    </div>
  </section>

  


  

  



  <div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
@endsection