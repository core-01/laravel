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
    background: linear-gradient(200deg,#0085ff .33%,#9340fa 85.46%);
    box-shadow: 0 15px 30px -15px rgb(90 92 248 / 60%);
    border-color: #fff;
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section class="page-banner">
    <div class="image-layer lazy-image">
      <div class="bottom-rotten-curve alternate"></div>
      <div class="auto-container">
        <h1>इतिहास</h1>
        <ul class="bread-crumb clearfix">
          <li><a href="{{ route('index') }}">होम</a></li>
          <li class="active">इतिहास</li>
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
        <!--<h3>आपका स्वागत है  {{Session::get('customer')->costomer_name}}!</h3>-->
      
        <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                 
                                    <tr>
                                        <th width="2%"> क्र. न.</th>
                                        <th>ट्रांजेक्शन  आईडी</th>
                                        <th>जमा करने की तारीख</th>
                                        <th>राशि</th>
                                        <th>विलम्ब शुल्क</th>
                                        <th>जमा करने की स्थिति</th>
                                      
                                    </tr>
                                 
                                </thead>
                                <tbody>
                                 
                                @foreach ($history as $item)
                                    <tr>
                                        <td >{{ $loop->index+1 }}</td>
                                        <td>{{ $item->transaction_id }}</td>
                                        <td>{{ $item->transaction_date }}</td>
                                        <td>₹{{ $item->pay_amount }}</td>
                                        <td>₹{{ $item->late_charge }}</td>
                                        <td><a  class="btn  loginbtn"  style=" background:{{ $item->status=='Success'?'#5cb85c':'red' }};" >{{ $item->status }}</a></td>
                                      
                                    </tr>
                                  @endforeach
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>TGGDGH8765467</td>
                                        <td>03/02/2023</td>
                                        <td>2500</td>
                                        <td>0</td>
                                        <td ><a href="#" class="btn  loginbtn"  style="background:#5cb85c;" >Success</a></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>TGGGGH87444467</td>
                                        <td>03/03/2023</td>
                                        <td>2500</td>
                                        <td>0</td>
                                        <td ><a href="#" class="btn  loginbtn"  style="background:red;" >Failed</a></td>
                                    </tr> -->
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
          

  </section>
  <div class="back-to-top" title="Go to top"><img src="{{ asset('front/images/gototop-btn.png') }}" alt="go to top btn"></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>

    $(document).ready(function(){
      $('#checkbox').on('click',function(){
        console.log( $('#checkbox').is(':checked'));
        if( $('#checkbox').is(':checked')){
            $('#acceptBtn').css('display','block');
        }else{
          $('#acceptBtn').css('display','none');

        }
      });
    });

    </script>
  @endsection