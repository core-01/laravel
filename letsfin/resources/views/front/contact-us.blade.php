@extends('front.master.master')
@section('main-content')

<!-- captcha css -->
<style>
input[type=text] {
    padding: 12px 20px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
button{
  background-color: #4CAF50;
    border: none;
    color: white;
    padding: 12px 30px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
canvas{
  /*prevent interaction with the canvas*/
  pointer-events:none;
}
</style>
<!-- captcha css -->
<section class="page-banner">
        <div class="anim-icons">
      <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span>
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="{{asset('front/images/banner-shape-1.png')}}" alt=""></span>
    </div>
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>Contact Us</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
</section>

<section class="about-bg pad-tb" style="background: transparent;">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-sm-6 col-md-4">
        <div class="partner-company">
          <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Contact <em>Details</em></h2>
        </div>
        <div class="adressouter" data-aos="fade-up" data-aos-delay="300">
             <img src="{{asset('front/images/addres-icon1.png')}}" alt="address icon">
             <h5>Address</h5>
             <p>F20, street 1, Churriya mohalla, Tughlakabad village. Delhi - 110044</p>
        </div>
        <div class="adressouter" data-aos="fade-up" data-aos-delay="300">
             <img src="{{asset('front/images/addres-icon2.png')}}" alt="address icon">
             <h5>Phone Number</h5>
             <p><a href="tel:+919319254866" target="_blank">+91 931 925 4866</a></p>
        </div>
        <div class="adressouter" data-aos="fade-up" data-aos-delay="300">
             <img src="{{asset('front/images/addres-icon3.png')}}" alt="address icon">
             <h5>Email ID</h5>
             <p><a href="mailto:hello@letsfin.in" target="blank">hello@letsfin.in</a></p>
        </div>

    </div>

    <div class="col-sm-6 col-md-8 aos-animate" data-aos="fade-up">
         <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Make <em>Enquiry</em></h2>
         <div class="enquiry-form">
          <form action="contactForm" method="post" enctype="multipart/form-data" id="form"  onsubmit="validateCaptcha()" data-parsley-validate>
            @csrf
            <div class="row">
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Your Name <span>*</span></label>
                      <input type="text" class="form-control"  name="name" required data-parsley-error-message="Please enter full name."
                      placeholder="Enter your name here" value="{{old('name')}}"class="form-field">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Email (optional)</label>
                      <input type="email" class="form-control" name="email"  data-parsley-error-message="This email not valid." value="{{old('email')}}"
                      placeholder="Enter your Email Address" class="form-field">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="formrow">
                      <label>Mobile <span>*</span></label>
                      <input type="text" class="form-control" name="mobile" required  data-parsley-length="[10,10]" value="{{old('mobile')}}"
                      data-parsley-error-message="Please enter valid number." placeholder="Enter your mobile number">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="formrow">
                      <label>Enquiry Message </label>
                      <textarea class="form-control" name="message">{{old('message')}}</textarea>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 pr-sm-0">
                  <div class="formrow">
                      <label>Capthca Code <span>*</span></label>
                      <div id="captcha" id="mainCaptcha" style="padding:0px; color:#000" class="captcha-value">
            </div>
                      <!-- <input type="button"  style="padding:0px; color:#000" name="mainCaptcha" class="captcha-value" value="MHGnr"> -->
                  </div>
                </div>
                <div class="col-sm-4 col-md-6 pr-sm-0">
                  <div class="formrow">
                      <label>Enter Capthca Code <span>*</span></label>
                      <input type="text" class="form-control" placeholder="" id="cpatchaTextBox" class="form-field"  data-parsley-error-message="Please fill the captcha.">
                      <span style="color:#B94A48;font-size:15px; margin-left:3px;" id="capchaErrorMessage"></span>
                  </div>
                </div>
                <div class="col-sm-2">
                     <a href="javascript:void(0);" class="refreshbtn" onclick="createCaptcha()"><i class="fas fa-undo"></i></a>
                </div>                
                <div class="col-sm-6 offset-sm-6 text-right">
                     <button href="#" class="btnpora btn-rd2 aos-init" data-aos="fade-up" data-aos-delay="600">Send Enquiry</button>
                </div>                  
            </div>
            </form>
         </div>

           
    </div>

  </div>
</section>

<div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>


<!-- capcha code -->
<script>
var code;
function createCaptcha() {
  //clear the contents of captcha div first 
  document.getElementById('captcha').innerHTML = "";
  var charsArray =
  "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  var lengthOtp = 6;
  var captcha = [];
  for (var i = 0; i < lengthOtp; i++) {
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
    if (captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }
  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width = 100;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  ctx.font = "25px Georgia";
  ctx.strokeText(captcha.join(""), 0, 30);
  //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  code = captcha.join("");
  document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}
function validateCaptcha() {
  debugger
  if (document.getElementById("cpatchaTextBox").value == code) {
    $('#capchaErrorMessage').html(' ')

    // alert("Valid Captcha")
  }else{
  event.preventDefault();
      if($('#cpatchaTextBox').val() != ""){
      $('#capchaErrorMessage').html('Invalid Captcha.')
    createCaptcha();
      }
  }
}

  </script>


@endsection