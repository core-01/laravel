@extends('front.master.master')
@section('main-content')
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

.loginbtn {
    background: linear-gradient(200deg, #0085ff .33%, #9340fa 85.46%);
    box-shadow: 0 15px 30px -15px rgb(90 92 248 / 60%);
    border-color: #fff;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="page-banner">
    <div class="image-layer lazy-image">
        <div class="bottom-rotten-curve alternate"></div>
        <div class="auto-container">
            <h1>मेरी प्रोफाइल</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">घर</a></li>
                <li class="active">मेरी प्रोफाइल</li>
            </ul>

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
        @include('front.master.hindi-user-sidebar')
            <div class="col-md-8 col-lg-9">
                <!-- <h3>Welcome {{Session::get('customer')->costomer_name}}!</h3> -->
                <h4 style="color:#6756;">प्रोफ़ाइल विवरण</h4>
                <div class="col-lg-11">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">पूरा नाम</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->name:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">पिता का नाम</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->father_name:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">ईमेल</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->email:'' }}</p>
                                </div>
                            </div>
                            <hr>
                         
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">मोबाइल नंबर</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->mobile:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">वर्तमान पता</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->present_address:'' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <h4 style="color:#6756;">बैंक विवरण</h4>
                <div class="col-lg-11">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">बैंक नाम</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $bankDtail?$bankDtail->bank_name:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">शाखा का नाम</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $bankDtail?$bankDtail->branch_name:'' }}</p>
                                </div>
                            </div>
                            <hr>
                         
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">आईएफएससी कोड</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $bankDtail?$bankDtail->ifscCode:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">खाता नंबर</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $bankDtail?$bankDtail->account_number:'' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <h4 style="color:#6756;">अन्य विवरण</h4>
                <div class="col-lg-11">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">व्यवसाय</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->profession:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">वेतन </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->salary:'' }}</p>
                                </div>
                            </div>
                            <hr>
                         
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">योग्यता </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->qualification:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">वर्तमान नौकरी में कुल माह की संख्या</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->no_of_years_in_present_Job:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">पारिवारिक आय</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->family_income:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">अन्य ऋण विवरण</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->other_loan_details:'' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">वैवाहिक स्थिति</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $profile?$profile->married_status:'' }}</p>
                                </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>

                </div>

</section>
<div class="back-to-top" title="Go to top"><img src="{{ asset('front/images/gototop-btn.png') }}" alt="go to top btn">
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#checkbox').on('click', function() {
        console.log($('#checkbox').is(':checked'));
        if ($('#checkbox').is(':checked')) {
            $('#acceptBtn').css('display', 'block');
        } else {
            $('#acceptBtn').css('display', 'none');

        }
    });
});
</script>
@endsection