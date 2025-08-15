@extends('front.master.master')
@section('main-content')
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
         
            <h3 class="mb-sm-3">User Detail</h3>
            <div class="table-responsive">
                <div class="enquiry-form">
                <form action="../getbankDetail" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                @csrf
            <div class="row">
                <div class="col-sm-12"><span style="color: #131238; font-size: 13px; ">Banking Details</span></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Bank Name <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter bank name."
                       placeholder="" required name="bank_name" id="bank_name" value="{{$bankDtail?$bankDtail->bank_name:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Branch Name <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter branch name." required
                       placeholder=""  name="branch_name" id="branch_name"  value="{{$bankDtail?$bankDtail->branch_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Account Number <span>*</span></label>
                      <input type="number" class="form-control" data-parsley-error-message="Please enter account number."
                       placeholder="" required name="account_number" id="account_number" value="{{$bankDtail?$bankDtail->account_number:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>IFSC Code <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="Enter IFSC code."
                       name="ifscCode" id="ifscCode" data-parsley-length="[11,11]" data-parsley-type="alphanum"  value="{{$bankDtail?$bankDtail->ifscCode:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label> Cheque no. </label>
                      <input type="number" class="form-control" data-parsley-error-message="Please enter 3 Cheque no.  receivedr."
                       placeholder=""  name="cheque_no_received" id="cheque_no_received" value="{{$bankDtail?$bankDtail->cheque_no_received:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-12"><span style="color: #131238; font-size: 13px; ">Other Detail</span></div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Father Name <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="Enter Father Name."
                       placeholder="" required name="father_name" id="father_name" value="{{$bankDtail?$bankDtail->father_name:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Mother Name <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="Enter Mother Name"
                       name="mother_name" id="mother_name" value="{{$bankDtail?$bankDtail->mother_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Alternate Mobile<span>*</span></label>
                      <input type="number" class="form-control" data-parsley-error-message="Please enter alternate mobile."
                       placeholder="" name="alternate_mobile" id="alternate_mobile" value="{{$bankDtail?$bankDtail->alternate_mobile:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Profession <span></span></label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Profession."
                       name="profession" id="profession" value="{{$bankDtail?$bankDtail->profession:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Reason </label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter Reason."
                       placeholder=""  name="reason" id="reason" value="{{$bankDtail?$bankDtail->reason:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Employer/company name </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Employer/company name."
                       name="employer_company_name" id="employer_company_name" value="{{$bankDtail?$bankDtail->employer_company_name:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Income/salary <span>*</span></label>
                      <input type="number" class="form-control" data-parsley-error-message="Please enter salary."
                       placeholder="" required name="salary" id="salary" value="{{$bankDtail?$bankDtail->salary:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Spause </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter spause."
                       name="spause" id="spause" value="{{$bankDtail?$bankDtail->spause:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Present Address <span>*</span></label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter Present Address."
                       placeholder="" required name="present_address" id="present_address" value="{{$bankDtail?$bankDtail->present_address:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Pin Code <span>*</span></label>
                      <input type="number" class="form-control" placeholder="" required data-parsley-error-message="Enter Pin Code."
                       name="pincode" id="pincode" value="{{$bankDtail?$bankDtail->pincode:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Permanent Address </label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter Permanent Address."
                       placeholder=""  name="permanent_address" id="permanent_address" value="{{$bankDtail?$bankDtail->permanent_address:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-12"><span style="color: #131238; font-size: 13px; ">Guarantor 1 Details</span></div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Witness Name 1 </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 1."
                       name="witness_1" id="witness_1" value="{{$bankDtail?$bankDtail->witness_1:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Contact Number</label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 1."
                       name="witness_1_contact_det" id="witness_1" value="{{$bankDtail?$bankDtail->witness_1_contact_det:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Address </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 1."
                       name="witness_1_address" id="witness_1" value="{{$bankDtail?$bankDtail->witness_1_address:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label> Relation </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 1."
                       name="witness_1_relation" id="witness_1" value="{{$bankDtail?$bankDtail->witness_1_relation:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-12"><span style="color: #131238; font-size: 13px; ">Guarantor 2 Details</span></div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Witness Name 2 </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 2."
                       name="witness_2" id="witness_2" value="{{$bankDtail?$bankDtail->witness_2:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Contact Number</label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 2."
                       name="witness_2_contact_det" id="witness_2" value="{{$bankDtail?$bankDtail->witness_2_contact_det:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Address </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 2."
                       name="witness_2_address" id="witness_2" value="{{$bankDtail?$bankDtail->witness_2_address:''}}">
                  </div>
                </div>
                
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label> Relation </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Witness 2."
                       name="witness_2_relation" id="witness_2" value="{{$bankDtail?$bankDtail->witness_2_relation:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Qualification <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" required data-parsley-error-message="Enter Qualification."
                       name="qualification" id="qualification" value="{{$bankDtail?$bankDtail->qualification:''}}">
                  </div>
                </div> 
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>No. of years in present Job </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter No. of Month in present Job."
                       name="no_of_years_in_present_Job" id="no_of_years_in_present_Job" value="{{$bankDtail?$bankDtail->no_of_years_in_present_Job:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>No. of employee in company  </label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter No. of employee in company."
                       placeholder=""  name="no_of_employee_in_company" id="no_of_employee_in_company" value="{{$bankDtail?$bankDtail->no_of_employee_in_company:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Family Income </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Family Income."
                       name="family_income" id="family_income" value="{{$bankDtail?$bankDtail->family_income:''}}">
                  </div>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Other loan details </label>
                      <input type="text" class="form-control" data-parsley-error-message="Please enter Other loan details."
                       placeholder=""  name="other_loan_details" id="other_loan_details" value="{{$bankDtail?$bankDtail->other_loan_details:''}}">
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Rent Paid </label>
                      <input type="text" class="form-control" placeholder=""  data-parsley-error-message="Enter Rent Paid."
                       name="rent_paid" id="rent_paid" value="{{$bankDtail?$bankDtail->rent_paid:''}}">
                  </div>
                </div>
                <div class="col-sm-8 text-right pr-sm-0">
                     <button href="#" class="btnpora btn-rd2 aos-init bdr-radius0">Submit</button>
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