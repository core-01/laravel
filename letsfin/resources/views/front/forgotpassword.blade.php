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
            <h1>Forgot Password</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li class="active">Forgot Password</li>
            </ul>
        </div>
    </div>
</section>

<section class="about-bg pad-tb" style="background: transparent;">
    <div class="container">
        <div class="row justify-content-between">


            <div class="col-sm-6 offset-sm-3 aos-animate" data-aos="fade-up">
                <h2 class="mb20 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Change Your <em>Password
                        Here</em></h2>
                <div class="enquiry-form">
                    <form action="{{url('customer-forgot-password')}}" method="post" data-parsley-validate>
                      @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="formrow">
                                    <label>Enter Mobile <span>*</span></label>
                                    <input type="text" class="form-control" class="form-field" name="mobile" required
                                        data-parsley-error-message="Enter valid mobile number" value="{{Session::has('mobile')?Session::get('mobile'):''}}"
                                        data-parsly-length="[10,10]" {{ Session::has('otp')?'readonly':'' }}>
                                </div>
                            </div>
                            @if (Session::has('otp'))  
                            <div class="col-sm-12">
                                <div class="formrow">
                                    <label>Enter OTP <span></span></label>
                                    <input type="text" class="form-control" class="form-field" name="otp" required  data-parsley-length="[4,4]"
                                    data-parsley-error-message="Enter valid OTP">
                                </div>
                            </div> 
                            <div class="col-sm-12">
                                <div class="formrow">
                                    <label>New Password<span></span></label>
                                    <input type="text" class="form-control" class="form-field" name="new_password" required id="new_password"
                                    data-parsley-error-message="Enter New Password.">
                                </div>
                            </div> 

                            <div class="col-sm-12">
                                <div class="formrow">
                                    <label>Confirm Password<span></span></label>
                                    <input type="text" class="form-control" class="form-field" name="confirm_password"   data-parsley-equalto="#new_password"
                                    required data-parsley-error-message="New password & confirm password must be same." >
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-6 offset-sm-6 text-right">
                                <button href="#" class="btnpora btn-rd2 aos-init" data-aos="fade-up"
                                    data-aos-delay="600">{{ !Session::has('otp')?'Send Otp':'Submit' }}</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
 
        </div>
</section>

<div class="back-to-top" title="Go to top"><img src="images/gototop-btn.png" alt="go to top btn"></div>
@endsection