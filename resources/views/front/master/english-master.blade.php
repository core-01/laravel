
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Let's Fin | About Us</title>
  <meta charset="UTF-8">
  <meta name="description" content="Let's Fin">
  <meta name="keywords" content="Let's Fin, Lets Fin">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="{{asset('front/images/common/favicon.png')}}">
  <link href="{{ asset('formValidate.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/font-awesome/5.11.2/css/all.min.css')}}">
  <link href="{{asset('front/css/aos.css')}}" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Source+Sans+Pro:wght@400;600;700&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('front/css/style2.css')}}">
  
  <link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}">
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/64e5db1b94cf5d49dc6c06e4/1h8gtvpef';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="100" class="ct1280" onload="createCaptcha()">
  <header class="top-header th2">
    <nav class="navbar navbar-expand-lg justify-content-between navbar-mobile fixed-top">
      <div class="container"> <a class="navbar-brand logo" href="{{ route('index') }}" title="Let's Fin"> <img
            src="{{asset('front/images/common/dark-logo.png')}}" alt="Logo" class="white-logo"> <img src="{{asset('front/images/common/dark-logo.png')}}"
            alt="Logo" class="dark-logo"> </a>

        <div class="header-right">
          <div class="topbar">
            <ul>
              <li><a href="#">Pay Now</a></li>
              <li><a href="{{url('language',['lan'=>'Hi'])}}">Hindi</a></li>
              <!-- <li><a href="{{url('language',['lan'=>'en'])}}">English</a></li> -->
            </ul>
          </div>
          <div class="clearfix"></div>

          <div class="hide-desk"> <a class="mobile-btn btn-call" href="tel:+919711870560" target="_blank"><i
                class="fas fa-phone-alt"></i> <span><span class="clltxt"></a> <a class="mobile-btn btn-call getmob"
              href="#" data-toggle="modal" data-target="#modal_aside_right"> Get Quote</a> </div>
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar4"
            aria-controls="navbar4" aria-expanded="false" aria-label="Toggle navigation"> <span
              class="icon-bar top-bar"></span> <span class="icon-bar middle-bar"></span> <span
              class="icon-bar bottom-bar"></span> </button>
          <div class="collapse navbar-collapse" id="navbar4">
            <ul class="mr-auto">
            </ul>
            <ul class="navbar-nav v-center">
              <li class="nav-item"> <a class="nav-link {{Request::is('/')?'active':''}}" href="{{route('index')}}">
                  <i class="fas fa-home"></i></a>
              </li>
              <li class="nav-item"> <a class="nav-link {{Request::is('about-us')?'active':''}}" href="{{route('about-us')}}">About Us</a></li>
              <li class="nav-item"> <a class="nav-link {{Request::is('eligibility')?'active':''}} " href="{{ route('eligibility') }}">Eligibility</a></li>
              <li class="nav-item"> <a class="nav-link {{Request::is('apply-loan')?'active':''}}" href="{{route('apply-loan')}}">Apply Loan</a></li>
              <li class="nav-item"> <a class="nav-link {{Request::is('contact-us')?'active':''}}" href="{{route('contact-us')}}">Contact Us</a></li>
              <li class="nav-item">
              <a class="nav-link" href="{{ route('blogs.index') }}">Blog</a>
            </li>
              <li class="nav-item">
                
              @if (!Session::has('customer'))
                <a class="nav-link login-btn" href="#modal" data-toggle="modal" data-target="#modal_aside_right"> <i
                    class="fas fa-lock"></i> Login</a>
                    @endif
                    
                      @if (Session::has('customer'))
                    <a class="nav-link login-btn" href="{{route('user-dashboard')}}" >
                    <i class="fas fa-tachometer-alt-slowest"></i> Dashboard</a>
                    @endif
              </li>
              <li class="nav-item"> <a class="nav-link btn-call hide-mob" href="tel:+919711870560" target="_blank">
                  <i class="fas fa-phone-alt"></i> <span><span class="clltxt">Happy to Help you</span> +91 931 925 4866
                  </span> </a> </li>
            </ul>
          </div>
          </span>
        </div>
    </nav>
  </header>

  @yield('main-content')
  
  <a href="https://api.whatsapp.com/send?phone=9319254866" id="whatsapp" class="fab fa-whatsapp text-theme-colored font-36 mt-5 sm-display-block" style="padding-top: 7px; color:#ffffff!important;" rel="nofollow" target="_blank"></a>



  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h4 class="mt30 mb10 text-w">Contact Us </h4>
          <ul class="footer-address-list">
            <li><i class="fas fa-map-marker-alt"></i> F20, street 1,<br /> Churriya mohalla,<br /> Tughlakabad
              village.<br /> Delhi - 110044</li>
            <li><i class="fas fa-phone-alt"></i> <a href="tel:+919711870560" target="_blank">+91 931 925 4866 </a></li>
            <li><i class="fas fa-envelope"></i>
              <a href="mailto:hello@letsfin.com" target="blank">
                <span class="__cf_email__"> hello@letsfin.in </span>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="mt30 mb10 text-w">Site Links</h4>
          <ul class="footer-address-list">
            <li><a href="{{route('index')}}"><i class="fas fa-arrow-right"></i> Home</a></li>
            <li><a href="{{route('about-us')}}"><i class="fas fa-arrow-right"></i> About Us</a></li>
            <li><a href="{{route('apply-loan')}}"><i class="fas fa-arrow-right"></i> Loan</a></li>
            
            <li><a href="{{route('contact-us')}}"><i class="fas fa-arrow-right"></i> Contact Us</a></li>
            <li><a href="{{route('register')}}"><i class="fas fa-arrow-right"></i>Distributor Register</a></li>
              <li><a href="{{route('distributor-login')}}"><i class="fas fa-arrow-right"></i> Distributor Login</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="mt30 mb10 text-w">My Account</h4>
          <ul class="footer-address-list">
            <li><a href="#"><i class="fas fa-arrow-right"></i> Login</a></li>
            
            <li><a href="#"><i class="fas fa-arrow-right"></i> My Account</a></li>
            <li><a href="{{route('apply-now')}}"><i class="fas fa-arrow-right"></i> Apply Now</a></li>
            @if(Session::has('customer'))
            <li><a href="{{Session::has('customer')?'../../customerLogout':'#'}}"><i class="fas fa-arrow-right"></i> Logout</a></li>
            @endif
          </ul>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="mt30 mb20 text-w">Keep in Touch </h4>
          <div class="footer-social-media-icons">
                <!-- <a href="javascript:void(0)" target="blank" class="facebook"><i
                class="fab fa-facebook-f"></i></a> <a href="javascript:void(0)" target="blank" class="twitter"><i
                class="fab fa-twitter"></i></a> <a href="javascript:void(0)" target="blank" class="instagram"><i
                class="fab fa-instagram"></i></a> -->
                <a href="https://www.linkedin.com/company/letsfin-tech-pvt-ltd" target="blank" class="linkedin">
                  <i class="fab fa-linkedin-in"></i></a> </div>
        </div>

        <div class="col-sm-12">
          <div class="disclaimer">
            <h5 class="mb10 text-w">Disclaimer </h5>
            <p>Letsfin Tech  maintains this site (the "Site") for information, education and communication. You may not, however, distribute, modify, transmit, reuse, report, or use the contents of the Site for public or commercial purposes, including the text, images, audio, and video without Laetsfin Tech's written permission. By accessing and browsing the Site, ....</p>
            <details><summary>Continue reading </summary>
                <p>you accept without limitation or qualification, the Terms and Conditions and acknowledge that any other agreement between you and Letsfin Tech are superseded and of no force or effect.

                      The products and norms with respect to eligibility, tenure, amount to be funded and other documentation requirements are subject to change from time to time without prior notice. Financing shall be at the sole discretion of Letsfin Tech.

                      Loans disbursement at sole discretion of Letsfin Tech.Terms and Conditions apply.

                      Letsfin Tech  reserves right to discontinue/alter any/all products without assigning any reason
                      Loans are approved subject to valid and complete documentation.
                      The credit is at the sole discretion of Letsfin Tech subject to fulfilment of certain norms and conditions.

                      Fees/Charges Disclaimer
                      Schedule of fees & charges are updated as they may subject to change from time to time.
                      Taxes as applicable from time to time

                  </p>
              </details>
          </div>
        </div>

      </div>
    </div>
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="footer-ft">
              <p>Copyright ©
                <script>document.write(new Date().getFullYear())</script> Letsfin. All rights reserved.
              </p>
            </div>
          </div>
          <!--<div class="col-sm-12 col-md-6">
            <div class="footer-ft">
              <a href="https://www.akswebsoft.com/" class="akslogo" title="AKS Websoft Consulting Pvt. Ltd."
                target="_blank"> <img src="{{asset('front/images/akslogo.png')}}" alt="AKS Websoft Consulting Pvt. Ltd."
                  title="AKS Websoft Consulting Pvt. Ltd."></a>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </footer>
  @if (!Session::has('customer'))
  
  <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border: 0 none;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
              aria-hidden="true">&times;</span> </button>
        </div>
        <form action="customerLogin" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
          @csrf
        <div class="modal-body">
          <div class="form-block loginblock">
            <div class="row">
              <h5 class="modal-title loginmodal-title"><i class="fas fa-lock"></i> <span>Login Here</span></h5>
              <div class="form-group col-sm-12">
                <input type="text" class="form-control" id="email" placeholder="Username/mobile" name="username"
                data-parsley-error-message="Enter username/mobile." required>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <input type="password" class="form-control" id="mobile" placeholder="Password" name="password"
                 required data-parsley-error-message="Please enter password">
                <div class="help-block with-errors"></div>
              </div>              
            </div>            
            <a href="{{ route('user-dashboard') }}">
              <button type="submit" id="form-submit" class="btn-rd w-100">Login Now</button>
            </a>     
            </form>     
            <div class="form-btm-set">
              <h5>Looking For Loan? Apply Now</h5>
              <a href="{{ route('apply-loan') }}">
              <a href="{{ route('apply-loan') }}" id="form-submit" class="btn-rd w-100 mt-3 reg-btn">Apply Now</a></a>
               <a href="{{ url('forgot-password') }}" id="form-submit" class="btn-rd w-100 mt-3 reg-btn">Forgot Password</a></a>

            </div>

          

          </div>
       
        </div>
      </div>
    </div>
  </div>
  
  @endif



  <script src="{{asset('front/js/jquery.min.js')}}"></script>
  <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('front/js/pora.js.plugin.js')}}"></script>
  <script src="{{asset('front/js/validator.min.js')}}"></script>
  <script src="{{asset('front/js/form-scripts.js')}}"></script>
  <script src="{{asset('front/js/main.js')}}"></script>
  <script type="text/javascript">
    var $backToTop = $(".back-to-top");
    $backToTop.hide();


    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 100) {
        $backToTop.fadeIn();
      } else {
        $backToTop.fadeOut();
      }
    });

    $backToTop.on('click', function (e) {
      $("html, body").animate({ scrollTop: 0 }, 500);
    });
  </script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>           
<script type="text/javascript" src="https://parsleyjs.org/dist/parsley.js"></script>
<script type="text/javascript">

$(document).ready(function () {
  $("#form").parsley();
} );

</script>
</body>

</html>