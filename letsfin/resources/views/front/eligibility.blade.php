@extends('front.master.master')
@section('main-content')
<section class="page-banner">
        <div class="anim-icons">
      <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="images/banner-shape-1.png" alt=""></span>
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="images/banner-shape-1.png" alt=""></span>
    </div>
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>Eligibility</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Eligibility</li>
                </ul>
            </div>
        </div>
</section>

<section class="about-bg pad-tb" id="partners">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-7 pr-20">
        <div class="partner-company">
          <!-- <h5 class="mb10" data-aos="fade-up" data-aos-delay="100"><em>What We Serve</em></h5> -->
          <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Loan <em>Eligibility</em></h2>
        </div>
        
        <div class="key-features itm-media-object mt30 eligibilty-outer">
                <!-- <div class="media aos-init aos-animate" data-aos="fade-In" data-aos-delay="100">
                    <div class="img-ab-"><img src="images/icons/customer-service.svg" alt="icon" class="layer"></div>
                    <div class="media-body">
                       <h4><em>5 Minutes </em> Policy Issuance</h4>
                    </div>
                </div> -->
                <div class="media aos-init" data-aos="fade-In" data-aos-delay="300">
                    <div class="img-ab-"><img src="{{asset('front/images/eligibilityicon1.png')}}" alt="icon" class="layer"></div>
                      <div class="media-body">
                        <h4><em>- In last 5 month - </em> 4 salary should be credited in bank</h4>
                      </div>
                </div>
                <div class="media mt20 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/eligibilityicon2.png')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                        <h4><em>Your existing loan EMI should not be </em> more than 50% of your salary</h4>
                    </div>
                </div>
                <div class="media mt20 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/eligibilityicon3.png')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                        <h4><em>You must have </em> Delhi/NCR address proof</h4>
                    </div>
                </div>
                <div class="media mt20 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/eligibilityicon4.png')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                        <h4><em>Monthly salary must be </em> greater than 9k</h4>
                    </div>
                </div>
                <div class="media mt20 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/eligibilityicon5.png')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                        <h4><em>You must have </em> PAN Card</h4>
                    </div>
                </div>
                <a href="#" class="btnpora btn-rd2 mt40 aos-init" data-aos="fade-up" data-aos-delay="600">Apply Now For Loan</a>
        </div>
      </div>

      <div class="col-lg-5 v-center">
           <img src="{{asset('front/images/eligibility-img.png')}}" alt="image" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
@endsection