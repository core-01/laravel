@extends('front.master.master')
@section('main-content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="page-banner">
        <div class="anim-icons">
      <!-- <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span>
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span> -->
    </div>
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>Apply Loan</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Apply Loan</li>
                </ul>
            </div>
        </div>
</section>

<section class="pt-4 pb-4 about-bg-2">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-12 pr-20">
        <div class="partner-company">
          <!-- <h5 class="mb10" data-aos="fade-up" data-aos-delay="100"><em>What We Serve</em></h5> -->
          
        </div>
        
        <div class="row">
          <!-- <div class="media aos-init aos-animate" data-aos="fade-In" data-aos-delay="100">
              <div class="img-ab-"><img src="{{asset('front/images/icons/customer-service.svg')}}" alt="icon" class="layer"></div>
              <div class="media-body">
                 <h4><em>5 Minutes </em> Policy Issuance</h4>
              </div>
          </div> -->
          
          <div class="col-sm-6">
             <h2 class="d-flex justify-content-between aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><span>Loan <em>Price</em></span></h2>

             <div class="loanprice-stat aos-init aos-animate" data-aos="fade-In" data-aos-delay="300">
                <ul>
                    <li><i class="fas fa-check"></i> Rate of Interest: 36% to 48% per annum reducing basis.</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> Processing fee: 3% loan amount will be transfer post deduction of 3%</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> Late fee: 2% or ₹300 whichever is higher + 3% interest Per month on delayed payment</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> Legal Fee: As per acutal charged to company.</li>
                    <li><i class="fas fa-check"></i> Cheque Bounce: Rs.400</li>
                    <li><i class="fas fa-check"></i> NACH Fail: Rs.100</li>
                </ul>
                <ul>

                    <li><i class="fas fa-check"></i> Early payment/part payment: NIL/zero</li>
                </ul>
             </div>
          </div>


          <div class="col-sm-6 px-5">
            <a id="applyform" style="position: absolute; top: -100px;">.</a>
             <h2 class="d-flex justify-content-between aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><span>Apply <em>Form</em></span></h2>
             <form action="applyloan" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                @csrf

                <input type="hidden" value="website" name="source" >
             <div class="row">
                <div class="col-sm-12">
                   <div class="formrow formrow2 mt-3">
                      <label>Your Name <span>*</span></label>
                      <input type="text" class="form-control" placeholder="Your Name"  value="{{old('name')}}"
                      name="name" required data-parsley-error-message="Please enter full name."
                      >
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Email (optional)</label>
                      <input type="email" class="form-control" name="email"placeholder="Email" value="{{old('email')}}"
                       data-parsley-error-message="This email not valid.">
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Mobile <span>*</span></label>
                      <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}"
                       placeholder="Mobile" data-parsley-length="[10, 10]"
                      required data-parsley-error-message="Please provide valid 10-digit mobile number.">
                   </div>
                </div>                         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                    
                      <label>Bank Statement (1 year) <span>*</span><span style="font-size: 10px;color: black;">(Multiple)</span></label>
                      <input id="files" multiple="true" class="form-control" name="files[]" type="file" accept="image/jpg,pdf" />
                      <!-- <a class="button form-control" href="#popup1">Click</a> -->
                      <span id="bank_statement"></span>
                      <!-- <input type="hidden" class="form-control" name="bank_statement[]"
                      required data-parsley-error-message="upload bank statement."> -->
                      <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                      <div id="list11" style="display: block;"></div>
                   </div>
                 </div>         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Aadhar Card <span>*</span><span style="font-size: 10px;color: black;">(Front side, Back Side)</span></label>
                     <!--  <a class="button form-control" href="#popup11">Click</a> -->
                     <input id="files1" multiple="true" class="form-control" name="files1[]" type="file" accept="image/jpg,pdf" />
                      <span id="adhar_card"></span>
                      <!-- <input type="hidden" class="form-control" name="adhar_card[]" accept="image/jpg,pdf"
                       required data-parsley-error-message="upload adhar card."> -->
                       <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                       <div id="list22" style="display: block;"></div>
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Passport Size Photo <span>*</span></label>
                      <input type="file" class="form-control" name="photo" required data-parsley-error-message="upload photo.">
                      <span style="color:green; font-size:12px; padding-top:-50px;">only jpg, jpeg.</span>
                    </div>
                 </div>  

                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Pan Image <span>*</span></label>
                      <input type="file" class="form-control" accept="image/jpg,pdf" name="pan_card" required data-parsley-error-message="upload pan card.">
                      <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                    </div>
                 </div>

                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Required Loan Amount (₹) <span>*</span></label>
                      <input type="text" class="form-control" placeholder="₹10000" value="{{old('loan_amount')}}"
                       name="loan_amount" required data-parsley-error-message="Enter required amount.">
                   </div>
                 </div> 

                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                     <label>PAN Number <span>*</span></label>
                     <input type="text" class="form-control" placeholder="ABCDE1234F" value="{{ old('pan_number') }}"
                     name="pan_number" required data-parsley-error-message="Enter a valid PAN number.">
                   </div>
                 </div> 

                 <div class="formrow formrow2 mt-3">
                    <label>Aadhar Number <span>*</span></label>
                    <input type="text" class="form-control" placeholder="2032 3218 9561 " value="{{ old('aadhar_number') }}"
                    name="aadhar_number" required data-parsley-error-message="Enter a valid AAdhar number.">
                  </div>
                     
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Existing loan EMI amount (If any) <span>*</span></label>
                      <input type="text" class="form-control" placeholder=""
                      value="{{old('existing_emi')}}"  name="existing_emi">
                   </div>
                 </div>
                 <div class="col-sm-8 offset-sm-4 text-right formrow2">
                     <button href="#" class="btnpora btn-rd2 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">Submit</button>
                  </div>
             </div>
            </form>
          </div>





        </div>
      </div>

    </div>
  </div>
</section>

<div class="enquire-form pad-tb pora-bg1 text-white whychooseus my-5">
            
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="cta-heading text-center"> <span class="subhead aos-init" data-aos="fade-up" data-aos-delay="100">How we work?</span>
                  
                </div>

                <!-- start -->
                <div class="row work-box">
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="one"><span>1</span></div>
                        <div class="box-icon-home">
                            <figure><img src="{{asset('front/images/how-icon1.png')}}" alt=""></figure>
                        </div>
                        <p>Ease of Applying</p>
                    </div>
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="one"><span>2</span></div>
                        <div class="box-icon-home">
                            <figure><img src="{{asset('front/images/how-icon3.png')}}" alt=""></figure>
                        </div>
                        <p>Instant Decisions</p>
                    </div>
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="one"><span>3</span></div>
                        <div class="box-icon-home box-icon-last-after">
                            <figure><img src="{{asset('front/images/how-icon2.png')}}" alt=""></figure>
                        </div>
                        <p>Quick Disbursement</p>
                    </div>
                </div>
                <!-- end -->
              </div>
            </div>
          </div>          
</div>

<!-- emi start -->
<!--// loan calculator -->
<!-- <div class="container"> -->
          <div class="row loan-calculator">
            <div class="col-sm-6">
                <h3 class="font-weight-bold knowEmiHeading">Know your EMI</h3>

                <div class="ps-3 loanSlider1 pr-3">
                    <label for="amountRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>Loan Amount</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end " id="amountInput" placeholder="00000" size="4" onkeyup="$('#amountRange').val(this.value);" min="1000" max="9900000" step="1000" value="100000">
                    </label>

                    <input type="range" class="progress" id="amountRange" oninput="$('#amountInput').val(this.value);" onchange="$('#amountActual').val(this.value);" value="100000" min="1000" max="9900000" step="1000">
                    <!-- <input type="range" class="form-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all progress"> -->
                    <!-- <div class="row">
                      <div class="col-6 ps-0 text-start"><span class="rupee small">1 Lac</span></div>
                      <div class="col-6 pe-0 text-end"><span class="rupee small">10 Cr</span></div>
                    </div> -->
                </div>
                <div class="ps-3 tenure my-4 pr-3">
                    <label for="tenureRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>Tenure (Years)</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="tenureInput" placeholder="00000" size="1" onkeyup="$('#tenureRange').val(this.value);" min="1" max="30" step="1" value="1">
                    </label>
                    <input type="range" class="form-range progress" id="tenureRange" oninput="$('#tenureInput').val(this.value);" onchange="$('#tenureInput').val(this.value);" value="1" min="1" max="30" step="1">
                    
                </div>
                <div class="ps-3 interest pr-3">
                    <label for="interestRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>Interest Rate (% P.A.)</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="interestInput" placeholder="00000" size="1" onkeyup="$('#interestRange').val(this.value);" min="0" max="15" value="6.7">
                    </label>
                    <input type="range" class="form-range progress" id="interestRange" oninput="$('#interestInput').val(this.value);" onchange="$('#interestInput').val(this.value);" value="6.7" min="0" max="15" step="1">
                    
                </div>
            </div>
            <div class="col-sm-6">
             
                <div class="text-center loan-emi-box text-dark">
                  <div class="klc-amount-inner p-lg-4 p-3">
                     <div class="total-calculation">
                        <div class="single-total">
                           <h4 class="mb-lg-3 mb-4"><span>Monthly EMI</span></h4>
                            <h2 class="emi-price" style="color: #1e40a2;">₹ <span id="monthlyEMI"></span></h2>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">Principle Amount</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="principleAmount" class="float-right">0</span></h6>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">Interest Amount</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="interestAmount" class="float-right">0</span></h6>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">Total Amount Payable</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="totalAmountPayable" class="float-right"></span></h6>
                        </div>

                        <div>
                           <a href="#applyform" class="btn klc-btn">Apply Now</a>
                        </div>
                     </div>
                  </div>
               </div>
            
            </div>
        </div> 
  <!-- </div> -->
<!-- emi end -->


          
          <!-- loan calculator //-->

          


<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script  src="{{asset('front/script.js')}}"></script>
<!-- emi end -->



<section class="pad-tb pt-0">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
          <div class="loansecond-cont aos-init aos-animate" data-aos="fade-left">
             <h5>Documanet Required</h5>
             <ul class="docreq-list">
                  <li><i class="fas fa-check-square"></i> 1 year bank statement </li>
                  <li><i class="fas fa-check-square"></i> 2 photo</li>
                  <li><i class="fas fa-check-square"></i> Address proof</li>
                  <li><i class="fas fa-check-square"></i> Pan</li>
                  <li><i class="fas fa-check-square"></i> 3 blank cheque with sign post loan approval</li>
                  <li><i class="fas fa-check-square"></i> 2 guarantor/witness</li>
                  <li><i class="fas fa-check-square"></i> Amount 10000 to Rs. 50000-</li>
                  <li><i class="fas fa-check-square"></i> Roi - 36-48% PA reducing </li>
                  <li><i class="fas fa-check-square"></i> Other documents can be requested as per applicant profile
             </ul>

          </div>
      </div>

      <div class="col-sm-6">
          <div class="loansecond-cont aos-init aos-animate" data-aos="fade-left">
             <h5>Eligibility </h5>
             <ul class="docreq-list">
                  <li><i class="fas fa-check-square"></i> In last 5 month - 4 salary should be credited in bank </li>
                  <li><i class="fas fa-check-square"></i> Your existing loan EMI should not be more than 50% of your salary</li>
                  <li><i class="fas fa-check-square"></i> You must have Delhi/NCR address proof</li>
                  <li><i class="fas fa-check-square"></i> Monthly salary must be greater than 9k</li>
                  <li><i class="fas fa-check-square"></i> You must have PAN Card
             </ul>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="pad-tb pt-0">
  <div class="container">
    <div class="col-sm-10 offset-sm-1">
         <div class="loan-otp">
             <div class="row">
                <div class="col-sm-12 col-md-6">
                    <img src="{{asset('front/images/girl-img.png')}}" style="max-width: 100%;" class="aos-init aos-animate" data-aos="fade-right">
                </div>
                <div class="col-sm-12 col-md-6">
                    <h4 class="aos-init aos-animate" data-aos="fade-down">Need Loan?</h4>
                    <h6 class="aos-init aos-animate" data-aos="fade-up">Are you looking for loan? click on the button below to start.</h6>
                    <div class="otpfiled">
                         <a href="{{ route('apply-loan') }}" class="btnpora btn-rd2 aos-init aos-animate" data-aos="fade-up">Apply Now For Loan</a>
                    </div>

                </div>
             </div>

              
         </div>      
    </div>
  </div>
  <div class="back-to-top" title="Go to top">
      <img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn">
  </div>
</section>

@endsection
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script>

   var drop = $("input");
drop
  .on("dragenter", function (e) {
    $(".drop").css({
      border: "4px dashed #09f",
      background: "rgba(0, 153, 255, .05)"
    });
    $(".cont").css({
      color: "#09f"
    });
  })
  .on("dragleave dragend mouseout drop", function (e) {
    $(".drop").css({
      border: "3px dashed #DADFE3",
      background: "transparent"
    });
    $(".cont").css({
      color: "#8E99A5"
    });
  });

$(document).ready(function () {
function handleFileSelect(evt) {
  var files = evt.target.files; // FileList object

  // ajax
  if (files[0].type.match("image.*") || files[0].type.match("pdf")){
        var fd = new FormData();
        var filesData =  $('#files')[0].files;
        fd.append('file',filesData[0]);
        fd.append('_token',"{{ csrf_token() }}");

          $.ajax({
              url: "{{url('/upload-pdf')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                var ap = `
                <div onclick="return $(this).remove();"">
                ${res.substring(15)} <span style="color:red">X</span>  
                <input type="hidden" name="bank_statement[]" value="${res}">
                </div>
                `
                $('#bank_statement').append(ap);
              },
              error: function(data){
                  console.log(data);
              }     
          });
    // ajax end
  }
}

$("#files").change(handleFileSelect);

function handleFileSelect1(evt) {
  var files1 = evt.target.files; // FileList object
  
  // ajax
  if (files1[0].type.match("image.*") || files1[0].type.match("pdf")){
        var fd = new FormData();
        var filesData11 =  $('#files1')[0].files;
        fd.append('file',filesData11[0]);
        fd.append('_token',"{{ csrf_token() }}");

          $.ajax({
              url: "{{url('/upload-image')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                var ap = `
                <div onclick="return $(this).remove();"">
                ${res.substring(8)} <span style="color:red">X</span>   
                <input type="hidden" name="adhar_card[]" value="${res}">
                </div>
                `
                $('#adhar_card').append(ap);

              },
              error: function(data){
                  console.log(data);
              }     
          });
    // ajax end
  }
}

$("#files1").change(handleFileSelect1);
  });
</script>