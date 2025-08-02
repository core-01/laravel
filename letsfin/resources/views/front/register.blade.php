@extends('front.master.master')
@section('main-content')
<section class="page-banner">
        <div class="image-layer lazy-image">
            <div class="bottom-rotten-curve alternate"></div>
            <div class="auto-container">
                <h1>Distributor Register</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Distributor Register</li>
                </ul>
            </div>
        </div>
</section>

<section class="about-bg pt-5 pb-5" style="background: transparent;">
  <div class="container">
    <div class="row justify-content-between">
    <div class="col-sm-6 col-md-8 offset-sm-2 aos-animate" data-aos="fade-up">
         <div class="enquiry-form">

            

            <form action="{{url('distributor-self-register')}}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                                                @csrf
                                              <div class="row">
                                                   <div class="col-sm-4">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Name <span class="redcolor">*</span> </label>
                                                          <input type="text" class="form-control" name="name" required data-parsley-error-message="Please enter distributor name.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Email</label>
                                                          <input type="email" data-parsley-type="email" class="form-control" name="email" data-parsley-error-message="This email not valid.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Mobile <span class="redcolor">*</span></label>
                                                          <input type="number" class="form-control" name="mobile" data-parsley-type="digits" data-parsley-length="[10, 10]"
                                                          	 required data-parsley-error-message="Please enter valid number.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Address</label>
                                                          <textarea class="form-control" name="address">{{old('address')}}</textarea>
                                                        </div>
                                                   </div>
                                                   <!-- <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Password <span class="redcolor">*</span></label>
                                                          <input type="text" class="form-control" name="password" id="password" required data-parsley-error-message="Password cannot be empty." >
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Confirm Password <span class="redcolor">*</span></label>
                                                          <input type="text" class="form-control" required name ="confirmPassword" data-parsley-equalto="#password" 
                                                          data-parsley-error-message="confirm password should be same as password."
                                                          >
                                                        </div>
                                                   </div> -->

                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Bank Statement (1 year) *<span style="font-size: 10px;color: black;">(Multiple)</span></label>
                                                          <input id="files" multiple="true" class="form-control" name="files[]" type="file" accept="image/jpg,pdf" />
                     
                                                        <span id="bank_statement"></span>
                                                         
                                                        </div>
                                                   </div>

                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Aadhar Card *<span style="font-size: 10px;color: black;">(Front side, Back Side)</span></label>
                                                          
                                                          <input id="files1" multiple="true" class="form-control" name="files1[]" type="file" accept="image/jpg,pdf" />
                                                          <span id="adhar_card"></span>
                                                         
                                                        </div>
                                                   </div>


                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Passport Size Photo <span class="redcolor">*</span></label>
                                                          
                                                          <input type="file" class="form-control" name="photo" required data-parsley-error-message="upload photo.">
                                                          <span style="color:green; font-size:12px; padding-top:-50px;">only jpg, jpeg.</span>
                                                         
                                                        </div>
                                                   </div>


                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Pan Image <span class="redcolor">*</span></label>
                                                          
                                                          <input type="file" class="form-control" accept="image/jpg,pdf" name="pan_card" required data-parsley-error-message="upload pan card.">
                                                           <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                    
                                                       
                                                        </div>
                                                   </div>

                                                   

                                                   <div class="col-sm-6"><input type="hidden" name="status" Value="Inactive"></div>
                                                   <div class="col-sm-6">
                                                        <div class=" form-group">
                                                            <label for="inputName">&nbsp;</label>
                                                            <div class="clear"></div>
                                                            <input type="submit" value="Register" class="btn btn-success float-right">
                                                        </div>
                                                  </div>
                                              </div>
                                            </form>
         </div>

           
    </div>

  </div>
</section>

<div class="back-to-top" title="Go to top"><img src="{{asset('front/images/gototop-btn.png')}}" alt="go to top btn"></div>
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
              url: "{{url('/upload-distributor-pdf')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                console.log(res);
                var ap = `
                <div id="${res.substring(15,29)}">
                ${res.substring(15)} <span style="color:red" onclick="removeImage('${res.substring(15)}','${res.substring(15,29)}');">X</span>  
                <input type="hidden" name="bank_statement[]" value="${res.substring(15)}">
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
              url: "{{url('/upload-distributor-image')}}",
              data:fd,
              type : 'post',
              contentType: false,
              processData: false,
              success: (res) => {
                var ap = `
                <div id="${res.substring(8,19)}">
                ${res.substring(8)} <span style="color:red" onclick="removeImage('${res.substring(8)}','${res.substring(8,19)}');">X</span>   
                <input type="hidden" name="adhar_card[]" value="${res.substring(8)}">
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


  function removeImage(image_name,id){
    // console.log($(`#${id}`).html());
    // $(`#${id}`).remove();

    $.ajax({
      type:'get',
      url:'{!! URL::to('remove-files') !!}',
      data:{image_name:image_name},
      success:function(res){
        $(`#${id}`).remove();
      }
    })
  }
</script>