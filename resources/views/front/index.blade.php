@extends('front.master.master')
@section('main-content')
<section class="hero-section-1  agency-bg" id="home">
  <div class="blur-bg-blocks">
    <aside class="blur-bg-set">
      <div class="blur-bg blur-bg-a"></div>
      <div class="blur-bg blur-bg-b"></div>
      <div class="blur-bg blur-bg-c"></div>
    </aside>
  </div>
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5 v-center">
        <div class="header-heading-1">
          <h1 class="mb10" data-aos="zoom-out-up">Get Instant Loan,</h1>
          <h1 class="typewriter mb30" data-aos="zoom-out-up"><span class="fw3">In The Smartest Way.</span></h1>

          <p data-aos="zoom-out-up" data-aos-delay="400">Get a personal loan upto 50 thousand with instant approval and minimum documents, experience us at Letsfin.</p>
          <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd2 mt30" data-aos="zoom-out-up" data-aos-delay="600">Apply Now</a>
        </div>
        <div class="hero-feature" data-aos="zoom-out-up" data-aos-delay="800">
          <div class="media v-center">
            <div class="icon-pora"><img src="{{asset('front/images/icons/fast-time.png')}}" alt="icon" class="w-100"></div>
            <div class="media-body">Quick, Easy & Hassle Free</div>
          </div>
          <div class="media v-center">
            <div class="icon-pora"><img src="{{asset('front/images/icons/customer-services.png')}}" alt="icon" class="w-100"></div>
            <div class="media-body">Customer support<br/> as per your convenience.</div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="img-box m-mt60 text-center banner-img" data-aos="fade-In" data-aos-delay="400" data-aos-duration="3000">
            <div class="avatar">
                <img src="{{asset('front/images/calculator-icon.png')}}" alt="car" class="slidericon1">
            </div>
            <div class="avatar avatar2">
                <img src="{{asset('front/images/money-icon.png')}}" alt="car" class="slidericon2">
            </div>
            <img src="{{asset('front/images/hero/beautiful-curly-girl.png')}}" alt="car" class="img-fluid banner-charat-img">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="service-card">
          <div class="servicecard up-hor">
              <div class="servicecard-inr">
                 <img src="{{asset('front/images/afterbnr-icon1.png')}}" alt="icon">
                 <p>Quick & Easy<br/> Loan Approvals</p>
              </div>
          </div> 
          <div class="servicecard up-hor">
              <div class="servicecard-inr">
                 <img src="{{asset('front/images/afterbnr-icon2.png')}}" alt="icon">
                 <p>Hassle Free<br/> Documents Process</p>
              </div>
          </div> 
          <div class="servicecard up-hor">
              <div class="servicecard-inr">
                 <img src="{{asset('front/images/afterbnr-icon3.png')}}" alt="icon">
                 <p>Funds Within <br/> 24 Hours*</p>
              </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<div class="enquire-form pad-tb pora-bg1 text-white whychooseus" >
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="cta-heading text-center"> <span class="subhead" data-aos="fade-up" data-aos-delay="100">How we work?</span>
          <h5 data-aos="fade-up" data-aos-delay="300">We are transparent and instant in our service delivery that makes you invest<br/> your trust in us for quick financing solution. Get loans from Letsfin in three simple steps.</h5>
        </div>

        <!-- start -->
        <div class="row work-box">
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="one"><span>1</span></div>
                <div class="box-icon-home">
                    <figure><img src="{{asset('front/images/how-icon1.png')}}" alt=""></figure>
                </div>
                <p>Ease of Applying</p>
            </div>
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="one"><span>2</span></div>
                <div class="box-icon-home">
                    <figure><img src="{{asset('front/images/how-icon3.png')}}" alt=""></figure>
                </div>
                <p>Instant Decisions</p>
            </div>
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
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

<section class="about-bg-2 pad-tb" id="about">
  <div class="container">
    <div class="row m-text-c">
      <div class="col-lg-6 v-center">
        <div class="about-company">
          <h5 class="mb10" data-aos="fade-up" data-aos-delay="100">About Us</h5>
          <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">We Are <em>Trusted Leaders </em><br/> <span class="fw3">in Micro Credit.</span></h2>
          <p data-aos="fade-up" data-aos-delay="300">Letsfin is a section 8-registered microfinance organisation that aids low-income salaried individuals and small enterprises with no credit history in meeting unanticipated and recurring liabilities.</p>
          <a href="{{ route('about-us') }}" class="btnpora btn-rd2 mt40" data-aos="fade-up" data-aos-delay="600">About Us</a>
          <a href="{{ route('apply-now') }}" class="btn-rd aos-init mt40" data-aos="fade-up" data-aos-delay="600">Apply Now</a> </div>
      </div>
      <div class="col-lg-6 v-center">
          <div class="img-box1 m-mt60" data-aos="fade-up" data-aos-delay="500">
              <img src="{{asset('front/images/common/agent2.png')}}" alt="feature-image" class="img-fluid">
          </div>
      </div>
    </div>
  </div>
</section>

<div class="cta-section pad-tb bg-fixed-img" data-parallax="scroll" data-speed="0.5" data-image-src="{{asset('front/images/wideimg.jpg')}}">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">
        <div class="cta-heading">
          <h2 class="mb20 text-w" data-aos="fade-up" data-aos-delay="100">Get Money Right Now!</h2>
          <p class="text-w" data-aos="fade-up" data-aos-delay="300">Fill in an application form on our website. We are always with you when you need<br/> money instant.</p>
          <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd3 mt40 noshadow" data-aos="fade-up" data-aos-delay="500"> Apply Now For Loan</a> </div>
      </div>
    </div>
  </div>
</div>

<section class="about-bg pad-tb" id="partners">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-7 pr-20">
        <div class="partner-company">
          <!-- <h5 class="mb10" data-aos="fade-up" data-aos-delay="100"><em>What We Serve</em></h5> -->
          <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">Personal <em>Loan</em></h2>
          <p class="mb-0 pb-0" data-aos="fade-up" data-aos-delay="100"><strong>Letsfin</strong> offers personal loans to salaried individuals with a <strong>No</strong> credit score and a verified source of income. This loan product helps individuals to borrow funds to pay for expenses <strong>such</strong> as debt consolidation, medical purposes, purchase of household or electronic goods, medical treatment, children’s education or wedding, home improvement and even travel.</p>
        </div>
        <!-- <div class="features mt40" data-aos="fade-In" data-aos-delay="500">
            <h4 class="mb20" data-aos="fade-up" data-aos-delay="100">Features</h4>
            <ul class="feat-list">
               <li>No security or collateral required to avail of the loan</li>
               <li>Applicant can club income of co-applicant to enhance eligibility.</li>
               <li>Receive a Personal Accidental cover</li>
               <li>Loan upto Rs. 15 Lacs</li>
               <li>Tenure: 12 to 60 months</li>
            </ul>
        </div> -->
        <div class="key-features itm-media-object mt30">
                <!-- <div class="media aos-init aos-animate" data-aos="fade-In" data-aos-delay="100">
                    <div class="img-ab-"><img src="{{asset('front/images/icons/customer-service.svg')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                       <h4><em>5 Minutes </em> Policy Issuance</h4>
                    </div>
                </div> -->
                <div class="media aos-init aos-animate" data-aos="fade-In" data-aos-delay="300">
                    <div class="img-ab-"><img src="{{asset('front/images/icons/happiness.svg')}}" alt="icon" class="layer"></div>
                        <div class="media-body">
                        <h4><em>Happy </em> Customers</h4>
                    </div>
                </div>
                <div class="media mt30 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/icons/support.svg')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                    <h4><em>Dedicated </em> Support Team</h4>
                    </div>
                </div>
                <a href="#" class="btnpora btn-rd2 mt40 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">Apply Now For Loan</a>
        </div>
      </div>

      <div class="col-lg-5 v-center">
            <div class="img-box1 m-mt60" data-aos="fade-Left" data-aos-delay="200">
              <img src="{{asset('front/images/loan-image.jpg')}}" alt="image" class="img-fluid">
            </div>
      </div>
    </div>
  </div>
</section>
<section class="step-bg pt50 pb80">
<div class="container">
<div class="row">
<div class="col-lg-5 v-center">
<div class="common-heading m-text-c pr50">
<h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Don't Delay Happiness! <em>Personal Loan</em> Upto ₹ 50 thousand.</h2>
</div>
</div>
<div class="col-lg-7 v-center m-mt30">
    <div class="row">
        <div class="col-lg-6">
            <div class="steps-div sd1 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/choice.png')}}" alt="steps"> </div>
                    <p class="mb10">Step 1</p>
                    <h4 class="mb10">Customize EMI<br/> Tenure Options</h4>
                </div>
                <div class="steps-div sd2 mt30 aos-init" data-aos="fade-up" data-aos-delay="500">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/id.svg')}}" alt="steps"> </div>
                <p class="mb10">Step 2</p>
                <h4 class="mb10">Bring ID Proof</h4>                
            </div>
        </div>
        <div class="col-lg-6 mt60 m-m0">
            <div class="steps-div sd3 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <div class="steps-icons"> <img src="{{asset('front/images/steps-icon2.png')}}" alt="steps"> </div>
                <p class="mb10">Step 3</p>
                <h4 class="mb10">Verification Process</h4>
            </div>
            <div class="steps-div sd4 mt30 aos-init" data-aos="fade-up" data-aos-delay="700">
                <div class="steps-icons"> <img src="{{asset('front/images/steps-icon4.png')}}" alt="steps"> </div>
                <p class="mb10">Step 4</p>
                <h4 class="mb10">Collect Your ₹₹</h4>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
<!-- end -->

<section class="reviews-section pad-tb review-bg2" id="review">
  <div class="container">
    <div class="row">
    <div class="col-lg-5">
          <div class="comon-heading">
            <!-- <h2 class="mb20 mt40">Our <em>Happy</em> Customers</h2> -->
            <img src="{{asset('front/images/justdial.png')}}" alt="justdial img">
          </div>
          <h5 class="mt30" style="margin-top: 15px;">Justdail Rating (4.9 Out of 5)</h5>
          <ul class="overallrating mt30 ratingg">
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
          </ul>
          <a href="https://jsdl.in/DT-23QAUUU2UAM" target="_blank" class="btnpora btn-rd2 aos-init aos-animate viewreviewbtn" data-aos="fade-up" data-aos-delay="600">View Reviews</a>
          


        </div>
        <div class="col-lg-7">
          <div class="reviews-block owl-carousel m-mt60">
            <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-1.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>Rahul</h5>
                  <!-- <p>Business Owner</p> -->
                  <div class="star-rate">
                    <ul>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                      <li> <a href="javascript:void(0)">4.2</a> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="review-text pb0 pt30">
                <p>Great loan services provided by Letsfin Tech. I got a loan through them and it was a smooth process. They also offered a better rate than all the other banks I looked at. Highly recommend!</p>
              </div>
            </div>
            <!-- <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-2.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>Mario Speedwagon</h5>
                  <p>Business Owner</p>
                  <div class="star-rate">
                    <ul>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                      <li> <a href="javascript:void(0)">4.2</a> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="review-text pb0 pt30">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.</p>
              </div>
            </div>
            <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-3.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>Mario Speedwagon</h5>
                  <p>Business Owner</p>
                  <div class="star-rate">
                    <ul>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a>
                      </li>
                      <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                      <li> <a href="javascript:void(0)">4.2</a> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="review-text pb0 pt30">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.</p>
              </div>
            </div> -->
          </div>
        </div>
    </div>
  </div>
</section>
<section class="faq-section pad-tb ">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">
        <div class="common-heading">
          <h2 data-aos="fade-up" data-aos-delay="100">Frequently Asked <span>Questions</span></h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt60">
      <div class="col-lg-8">
        <div id="accordion3" class="accordion">
          <div class="card-2">
            <div class="card-header" id="acc1">
              <button class="btn btn-link btn-block text-left acc-icon" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1"> What Is Personal Loan? </button>
            </div>
            <div id="collapse-1" class="card-body p0 collapse show" aria-labelledby="acc1" data-parent="#accordion3">
              <div class="data-reqs">
                <p>A personal loan is a loan that does not require collateral/security and is offered with minimum documentation.
<br/>
You can use the funds from this loan for any legitimate financial need such as wedding, home renovation, Medical emergency and to consolidate debt. Like any other loan, you must repay it according to the agreed terms with the lender. Normally this can include a few months to a few years in easy equated monthly instalments. Letsfin Use monthly reducing EMI.
</p>
              </div>
            </div>
          </div>
          <div class="card-2 mt10">
            <div class="card-header" id="acc2">
              <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2"> 
              Is it mandatory to take insurance while taking a Personal Loan? </button>
            </div>
            <div id="collapse-2" class="card-body p0 collapse" aria-labelledby="acc2" data-parent="#accordion3">
              <div class="data-reqs">
                <p>Letsfin do not charge or add insurance fee for Personal Loan. However, Few banks and NBFC do charge insurance on personal loans. 
</p>
              </div>
            </div>
          </div>
          <div class="card-2 mt10">
            <div class="card-header" id="acc3">
              <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3"> 
              Do I need to pay charges on Part payment and early closure?    
            </button>
            </div>
            <div id="collapse-3" class="card-body p0 collapse" aria-labelledby="acc3" data-parent="#accordion3">
              <div class="data-reqs">
                <p>Letsfin do not charge any fee on Part payment and Early loan closure, we want our borrower to get free whenever they want.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
@endsection