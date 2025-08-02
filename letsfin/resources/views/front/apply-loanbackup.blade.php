@extends('front.master.master')
@section('main-content')
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
                    <li><a href="index.html">Home</a></li>
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
             <div class="row">
                <div class="col-sm-12">
                   <div class="formrow formrow2 mt-3">
                      <label>Your Name <span>*</span></label>
                      <input type="text" class="form-control" placeholder="">
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Email (optional)</label>
                      <input type="text" class="form-control" placeholder="">
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Mobile <span>*</span></label>
                      <input type="text" class="form-control" placeholder="">
                   </div>
                </div>                         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Bank Statement (1 year) <span>*</span></label>
                      <input type="file" class="form-control" placeholder="">
                   </div>
                 </div>         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Aadhar Card <span>*</span></label>
                      <input type="file" class="form-control" placeholder="">
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Passport Size Photo <span>*</span></label>
                      <input type="file" class="form-control" placeholder="">
                   </div>
                 </div>         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Pan Image <span>*</span></label>
                      <input type="file" class="form-control" placeholder="">
                   </div>
                 </div>

                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Required Loan Amount (₹) <span>*</span></label>
                      <input type="text" class="form-control" placeholder="">
                   </div>
                 </div>        
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>Existing loan EMI amount (If any) <span>*</span></label>
                      <input type="text" class="form-control" placeholder="">
                   </div>
                 </div>
                 <div class="col-sm-8 offset-sm-4 text-right formrow2">
                     <a href="#" class="btnpora btn-rd2 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">Submit</a>
                  </div>



             </div>


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
<section id="calculator" class="loan-calculator">
         <div class="container">
            <!--// loan calculator -->
          <div class="row loan-calculator shadow py-4">
            <div class="col-6">
              <div class="ps-3 amount">
                <label for="amountRange" class="form-label d-flex justify-content-between align-items-start">
                  <span>Loan Amount</span>
                  <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="amountInput" placeholder="00000" size="4" onkeyup="$('#amountRange').val(this.value);" min="1000" max="9900000" step="1000" value="100000">
                </label>
                <input type="range" class="form-range" id="amountRange" oninput="$('#amountInput').val(this.value);" onchange="$('#amountActual').val(this.value);" value="100000" min="1000" max="9900000" step="1000">
                <div class="row">
                  <div class="col-6 ps-0 text-start"><span class="rupee small">1 Lac</span></div>
                  <div class="col-6 pe-0 text-end"><span class="rupee small">10 Cr</span></div>
                </div>
              </div>
              <div class="ps-3 tenure my-4">
                <label for="tenureRange" class="form-label d-flex justify-content-between align-items-start">
                  <span>Tenure (Years)</span>
                  <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="tenureInput" placeholder="00000" size="1" onkeyup="$('#tenureRange').val(this.value);" min="1" max="30" step="1" value="1">
                </label>
                <input type="range" class="form-range" id="tenureRange" oninput="$('#tenureInput').val(this.value);" onchange="$('#tenureInput').val(this.value);" value="1" min="1" max="30" step="1">
                <div class="row">
                  <div class="col-6 ps-0 text-start"><span class="small">1</span></div>
                  <div class="col-6 pe-0 text-end"><span class="small">30</span></div>
                </div>
              </div>
              <div class="ps-3 interest">
                <label for="interestRange" class="form-label d-flex justify-content-between align-items-start">
                  <span>Interest Rate (% P.A.)</span>
                  <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="interestInput" placeholder="00000" size="1" onkeyup="$('#interestRange').val(this.value);" min="0" max="15" value="6.7">
                </label>
                <input type="range" class="form-range" id="interestRange" oninput="$('#interestInput').val(this.value);" onchange="$('#interestInput').val(this.value);" value="6.7" min="0" max="15" step="0.1">
                <div class="row">
                  <div class="col-6 ps-0 text-start"><span class="small">0</span></div>
                  <div class="col-6 pe-0 text-end"><span class="small">15</span></div>
                </div>
              </div>
            </div>
            <!-- left end -->
            
            <div class="col-6">
              <div class="d-flex h-100 justify-content-between flex-column text-end pe-3">
                <small>Monthly EMI</small>
                <div class="rupee fs-5 fw-bold" id="monthlyEMI"></div>
                <small>Principle Amount</small>
                <div class="rupee fs-5 fw-bold" id="principleAmount"></div>
                <small>Interest Amount</small>
                <div class="rupee fs-5 fw-bold" id="interestAmount"></div>
                <small>Total Amount Payable</small>
                <div class="rupee fs-5 fw-bold" id="totalAmountPayable"></div>
              </div>
            </div>
          </div>
          <!-- left end -->          
          <!-- loan calculator //-->


            <div class="row">
               <div class="col-lg-6 col-md-6 col-12 loan-details-box text-light">
                      <h3 class="font-weight-bold knowEmiHeading">Know your EMI</h3>
                      <div class="single-loan-slider my-2 loanSlider1">
                         <h5 class="emiSliderHeading text-right">Amount</h5>
                         <div id="amount-slide"></div>
                         <div class="text-right">
                            <small><span>₹</span> <span id="amount"></span></small>
                         </div>
                      </div>
                      <div class="single-loan-slider my-2 loanSlider2">
                         <h5 class="emiSliderHeading text-right">Duration</h5>
                         <div id="duration-slide"></div>
                         <div class="text-right">
                            <small><span id="duration"></span> <span>M</span></small>
                         </div>
                      </div>
                      <div class="single-loan-slider mt-2 loanSlider3">
                         <h5 class="emiSliderHeading text-right">Interest Rate</h5>
                         <div id="intrest-slide"></div>
                         <div class="text-right">
                            <small><span id="intrest"></span> <span>%</span></small>
                         </div>
                      </div>
               </div>
               <div class="col-lg-2 col-md-2 col-12"></div>
               <div class="col-lg-4 col-md-4 col-12 text-center loan-emi-box text-dark mt-lg-0 mt-3">
                  <div class="klc-amount-inner p-lg-4 p-3">
                     <div class="total-calculation">
                        <div class="single-total">
                           <h4 class="mb-lg-3 mb-4"><span>Monthly EMI</span></h4>
                           <h2 class="emi-price" id="emi"><span>bh</span>0</h2>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">Total Interest</span></h6>
                           <h6><span id="tbl_emi" class="float-right">0</span></h6>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">Total Amount</span></h6>
                           <h6><span id="tbl_la" class="float-right">0</span></h6>
                        </div>

                        <div>
                           <a href="#applyform" class="btn klc-btn">Apply Now</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
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