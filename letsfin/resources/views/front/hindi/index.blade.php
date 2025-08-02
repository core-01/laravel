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
          <h1 class="mb10" data-aos="zoom-out-up">तत्काल ऋण प्राप्त करें,</h1>
          <h1 class="typewriter mb30" data-aos="zoom-out-up"><span class="fw3">सबसे आसान तरीके से.</span></h1>

          <p data-aos="zoom-out-up" data-aos-delay="400">तत्काल स्वीकृति और न्यूनतम दस्तावेजों के साथ 50 हजार तक का व्यक्तिगत ऋण प्राप्त करें, लेट्सफिन में हमारा अनुभव करें।</p>
          <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd2 mt30" data-aos="zoom-out-up" data-aos-delay="600">अभी अप्लाई करें</a>
        </div>
        <div class="hero-feature" data-aos="zoom-out-up" data-aos-delay="800">
          <div class="media v-center">
            <div class="icon-pora"><img src="{{asset('front/images/icons/fast-time.png')}}" alt="icon" class="w-100"></div>
            <div class="media-body">जल्दी, आसान और परेशानी मुक्त</div>
          </div>
          <div class="media v-center">
            <div class="icon-pora"><img src="{{asset('front/images/icons/customer-services.png')}}" alt="icon" class="w-100"></div>
            <div class="media-body">ग्राहक सहायता<br/> आपकी सुविधा के अनुसार।</div>
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
                 <p>जल्दी और आसान<br/> ऋण स्वीकृतियां</p>
              </div>
          </div> 
          <div class="servicecard up-hor">
              <div class="servicecard-inr">
                 <img src="{{asset('front/images/afterbnr-icon2.png')}}" alt="icon">
                 <p>परेशानी मुक्त<br/> दस्तावेज़ प्रक्रिया</p>
              </div>
          </div> 
          <div class="servicecard up-hor">
              <div class="servicecard-inr">
                 <img src="{{asset('front/images/afterbnr-icon3.png')}}" alt="icon">
                 <p>चौबीस घंटे ऋण सुविधा</p>
                 <!-- <p>आनंद के साथ <br/> चौबीस घंटे*</p> -->
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
        <div class="cta-heading text-center"> <span class="subhead" data-aos="fade-up" data-aos-delay="100">हम कैसे काम करते हैं?</span>
          <h5 data-aos="fade-up" data-aos-delay="300">हमारी वितरण प्रक्रिया में पारदर्शिता और तीव्रता ही तत्काल ऋण समाधान के लिए विश्वास प्रकट करती है।<br/>
Trishodaya से तीन सरल चरणों में ऋण प्राप्त करे।
</h5>
          <!-- <h5 data-aos="fade-up" data-aos-delay="300">हम अपनी सेवा वितरण में पारदर्शी और तेज हैं जो आपको निवेश करने के लिए मजबूर करता है<br/> तत्काल वित्त पोषण समाधान के लिए हम पर आपका विश्वास। लेट्सफिन से तीन सरल चरणों में ऋण प्राप्त करें।</h5> -->
        </div>

        <!-- start -->
        <div class="row work-box">
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="one"><span>1</span></div>
                <div class="box-icon-home">
                    <figure><img src="{{asset('front/images/how-icon1.png')}}" alt=""></figure>
                </div>
                <p>आवेदन करने में आसानी </p>
            </div>
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="one"><span>2</span></div>
                <div class="box-icon-home">
                    <figure><img src="{{asset('front/images/how-icon3.png')}}" alt=""></figure>
                </div>
                <p>तुरंत फैसले</p>
            </div>
            <div class="col-sm-4 col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="one"><span>3</span></div>
                <div class="box-icon-home box-icon-last-after">
                    <figure><img src="{{asset('front/images/how-icon2.png')}}" alt=""></figure>
                </div>
                <p>जल्दी भुगतान</p>
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
          <h5 class="mb10" data-aos="fade-up" data-aos-delay="100">हमारे बारे में</h5>
          <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">हम <em>एक विश्वसनीय कंपनी हैं</em><br/> <span class="fw3">माइक्रो क्रेडिट में।</span></h2>
          <p data-aos="fade-up" data-aos-delay="300">लेट्सफिन एक सेक्शन 8-पंजीकृत माइक्रोफाइनेंस संगठन है जो कम आय वाले वेतनभोगी व्यक्तियों और छोटे उद्यमों को अप्रत्याशित और आवर्ती देनदारियों को पूरा करने में मदद करता है।</p>
          <a href="{{ route('about-us') }}" class="btnpora btn-rd2 mt40" data-aos="fade-up" data-aos-delay="600">हमारे बारे में</a>
          <a href="{{ route('apply-now') }}" class="btn-rd aos-init mt40" data-aos="fade-up" data-aos-delay="600">अभी अप्लाई करें</a> </div>
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
          <h2 class="mb20 text-w" data-aos="fade-up" data-aos-delay="100">पैसा अभी प्राप्त करें!</h2>
          <p class="text-w" data-aos="fade-up" data-aos-delay="300">हमारी वेबसाइट पर एक आवेदन पत्र भरें। जरूरत पड़ने पर हम हमेशा आपके साथ हैं<br/></p>
          <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd3 mt40 noshadow" data-aos="fade-up" data-aos-delay="500">ऋण के लिए अभी आवेदन करें</a> </div>
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
          <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">निजी <em>ऋृण</em></h2>
          <p class="mb-0 pb-0" data-aos="fade-up" data-aos-delay="100"><strong>“लेट्सफिन ”</strong> के साथ वेतनभोगी व्यक्तियों को व्यक्तिगत ऋण प्रदान करता है| बिना क्रेडिट स्कोर के एक सत्यापित ऋण का श्रोत.यह ऋण सुविधा व्यक्तियों को खर्चों के भुगतान के लिए धन उधार लेने में मदद करता है <strong>ऐसा</strong> ऋण समेकन के रूप में, चिकित्सा उद्देश्यों, घरेलू या इलेक्ट्रॉनिक सामान की खरीद, चिकित्सा उपचार, बच्चों की शिक्षा या शादी, गृह सुधार और यहां तक ​​कि यात्रा के लिए।</p>
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
                        <h4><em>खुश </em> ग्राहक</h4>
                    </div>
                </div>
                <div class="media mt30 aos-init" data-aos="fade-In" data-aos-delay="500">
                    <div class="img-ab-"><img src="{{asset('front/images/icons/support.svg')}}" alt="icon" class="layer"></div>
                    <div class="media-body">
                    <h4><em>समर्पित </em> सहायता समूह</h4>
                    </div>
                </div>
                <a href="#" class="btnpora btn-rd2 mt40 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">ऋण के लिए अभी आवेदन करें</a>
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
<h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">खुशियां लाने में देरी न करे! <em>व्यक्तिगत ऋृण </em> ₹ 50 हजार तक।</h2>
</div>
</div>
<div class="col-lg-7 v-center m-mt30">
    <div class="row">
        <div class="col-lg-6">
            <div class="steps-div sd1 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/choice.png')}}" alt="steps"> </div>
                    <p class="mb10">स्टेप 1</p>
                    <h4 class="mb10">किश्त का समय अपने अनुसार चुने|</h4>
                    <!-- <h4 class="mb10">ईएमआई को अनुकूलित करें<br/> कार्यकाल विकल्प</h4> -->
                </div>
                <div class="steps-div sd2 mt30 aos-init" data-aos="fade-up" data-aos-delay="500">
                <div class="steps-icons"> <img src="{{asset('front/images/icons/id.svg')}}" alt="steps"> </div>
                <p class="mb10">स्टेप 2</p>
                <h4 class="mb10">आईडी प्रूफ लेकर आएं</h4>                
            </div>
        </div>
        <div class="col-lg-6 mt60 m-m0">
            <div class="steps-div sd3 mt30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <div class="steps-icons"> <img src="{{asset('front/images/steps-icon2.png')}}" alt="steps"> </div>
                <p class="mb10">स्टेप 3</p>
                <h4 class="mb10">सत्यापन प्रक्रिया</h4>
            </div>
            <div class="steps-div sd4 mt30 aos-init" data-aos="fade-up" data-aos-delay="700">
                <div class="steps-icons"> <img src="{{asset('front/images/steps-icon4.png')}}" alt="steps"> </div>
                <p class="mb10">स्टेप 4</p>
                <h4 class="mb10">अपना ₹₹ लीजिए</h4>
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
          <a href="https://jsdl.in/DT-23QAUUU2UAM" target="_blank" class="btnpora btn-rd2 aos-init aos-animate viewreviewbtn" data-aos="fade-up" data-aos-delay="600">रिव्यु देखें</a>
        </div>
      <div class="col-lg-7">
        <div class="reviews-block owl-carousel m-mt60">
         
          <div class="reviews-card">
              <div class="-client-details-">
                <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-1.jpg')}}" alt="Good Review" class="img-fluid">
                </div>
                <div class="reviewer-text">
                  <h5>राहुल</h5>
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
                <p>लेट्सफिन टेक प्रा. लिमिटेड द्वारा प्रदान की जाने वाली महान ऋण सेवाएं। मुझे उनके माध्यम से ऋण मिला और यह एक सहज प्रक्रिया थी। उन्होंने मेरे द्वारा देखे गए अन्य सभी बैंकों की तुलना में बेहतर दर की पेशकश की। अत्यधिक सिफारिश किया जाता है!</p>
              </div>
            </div>
          <!-- <div class="reviews-card">
            <div class="-client-details-">
              <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-2.jpg')}}" alt="Good Review" class="img-fluid"> </div>
              <div class="reviewer-text">
                <h5>मारियो स्पीडवैगन</h5>
                <p>व्यवसाय के मालिक</p>
                <div class="star-rate">
                  <ul>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
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
              <div class="-reviewr"> <img src="{{asset('front/images/reviews/review-image-3.jpg')}}" alt="Good Review" class="img-fluid"> </div>
              <div class="reviewer-text">
                <h5>मारियो स्पीडवैगन</h5>
                <p>व्यवसाय के मालिक</p>
                <div class="star-rate">
                  <ul>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                    <li> <a href="javascript:void(0)">4.2</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="review-text pb0 pt30">
              <p>लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। लोरेम इप्सम 1500 के दशक के बाद से उद्योग का मानक डमी टेक्स्ट रहा है, जब एक अज्ञात प्रिंटर ने टाइप की एक गैली ली और एक टाइप नमूना पुस्तक बनाने के लिए इसे स्क्रैम्बल किया।</p>
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
          <h2 data-aos="fade-up" data-aos-delay="100">अक्सर पूछे जाने वाले  <span>सवाल</span></h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt60">
      <div class="col-lg-8">
        <div id="accordion3" class="accordion">
          <div class="card-2">
            <div class="card-header" id="acc1">
              <button class="btn btn-link btn-block text-left acc-icon" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1"> 
                पर्सनल लोन क्या है? </button>
            </div>
            <div id="collapse-1" class="card-body p0 collapse show" aria-labelledby="acc1" data-parent="#accordion3">
              <div class="data-reqs">
                <p>व्यक्तिगत ऋण एक ऐसा ऋण है जिसके लिए संपार्श्विक/सुरक्षा की आवश्यकता नहीं होती है और यह न्यूनतम दस्तावेज़ीकरण के साथ पेश किया जाता है।</p>
                <p>आप इस ऋण से प्राप्त धनराशि का उपयोग किसी भी वैध वित्तीय आवश्यकता जैसे शादी, घर के नवीनीकरण, चिकित्सा आपातकाल और ऋण को समेकित करने के लिए कर सकते हैं। किसी भी अन्य ऋण की तरह, आपको इसे ऋणदाता के साथ सहमत शर्तों के अनुसार चुकाना होगा। आम तौर पर इसमें आसान समान मासिक किस्तों में कुछ महीनों से लेकर कुछ वर्षों तक शामिल हो सकते हैं। त्रिषोदय का प्रयोग मासिक कम करने वाली ईएमआई।</p>
                <!-- <p>लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। लोरेम इप्सम उद्योग की नमूना पुस्तक रही है। लोरेम इप्सम प्रिंटिंग और टाइपसेटिंग उद्योग का केवल डमी टेक्स्ट है। </p> -->
              </div>
            </div>
          </div>
          <div class="card-2 mt10">
            <div class="card-header" id="acc2">
              <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2"> पर्सनल लोन किस प्रकार की बीमा पॉलिसियों की पेशकश करता है? </button>
            </div>
            <div id="collapse-2" class="card-body p0 collapse" aria-labelledby="acc2" data-parent="#accordion3">
              <div class="data-reqs">
                <p>लेट्सफिन पर्सनल लोन के लिए बीमा शुल्क नहीं लेता या जोड़ता नहीं है। हालाँकि, कुछ बैंक और एनबीएफसी व्यक्तिगत ऋण पर बीमा शुल्क लेते हैं।</p>
              </div>
            </div>
          </div>
          <div class="card-2 mt10">
            <div class="card-header" id="acc3">
              <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3"> पर्सनल लोन पर बीमा पॉलिसी खरीदने में कितना समय लगता है? </button>
            </div>
            <div id="collapse-3" class="card-body p0 collapse" aria-labelledby="acc3" data-parent="#accordion3">
              <div class="data-reqs">
                <p>लेट्सफिन आंशिक भुगतान और शीघ्र ऋण समापन पर कोई शुल्क नहीं लेता है, हम चाहते हैं कि हमारा उधारकर्ता जब चाहे मुक्त हो जाए।
                   </p>
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