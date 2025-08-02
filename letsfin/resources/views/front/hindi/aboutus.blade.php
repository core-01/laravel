@extends('front.master.master')
@section('main-content')
  <section class="page-banner">
    <div class="anim-icons">
      <!-- <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="images/banner-shape-1.png')}}" alt=""></span> -->
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span>
    </div>
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>हमारे बारे में</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="index.html">होम</a></li>
          <li class="active">हमारे बारे में</li>
        </ul>
        <h5 class="tagline" data-aos="fade-up" data-aos-delay="100"> Letsfin Tech Pvt. Ltd. ( लेट्सफिन टेक प्रा. लिमिटेड ) - <span>FINANCE , TRUST & PROGRESS </span></h5>

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

            <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">हम <em>एक विश्वसनीय कंपनी हैं </em><br /> <span
                class="fw3">माइक्रो क्रेडिट में।</span></h2>
            <p data-aos="fade-up" data-aos-delay="300">Letsfin ( लेट्सफिन टेक प्रा. लिमिटेड ) एक सेक्शन 8-पंजीकृत माइक्रोफाइनेंस संगठन है जो कम आय वाले वेतनभोगी व्यक्तियों और छोटे उद्यमों को अप्रत्याशित और आवर्ती देनदारियों को पूरा करने में मदद करता है।</p>

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
            <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"> <em>संस्थापकों </em>से मिलें
            </h2>

          </div>
        </div>
      </div>
      <div class="row mt60 justify-content-center core-team-row-container">
        <div class="col-lg-5">
          <div class="core-team-wrapper">
            <div class="core-team-dp">
              <img src="{{asset('front/images/founde-dp-1.png')}}" alt="" title="Mahesh Jha">
            </div>
            <div class="core-team-content">
              <div class="core-team-title">
                <h2>महेश झा</h2>
                <h3>सह संस्थापक</h3>
              </div>
              <div class="core-team-discription">
                <p>12 साल से अधिक का अनुभव निवेश बैंकिंग, एफआईआई ट्रेडिंग, क्रेडिट डिफॉल्ट स्वैप, बैंकिंग और वित्त,
                  वित्तीय सलाहकार, ऋण और तकनीकी क्षेत्र</p>
              </div>
              <div class="core-team-designation">
                <p>पूर्व- इंफोसिस, एचसीएल, सिटी ग्रुप, मार्किट(अब एस एंड पी)</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="core-team-wrapper">
            <div class="core-team-dp">
              <img src="{{asset('front/images/founde-dp-2.png')}}" alt="" title="Pankaj Tiwari">
            </div>
            <div class="core-team-content">
              <div class="core-team-title">
                <h2>
                  पंकज तिवारी</h2>
                <h3>सह संस्थापक</h3>
              </div>
              <div class="core-team-discription">
                <p>डेरिवेटिव्स, कॉर्पोरेट एक्शन और रिटेल बैंकिंग में  10 वर्ष से अधिक का अनुभव
                </p>
              </div>
              <div class="core-team-designation">
                <p>पूर्व- इंफोसिस, एनआईआईटी टेक और पीएनबी</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Our Founder Section -->

  <div class="cta-section pad-tb bg-fixed-img" data-parallax="scroll" data-speed="0.5"
    data-image-src="{{asset('front/images/wideimg.svg')}}">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="fas fa-chart-line"></i>
            </div>
            <h5>ब्याज दर घटते हुए क्रम में ३०% वार्षिक दर से शुरू, सर्वोत्तम बाजार दर की पेशकश .</h5>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="fas fa-briefcase"></i>
            </div>
            <h5>व्यक्तिगत ऋण  बिना किसी प्रतिभूति और गिरवी के
               संपार्श्विक आवश्यकताओं के बिना व्यक्तिगत और व्यावसायिक ऋण
            </h5>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="stat-box">
            <div class="stat-circle">
              <i class="far fa-calendar"></i>
            </div>
            <h5>विस्तारित ऋण अवधि, 6 से 36 महीने</h5>
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
            <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><em> Letsfin ( लेट्सफिन )  </em>Tech Pvt. Ltd. क्यों चुनें</h2>
          </div>
        </div>
        <div class="col-lg-7 v-center m-mt30">
          <div class="row">
            <div class="col-lg-6">
              <div class="steps-div sd1 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="steps-icons"> <img src="{{asset('front/images/whyicon1.png')}}" alt="steps"> </div>
                <h4 class="mb10">उद्योग में सबसे अच्छी ब्याज दरों में से एक</h4>
              </div>
              <div class="steps-div sd2 mt30 aos-init" data-aos="fade-up" data-aos-delay="500">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/id.svg')}}" alt="steps"> </div>
                <h4 class="mb10">यह सामाजिक प्रभाव डालता है</h4>
              </div>
            </div>
            <div class="col-lg-6 mt60 m-m0">
              <div class="steps-div sd3 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <div class="steps-icons"><img src="{{asset('front/images/whyicon2.png')}}" alt="steps"></div>
                <h4 class="mb10">आपके पास दिल्ली एनसीआर का  एड्रेस प्रूफ होना चाहिए</h4>
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
          <h5 class="mt30">जस्टडायल रेटिंग (
            4.9 5 में से)</h5>
          <ul class="overallrating mt30">
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
            <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
          </ul>
        </div>
        <div class="col-lg-7">
          <div class="reviews-block owl-carousel m-mt60">
            <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-1.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>मारियो स्पीडवैगन</h5>
                  <p>व्यवसाय के मालिक</p>
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
                <p>लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। लोरेम इप्सम 1500 के दशक के बाद से उद्योग का मानक डमी टेक्स्ट रहा है, जब एक अज्ञात प्रिंटर ने टाइप की एक गैली ली और एक टाइप नमूना पुस्तक बनाने के लिए इसे स्क्रैम्बल किया।</p>
              </div>
            </div>
            <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-2.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>मारियो स्पीडवैगन</h5>
                  <p>व्यवसाय के मालिक</p>
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
                <p>लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। लोरेम इप्सम 1500 के दशक के बाद से उद्योग का मानक डमी टेक्स्ट रहा है, जब एक अज्ञात प्रिंटर ने टाइप की एक गैली ली और एक टाइप नमूना पुस्तक बनाने के लिए इसे स्क्रैम्बल किया।</p>
              </div>
            </div>
            <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-3.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>मारियो स्पीडवैगन</h5>
                  <p>व्यवसाय के मालिक</p>
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
                <p>लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। लोरेम इप्सम 1500 के दशक के बाद से उद्योग का मानक डमी टेक्स्ट रहा है, जब एक अज्ञात प्रिंटर ने टाइप की एक गैली ली और एक टाइप नमूना पुस्तक बनाने के लिए इसे स्क्रैम्बल किया।</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
@endsection