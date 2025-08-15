<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

<!-- Favicon Icon -->
<link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel</title>
    <link href="{{ asset('formValidate.css') }}" rel="stylesheet" />
    <link href="{{asset('admin/css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
    <body class="loginbg">
        <div id="layoutAuthentication" class="logincontainer">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 pt-sm-5 mt-sm-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header d-flex align-items-center justify-content-center">
                                        <img src="{{asset('admin/images/logo.png')}}" alt="">      
                                    </div>
                                    <form action="adminLogin" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                                        @csrf
                                    <div class="card-body px-sm-5">
                                            <h5 class="text-center font-weight-bold">Admin Login</h5>
                                            <div class="frm-box">
                                                 <label><img src="{{asset('admin/images/log-d.png')}}"></label>
                                                 <input type="text" placeholder="Username" name="username" required data-parsley-error-message="please enter your username.">
                                                 <div class="clear"></div>
                                            </div>
                                            <div class="frm-box">
                                                 <label>
                                                     <img src="{{asset('admin/images/log-b.png')}}"></label>
                                                      <input type="password" placeholder="Password" name="password" required data-parsley-error-message="Please enter your password.">
                                                 <div class="clear"></div>
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <button class="btn btn-primary loginbtn px-5" href="dashboard.html">Login</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 mt-auto fotr loginftr">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div>Copyright &copy; LetsFin Admin. All Rights Reserved</div>
                            <div>
                                <a href="https://www.akswebsoft.com/" title="AKS Websoft Consulting Pvt. Ltd." target="_blank">
                                    <img src="{{asset('admin/images/aks.png')}}" alt="AKS Websoft Consulting Pvt. Ltd." class="powerd">
                                </a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>


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
