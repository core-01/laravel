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
    <title>LetsFin Admin</title>
    <link href="{{ asset('formValidate.css') }}" rel="stylesheet" />
    <link href="{{asset('admin/css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/tablecss.css')}}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="{{route('admin-dashboard')}}"><img src="{{asset('admin/images/logo.png')}}"
                alt="logo image"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <div class="col-sm-5 d-flex flex-sm-row-reverse">
            <h4 class="panelhd">Admin Panel</h4>
        </div>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <h6 class="pl-3">Welcome {{Session::has('admin')?Session::get('admin')->name:''}} !</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('change-password')}}">Change Password</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                                @php
                                    
                                $sessiond = Session::get('admin'); 
                                @endphp



                        @if ($sessiond->role==1)

                        <a class="nav-link " href="{{route('admin-dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('loanrequest') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Loan Request</div>
                        </a>
                        <a class="nav-link" href="{{Route('loan-approved')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Approved Loan</div>
                        </a>

                        <!-- <a class="nav-link" href="{{Route('emi-details')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> EMI Detail</div>
                            </a> -->

                        <a class="nav-link" href="{{Route('due-emi')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Due Emi</div>
                        </a>

                       

                        <a class="nav-link" href="{{Route('paid-emi')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Paid</div>
                        </a>
                        <a class="nav-link" href="{{ url('view-and-Pay') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> View And Pay EMI</div>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('excel-file') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Import Excel File</div>
                        </a>


                        <!--<a class="nav-link collapsed" href="{{ url('excel-emi') }}">-->
                        <!--    <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Import Excel EMI</div>-->
                        <!--</a>-->
                        
                        <a class="nav-link" href="{{ route('distributor') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i> Distributor</div>
                        </a>


                        <a class="nav-link" href="{{ url('emi-transaction-history') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-history" aria-hidden="true"></i> EMI Transaction History</div>
                        </a>

                        <a class="nav-link" href="{{ url('queries') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-question" aria-hidden="true"></i> Query</div>
                        </a>

                        <a class="nav-link" href="{{ url('admin/admin') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user-plus" aria-hidden="true"></i>Admin</div>
                        </a>
                        <a class="nav-link" href="{{ url('report') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-question" aria-hidden="true"></i> Report</div>
                        </a>

                        @elseif($sessiond->role==2)
                        @php
                        $access_url = \DB::table('admin_accesses')->where('admin_id',$sessiond->id)->select('url_id')->first();
                        
                                $urls = explode(',',$access_url?$access_url->url_id:'');
                                
                        @endphp     
                    
                        @if (in_array(1,$urls)) 
                        <a class="nav-link " href="{{route('admin-dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        @endif


                        @if (in_array(2,$urls))
                        <a class="nav-link" href="{{ route('loanrequest') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Loan Request</div>
                        </a>
                        @endif


                        @if (in_array(3,$urls))
                        <a class="nav-link" href="{{Route('loan-approved')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Approved Loan</div>
                        </a>
                        @endif


                        @if (in_array(1,$urls))
                        <!-- <a class="nav-link" href="{{Route('emi-details')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> EMI Detail</div>
                            </a> -->
                            @endif


                        @if (in_array(4,$urls))
                        <a class="nav-link" href="{{Route('due-emi')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Due Emi</div>
                        </a>
                        @endif


                        @if (in_array(5,$urls)) 
                        <a class="nav-link" href="{{Route('paid-emi')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Paid</div>
                        </a>
                        @endif


                        @if (in_array(6,$urls))
                        <a class="nav-link" href="{{ url('view-and-Pay') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> View And Pay EMI</div>
                        </a> 
                        @endif


                        @if (in_array(7,$urls))
                        <a class="nav-link collapsed" href="{{ route('excel-file') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Import Excel File</div>
                        </a> 
                        @endif

                        @if (in_array(7,$urls)) 
                        <!--<a class="nav-link collapsed" href="{{ url('excel-emi') }}">-->
                        <!--    <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i> Import Excel EMI</div>-->
                        <!--</a>-->
                        @endif

                        @if (in_array(8,$urls)) 
                        <a class="nav-link" href="{{ route('distributor') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i> Distributor</div>
                        </a> 
                        @endif

                        @if (in_array(9,$urls)) 
                        <a class="nav-link" href="{{ url('emi-transaction-history') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-history" aria-hidden="true"></i> EMI Transaction History</div>
                        </a> 
                        @endif


                        @if (in_array(10,$urls)) 
                        <a class="nav-link" href="{{ url('queries') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-question" aria-hidden="true"></i> Query</div>
                        </a>

                        @endif

                        @if (in_array(11,$urls)) 
                        <a class="nav-link" href="{{ url('admin/admin') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user-plus" aria-hidden="true"></i>Admin</div>
                        </a> 
                        @endif

                        @if (in_array(12,$urls)) 
                        <a class="nav-link" href="{{ url('report') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-question" aria-hidden="true"></i> Report</div>
                        </a>
                        @endif

                        @endif
                    



                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
            </nav>
        </div>

        @yield('main-content')

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div>Copyright &copy; LetsFin Admin. All Rights Reserved</div>
                    <!--<div>
                        <a href="https://www.akswebsoft.com/" title="AKS Websoft Consulting Pvt. Ltd."
                            target="_blank"><img src="{{asset('admin/images/aks2.png')}}"
                                alt="AKS Websoft Consulting Pvt. Ltd." class="powerd"></a>
                    </div>-->
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('admin/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('admin/assets/demo/datatables-demo.js')}}"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    @if(Session::has('message'))
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
    $(document).ready(function() {
        $("#form").parsley();
    });
    </script>

    <script>
    function deleteFun(data) {
        if (!confirm(data))
            event.preventDefault();
    }
    </script>
</body>

</html>