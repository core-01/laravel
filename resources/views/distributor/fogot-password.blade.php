<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

<!-- Favicon Icon -->
<link rel="shortcut icon" href="favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel</title>
  <link href="{{ asset('formValidate.css') }}" rel="stylesheet" />
    <link href="{{asset('distributor/css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
    <body class="loginbg">
        <div class="col-sm-12 col-md-6 offset-md-6">
            <div id="layoutAuthentication" class="logincontainer">
                <div id="layoutAuthentication_content">
                    <main>
                    <form action="{{url('update-password')}}" method="post" enctype="multipart/form-data" id='form' data-parsley-validate >
                                    @csrf
                        <div class="container">
                            <div class="row justify-content-center">
                               
                                <div class="col-lg-12 pt-sm-5 mt-sm-5">
                                    <div class="card border-0 rounded-lg mt-3 bg-transparent">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <img src="{{asset('distributor/images/logo.png')}}" alt="">      
                                        </div>
                                        <div class="card-body px-sm-5">
                                                <h5 class="text-center font-weight-bold">Forgot Password</h5>
                                                <div class="frm-box">
                                                     <!-- <label><img src="{{asset('distributor/images/log-d.png')}}"></label> -->
                                                     <input type="text" class="form-control" class="form-field" name="username" required placeholder="Enter Username"
                                                        data-parsley-error-message="Enter Your username" value="{{Session::has('username')?Session::get('username'):''}}"
                                                        data-parsly-length="[4,15]" {{ Session::has('otp')?'readonly':'' }}>
                                                     <div class="clear"></div>
                                                </div>

                                                @if (Session::has('otp'))  
                                                <div class="frm-box">
                                                     <!-- <label><img src="{{asset('distributor/images/log-d.png')}}"></label> -->
                                            
                                                <input type="text" class="form-control" class="form-field" name="otp" required  data-parsley-length="[4,4]"
                                                placeholder="Enter OTP"   data-parsley-error-message="Enter valid OTP">
                                                          <!-- <input type="password" placeholder="Password" name="password" 
                                                          required data-parsley-error-message="Please enter username."> -->
                                                     <div class="clear"></div>
                                                </div>

                                                <div class="frm-box">
                                                       
                                                        <input type="text" class="form-control" class="form-field" name="new_password" required id="new_password"
                                                        placeholder="Enter New Password" data-parsley-error-message="Enter New Password.">
                                                     <div class="clear"></div>
                                                </div> 

                                                <div class="frm-box">
                                                       
                                                <input type="text" class="form-control" class="form-field" name="confirm_password"   placeholder="Enter Confirm Password"
                                                 data-parsley-equalto="#new_password"    required data-parsley-error-message="New password & confirm password must be same." >
                                                    <div class="clear"></div>
                                               </div>
                                               @endif
                                                
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                    <button class="btn btn-primary loginbtn px-5">Send OTP</button>
                                                    <!-- <a href="{{route('register')}}" class="btn btn-success  loginbtn px-5">Send OTP</a> -->

                                                </div>

                                                <!-- <div class="card-body px-sm-5"><a href="{{url('forgot-password')}}">Forget password</a><div> -->
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </form>
                    </main>
                </div>
                <div id="layoutAuthentication_footer">
                    <footer class="py-4 mt-auto fotr loginftr">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div>Copyright &copy; LetsFin Admin. All Rights Reserved</div>
                                <!--<div>
                                    <a href="https://www.akswebsoft.com/" title="AKS Websoft Consulting Pvt. Ltd." target="_blank">
                                        <img src="{{asset('distributor/images/aks.png')}}" alt="AKS Websoft Consulting Pvt. Ltd." class="powerd">
                                    </a>
                                </div>-->
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('distributor/js/scripts.js')}}"></script>

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
