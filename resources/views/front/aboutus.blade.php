@extends('front.master.master')
@section('main-content')
  <section class="page-banner">
    <div class="anim-icons">
      <!-- <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span> -->
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span>
    </div>
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>About Us</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="{{ route('index') }}">Home</a></li>
          <li class="active">About Us</li>
        </ul>
        <h5 class="tagline" data-aos="fade-up" data-aos-delay="100"> Let's Fin - <span>Finance, Trust And Progress</span></h5>
        
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

        <div class="col-md-6 col-lg-4 v-center">
          <img src="{{asset('front/images/common/agent.png')}}" alt="feature-image" class="img-fluid">
        </div>
        <div class="col-md-6 col-lg-8 v-center">
          <div class="about-company">
            
            <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">We Are <em>Trusted Leaders </em><br /> <span
                class="fw3">in Micro Credit.</span></h2>
            <p data-aos="fade-up" data-aos-delay="300">letsfin is a section 8-registered microfinance organisation that aids low-income salaried individuals and small enterprises with no credit history in meeting unanticipated and recurring liabilities.</p>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Founder Section -->
  <section class="agent-section pt-4 pb-4 about-bg-2" id="agent">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-6">
          <div class="common-heading">
            <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Meet The <em> Core Team</em></h2>
           
          </div>
        </div>
      </div>
      <div class="row mt60 justify-content-center core-team-row-container">
       <div class="col-lg-4">
        <div class="core-team-wrapper">
          <div class="core-team-dp">
            <img src="{{asset('front/images/founde-dp-1.png')}}" alt="" title="Mahesh Jha">
          </div>
          <div class="core-team-content">
            <div class="core-team-title">
              <h2>Mahesh Jha</h2>              
              <h3>Co-Founder</h3>
              
            <div class="core-team-discription">
              <p>Over 12 year of experience Investment Banking, FII Trading, Credit Default Swap, Banking and Finance, Financial Consultant, Loans and technical sector</p>
            </div>
            <div class="core-team-designation">
              <p>Ex- Infosys, HCL, Citi Group, Markit (now S&P)</p>
            </div>
            <div class="footer-social-media-icons">
                <a href="https://www.linkedin.com/in/maheshjha/" target="blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a> </div>
            </div>
          </div>
        </div>
       </div>
       <div class="col-lg-4">
        <div class="core-team-wrapper">
          <div class="core-team-dp">
            <img src="{{asset('front/images/founde-dp-2.png')}}" alt="" title="Pankaj Tiwari">
          </div>
          <div class="core-team-content">
            <div class="core-team-title">
              <h2>Pankaj Tiwari</h2>              
              <h3>Co-Founder</h3>
            </div>
            <div class="core-team-discription">
              <p>Over 10 year of experience  in Derivatives, Corporate Action and Retail Banking
                </p>
            </div>
            <div class="core-team-designation">
              <p>Ex- Infosys, NIIT Tech & PNB</p>
            </div>
            <div class="footer-social-media-icons" style="text-align: center;">
                <a href="https://www.linkedin.com/in/pankaj-tiwari-3a437b247/" target="blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
        <div class="core-team-wrapper">
          <div class="core-team-dp">
            <img src="{{asset('front/images/core_team_dp-3.png')}}" alt="" title="Pavan Raghani">
          </div>
          <div class="core-team-content">
            <div class="core-team-title">
              <h2>Pavan Raghani</h2>              
              <h3>CTO (Chief Technical Officer)</h3>
              
            <div class="core-team-discription">
              <p>Over 14 years of exp. in software development worked in diverse roles from Programmer to Technical Architect</p>
              <p>Tech stack : Java, Python, Angular and React. Worked with all major investment banks</p>
            </div>
            <div class="core-team-designation">
              <p>Ex- Polaris, Ness Technologies</p>
            </div>
            <div class="footer-social-media-icons">
                <a href="https://www.linkedin.com/in/pavan-raghani/" target="blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a> </div>
            </div>
          </div>
        </div>
       </div>
       </div>
      </div>
    </div>
  </section>
  <!-- End Our Founder Section -->

  <div class="cta-section pad-tb bg-fixed-img" data-parallax="scroll" data-speed="0.5"
    data-image-src="{{asset('front/images/wideimg.jpg')}}">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="fas fa-chart-line"></i>
            </div>
            <h5>Reducing balance interest loans, offering the best market rate starting from 30% PA</h5>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="fas fa-briefcase"></i>
            </div>
            <h5>Personal loan with no collateral requirements</h5>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="far fa-calendar"></i>
            </div>
            <h5>Extended loan term, 6 to 36 months</h5>
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="step-bg pt50 pb80">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 v-center">
          <div class="common-heading m-text-c pr50">
            <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Why <em>Choose</em> letsfin
              Tech Pvt. Ltd.</h2>
          </div>
        </div>
        <div class="col-lg-7 v-center m-mt30">
          <div class="row">
            <div class="col-lg-6">
              <div class="steps-div sd1 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="steps-icons"> <img src="{{asset('front/images/whyicon1.png')}}" alt="steps"> </div>
                <h4 class="mb10">One of the best interest rate in the industry</h4>
              </div>
              <div class="steps-div sd2 mt30 aos-init" data-aos="fade-up" data-aos-delay="500">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/id.svg')}}" alt="steps"> </div>
                <h4 class="mb10">It makes social impact</h4>
              </div>
            </div>
            <div class="col-lg-6 mt60 m-m0">
              <div class="steps-div sd3 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <div class="steps-icons"><img src="{{asset('front/images/whyicon2.png')}}" alt="steps"></div>
                <h4 class="mb10">Deep semi-urban penetration & understanding in NCR</h4>
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
          <a href="#" class="btnpora btn-rd2 aos-init aos-animate viewreviewbtn" data-aos="fade-up" data-aos-delay="600">View Reviews</a>
          


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
                <p>Great loan services provided by letsfin . I got a loan through them and it was a smooth process. They also offered a better rate than all the other banks I looked at. Highly recommend!</p>
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

  <div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
@endsection