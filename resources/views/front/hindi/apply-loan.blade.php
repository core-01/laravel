@extends('front.master.master')
@section('main-content')
<section class="page-banner">
        <div class="anim-icons">
      <!-- <span class="icon shape-1 wow fadeInLeft animated animated" data-wow-delay="800ms">
        <img src="images/banner-shape-1.png')}}" alt=""></span>
      <span class="icon shape-2 wow fadeInRight animated animated" data-wow-delay="800ms">
        <img src="images/banner-shape-1.png')}}" alt=""></span> -->
    </div>
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>ऋण लागू करें</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">होम</a></li>
                    <li class="active">ऋण लागू करें</li>
                </ul>
            </div>
        </div>
</section>

<section class="pt-4 pb-4 about-bg-2">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-12 pr-20">
        <div class="partner-company">
          <!-- <h5 class="mb10" data-aos="fade-up" data-aos-delay="100"><em>What We Serve</em></h5> -->
          
        </div>
        
        <div class="row">
          <!-- <div class="media aos-init aos-animate" data-aos="fade-In" data-aos-delay="100">
              <div class="img-ab-"><img src="images/icons/customer-service.svg" alt="icon" class="layer"></div>
              <div class="media-body">
                 <h4><em>5 Minutes </em> Policy Issuance</h4>
              </div>
          </div> -->
          
          <div class="col-sm-6">
             <h2 class="d-flex justify-content-between aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><span><em>ऋण</em> मूल्य</span></h2>

             <div class="loanprice-stat aos-init aos-animate" data-aos="fade-In" data-aos-delay="300">
                <ul>
                    <li><i class="fas fa-check"></i> ब्याज दर: 36% से 48% प्रति वर्ष कम करने के आधार पर।</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> प्रसंस्करण शुल्क: 3% ऋण राशि 3% की कटौती के बाद स्थानांतरित की जाएगी</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> 
                      विलंब शुल्क: 2% या ₹300 जो भी अधिक हो + विलंबित भुगतान पर प्रति माह 3% ब्याज</li>
                </ul>
                <ul>
                    <li><i class="fas fa-check"></i> कानूनी शुल्क: कंपनी पर लगाए गए वास्तविक शुल्क के अनुसार।</li>
                    <li><i class="fas fa-check"></i> चेक बाउंस: 400 रुपये</li>
                    <li><i class="fas fa-check"></i> एनएसीएच फेल: 100 रुपये</li>
                </ul>
                <ul>

                    <li><i class="fas fa-check"></i> प्रारंभिक भुगतान/आंशिक भुगतान: शून्य/शून्य</li>
                </ul>
             </div>
          </div>


          <div class="col-sm-6 px-5">
            <a id="applyform" style="position: absolute; top: -100px;">.</a>
             <h2 class="d-flex justify-content-between aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
              <span><em>फॉर्म</em> अप्लाई करें </span></h2>
             <form action="applyloan" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                @csrf

                <input type="hidden" value="website" name="source" >
             <div class="row">
                <div class="col-sm-12">
                   <div class="formrow formrow2 mt-3">
                      <label>आपका नाम <span>*</span></label>
                      <input type="text" class="form-control" placeholder="अपना नाम दर्ज करें"  value="{{old('name')}}"
                      name="name" required data-parsley-error-message="कृपया अपना नाम दर्ज करें"
                      >
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>ईमेल (वैकल्पिक)</label>
                      <input type="email" class="form-control" name="email"placeholder="अपनी ईमेल दर्ज करें" value="{{old('email')}}"
                       data-parsley-error-message="कृपया सही ईमेल दर्ज करें">
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>मोबाइल <span>*</span></label>
                      <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}"
                       placeholder="अपना मोबाइल नंबर दर्ज करें" data-parsley-length="[10, 10]"
                      required data-parsley-error-message="कृपया मान्य 10-अंक का मोबाइल नंबर प्रदान करें">
                   </div>
                </div>                         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                    
                      <label>बैंक स्टेटमेंट (1 वर्ष) <span>*</span><span style="font-size: 10px;color: black;">(Multiple)</span></label>
                      <input id="files" multiple="true" class="form-control" name="files[]" type="file" accept="image/jpg,pdf" />
                      <!-- <a class="button form-control" href="#popup1">Click</a> -->
                      <span id="bank_statement"></span>
                      <!-- <input type="hidden" class="form-control" name="bank_statement[]"
                      required data-parsley-error-message="upload bank statement."> -->
                      <span style="color:green; font-size:12px; padding-top:-50px;">केवल pdf, jpg, jpeg.</span>
                      <div id="list11" style="display: block;"></div>
                   </div>
                 </div>         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>आधार कार्ड <span>*</span><span style="font-size: 10px;color: black;">(फ्रंट साइड, बैक साइड)</span></label>
                     
                     <input id="files1" multiple="true" class="form-control" name="files1[]" type="file" accept="image/jpg,pdf" />
                      <span id="adhar_card"></span>
                      
                       <span style="color:green; font-size:12px; padding-top:-50px;">केवल pdf, jpg, jpeg.</span>
                       <div id="list22" style="display: block;"></div>
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>पासपोर्ट साइज फोटो <span>*</span></label>
                      <input type="file" class="form-control" name="photo" required data-parsley-error-message="कृपया पासपोर्ट फोटो उपलोड करें">
                      <span style="color:green; font-size:12px; padding-top:-50px;">केवल jpg, jpeg.</span>
                    </div>
                 </div>         
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>पैन इमेज <span>*</span></label>
                     
                      <input type="file" class="form-control" accept="image/jpg,pdf" name="pan_card" required data-parsley-error-message="कृपया पैन कार्ड उपलोड करें.">
                      <span style="color:green; font-size:12px; padding-top:-50px;">केवल pdf, jpg, jpeg.</span>
                    </div>
                 </div>

                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>आवश्यक ऋण राशि (₹) <span>*</span></label>
                      <input type="text" class="form-control" placeholder="₹10000" value="{{old('loan_amount')}}"
                       name="loan_amount" required data-parsley-error-message="कृपया ऋण की राशि दर्ज करें">
                   </div>
                 </div>        
                 <div class="col-sm-6">
                   <div class="formrow formrow2 mt-3">
                      <label>मौजूदा ऋण किश्त राशि (यदि कोई हो) <span>*</span></label>
                      <input type="text" class="form-control" placeholder=""
                      value="{{old('existing_emi')}}"  name="existing_emi">
                   </div>
                 </div>
                 <div class="col-sm-8 offset-sm-4 text-right formrow2">
                     <button href="#" class="btnpora btn-rd2 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">जमा करना</button>
                  </div>
             </div>
            </form>
          </div>





        </div>
      </div>

    </div>
  </div>
</section>

<div class="enquire-form pad-tb pora-bg1 text-white whychooseus my-5">
            
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="cta-heading text-center"> <span class="subhead aos-init" data-aos="fade-up" data-aos-delay="100">हम कैसे काम करते हैं?</span>
                  
                </div>

                <!-- start -->
                <div class="row work-box">
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="one"><span>1</span></div>
                        <div class="box-icon-home">
                            <figure><img src="{{asset('front/images/how-icon1.png')}}" alt=""></figure>
                        </div>
                        <p>आवेदन करने में आसानी</p>
                    </div>
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="one"><span>2</span></div>
                        <div class="box-icon-home">
                            <figure><img src="{{asset('front/images/how-icon3.png')}}" alt=""></figure>
                        </div>
                        <p>	तीव्र निर्णय </p>
                    </div>
                    <div class="col-sm-4 col-md-4 text-center aos-init" data-aos="fade-up" data-aos-delay="300">
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

<!-- emi start -->
<!--// loan calculator -->
          <div class="row loan-calculator">
            <div class="col-sm-6">
                <h3 class="font-weight-bold knowEmiHeading">अपनी किश्त जानें</h3>

                <div class="ps-3 loanSlider1 pr-3">
                    <label for="amountRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>ऋण की राशि</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end " id="amountInput" placeholder="00000" size="4" onkeyup="$('#amountRange').val(this.value);" min="1000" max="9900000" step="1000" value="100000">
                    </label>

                    <input type="range" class="progress" id="amountRange" oninput="$('#amountInput').val(this.value);" onchange="$('#amountActual').val(this.value);" value="100000" min="1000" max="9900000" step="1000">
                    <!-- <input type="range" class="form-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all progress"> -->
                    <!-- <div class="row">
                      <div class="col-6 ps-0 text-start"><span class="rupee small">1 Lac</span></div>
                      <div class="col-6 pe-0 text-end"><span class="rupee small">10 Cr</span></div>
                    </div> -->
                </div>
                <div class="ps-3 tenure my-4 pr-3">
                    <label for="tenureRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>कार्यकाल (वर्ष)</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="tenureInput" placeholder="00000" size="1" onkeyup="$('#tenureRange').val(this.value);" min="1" max="30" step="1" value="1">
                    </label>
                    <input type="range" class="form-range progress" id="tenureRange" oninput="$('#tenureInput').val(this.value);" onchange="$('#tenureInput').val(this.value);" value="1" min="1" max="30" step="1">
                    
                </div>
                <div class="ps-3 interest pr-3">
                    <label for="interestRange" class="form-label d-flex justify-content-between align-items-start mt-5">
                      <span>ब्याज दर (% पी.ए.)</span>
                      <input type="text" class="py-0 bg-transparent border-0 border-bottom border-dark text-end" id="interestInput" placeholder="00000" size="1" onkeyup="$('#interestRange').val(this.value);" min="0" max="15" value="6.7">
                    </label>
                    <input type="range" class="form-range progress" id="interestRange" oninput="$('#interestInput').val(this.value);" onchange="$('#interestInput').val(this.value);" value="6.7" min="0" max="15" step="1">
                    
                </div>
            </div>
            <div class="col-sm-6">
             
                <div class="text-center loan-emi-box text-dark">
                  <div class="klc-amount-inner p-lg-4 p-3">
                     <div class="total-calculation">
                        <div class="single-total">
                           <h4 class="mb-lg-3 mb-4"><span>मासिक ईएमआई</span></h4>
                            <h2 class="emi-price" style="color: #1e40a2;">₹ <span id="monthlyEMI"></span></h2>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">मूल राशि</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="principleAmount" class="float-right">0</span></h6>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">ब्याज राशि</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="interestAmount" class="float-right">0</span></h6>
                        </div>
                        <div class="single-total d-flex align-items-sm-center justify-content-between">
                           <h6><span class="float-left">कुल भुगतान राशि</span></h6>
                           <h6 style="color: #1e40a2;">₹<span id="totalAmountPayable" class="float-right"></span></h6>
                        </div>

                        <div>
                           <a href="#applyform" class="btn klc-btn">अभी अप्लाई करें</a>
                           </div>
                     </div>
                  </div>
               </div>
            
            </div>
          </div> 
<!-- emi end -->


          
          <!-- loan calculator //-->

          


<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script  src="{{asset('front/script.js')}}"></script>
<!-- emi end -->



<section class="pad-tb pt-0">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
          <div class="loansecond-cont aos-init aos-animate" data-aos="fade-left">
             <h5>आवश्यक दस्तावेज़</h5>
             <ul class="docreq-list">
                  <li><i class="fas fa-check-square"></i> 1 साल का बैंक स्टेटमेंट </li>
                  <li><i class="fas fa-check-square"></i> 2 फोटो</li>
                  <li><i class="fas fa-check-square"></i> निवास प्रमाण पत्र</li>
                  <li><i class="fas fa-check-square"></i> पेन कार्ड</li>
                  <li><i class="fas fa-check-square"></i> 3 ऋण स्वीकृति के बाद हस्ताक्षर के साथ खाली चेक</li>
                  <li><i class="fas fa-check-square"></i> 2 गारंटर / गवाह</li>
                  <li><i class="fas fa-check-square"></i> राशि 10000 से रु. 50000-</li>
                  <li><i class="fas fa-check-square"></i> रोई - 36-48% पीए कम करना </li>
                  <li><i class="fas fa-check-square"></i> आवेदक प्रोफाइल के अनुसार अन्य दस्तावेजों का अनुरोध किया जा सकता है
             </ul>

          </div>
      </div>

      <div class="col-sm-6">
          <div class="loansecond-cont aos-init aos-animate" data-aos="fade-left">
             <h5>योग्यता </h5>
             <ul class="docreq-list">
                  <li><i class="fas fa-check-square"></i> पिछले 5 महीने में - 4 वेतन बैंक में जमा होना चाहिए </li>
                  <li><i class="fas fa-check-square"></i> आपकी मौजूदा लोन किश्त आपके वेतन के 50% से अधिक नहीं होनी चाहिए</li>
                  <li><i class="fas fa-check-square"></i> आपके पास दिल्ली/एनसीआर एड्रेस प्रूफ होना चाहिए</li>
                  <li><i class="fas fa-check-square"></i> मासिक वेतन 9 हजार से ज्यादा होना चाहिए</li>
                  <li><i class="fas fa-check-square"></i> आपके पास पैन कार्ड होना चाहिए
             </ul>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="pad-tb pt-0">
  <div class="container">
    <div class="col-sm-10 offset-sm-1">
         <div class="loan-otp">
             <div class="row">
                <div class="col-sm-12 col-md-6">
                    <img src="{{asset('front/images/girl-img.png')}}" style="max-width: 100%;" class="aos-init aos-animate" data-aos="fade-right">
                </div>
                <div class="col-sm-12 col-md-6">
                    <h4 class="aos-init aos-animate" data-aos="fade-down">ऋण की आवश्यकता है?</h4>
                    <h6 class="aos-init aos-animate" data-aos="fade-up">क्या आप ऋण की तलाश कर रहे हैं? शुरू करने के लिए नीचे दिए गए बटन पर क्लिक करें।</h6>
                    <div class="otpfiled">
                         <a href="apply-loan.html" class="btnpora btn-rd2 aos-init aos-animate" data-aos="fade-up">ऋण के लिए अभी आवेदन करें</a>
                    </div>

                </div>
             </div>

              
         </div>      
    </div>
  </div>
  <div class="back-to-top" title="Go to top">
      <img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn">
  </div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script>

   var drop = $("input");
drop
  .on("dragenter", function (e) {
    $(".drop").css({
      border: "4px dashed #09f",
      background: "rgba(0, 153, 255, .05)"
    });
    $(".cont").css({
      color: "#09f"
    });
  })
  .on("dragleave dragend mouseout drop", function (e) {
    $(".drop").css({
      border: "3px dashed #DADFE3",
      background: "transparent"
    });
    $(".cont").css({
      color: "#8E99A5"
    });
  });

$(document).ready(function () {
function handleFileSelect(evt) {
  var files = evt.target.files; // FileList object

  // ajax
  if (files[0].type.match("image.*") || files[0].type.match("pdf")){
        var fd = new FormData();
        var filesData =  $('#files')[0].files;
        fd.append('file',filesData[0]);
        fd.append('_token',"{{ csrf_token() }}");

          $.ajax({
              url: "{{url('/upload-pdf')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                var ap = `
                <div onclick="return $(this).remove();"">
                ${res.substring(15)} <span style="color:red">X</span>  
                <input type="hidden" name="bank_statement[]" value="${res}">
                </div>
                `
                $('#bank_statement').append(ap);
              },
              error: function(data){
                  console.log(data);
              }     
          });
    // ajax end
  }
}

$("#files").change(handleFileSelect);

function handleFileSelect1(evt) {
  var files1 = evt.target.files; // FileList object
  
  // ajax
  if (files1[0].type.match("image.*") || files1[0].type.match("pdf")){
        var fd = new FormData();
        var filesData11 =  $('#files1')[0].files;
        fd.append('file',filesData11[0]);
        fd.append('_token',"{{ csrf_token() }}");

          $.ajax({
              url: "{{url('/upload-image')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                var ap = `
                <div onclick="return $(this).remove();"">
                ${res.substring(8)} <span style="color:red">X</span>   
                <input type="hidden" name="adhar_card[]" value="${res}">
                </div>
                `
                $('#adhar_card').append(ap);

              },
              error: function(data){
                  console.log(data);
              }     
          });
    // ajax end
  }
}

$("#files1").change(handleFileSelect1);
  });
</script>