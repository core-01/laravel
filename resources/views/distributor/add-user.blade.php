@extends('distributor.master')
@section('main-content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Add User</h2>

            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="card-title">Entry Form</h6>
                    <!-- <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                  <i class="fas fa-minus"></i></button>
                                              </div> -->
                </div>
                <div class="card-body" id="demo">
                  <form action="../applyloan" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                    @csrf
                    <div class="row">
                      
                <input type="hidden" value="{{Session::get('distributor')->name}}" name="source" >
                <input type="hidden" value="{{Session::get('distributor')->id}}" name="id" >
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Applicant's Name <span class="redcolor">*</span> </label>
                                <input type="text" class="form-control" name="name" required data-parsley-error-message="Please enter applicant name.">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Email</label>
                                <input type="email" class="form-control"  name="email" data-parsley-error-message="Please enter valid email.">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Mobile <span class="redcolor">*</span></label>
                                <input type="number" class="form-control"  name="mobile" value="{{old('mobile')}}"
                       placeholder="" data-parsley-length="[10, 10]"
                      required data-parsley-error-message="Please provide valid 10-digit mobile number.">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Bank Statement (1 year) <span class="redcolor">*</span></label>
                                <input id="files" multiple="true" class="form-control" name="files[]" type="file" accept="image/jpg,pdf" />
                      <span id="bank_statement"></span>
                      <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                      <div id="list11" style="display: block;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Aadhar Card <span class="redcolor">*</span></label>
                                <input id="files1" multiple="true" class="form-control" name="files1[]" type="file" accept="image/jpg,pdf" />
                      <span id="adhar_card"></span>
                       <span style="color:green; font-size:12px; padding-top:-50px;">only pdf, jpg, jpeg.</span>
                       <div id="list22" style="display: block;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Passport Size Photo <span class="redcolor">*</span></label>
                                <input type="file" class="form-control" accept="image/jpg"  name="photo" required data-parsley-error-message="upload applicant photo.">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Pan Image <span class="redcolor">*</span></label>
                                <input type="file" class="form-control" accept = "image/jpg,jpeg,pdf"  name="pan_card" required data-parsley-error-message="upload pan card.">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Required Loan Amount (₹) <span class="redcolor">*</span></label>
                                <input type="number" class="form-control" name="loan_amount" required data-parsley-error-message="Enter required amount.">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="inputName">Existing loan EMI amount (If any) <span
                                        class="redcolor">*</span></label>
                                <input type="number" class="form-control" name="existing_emi" >
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputName">&nbsp;</label>
                                <div class="clear"></div>
                                <input type="submit" value="Submit" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- end -->

            <div class="card card-primary mt-4">
                <div class="card-header">
                    <h6 class="card-title">Distributor List</h6>
                    <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                      <i class="fas fa-minus"></i></button>
                                  </div> -->
                </div>
                <div class="card-body" id="demo">
                    <div class="row">
                        <div class="table-responsive col-sm-12 fixTableHead">
                            <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="2%">Sr.no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Bank Statement</th>
                                        <th>Aadhar Card</th>
                                        <th>Passport Size Photo</th>
                                        <th>Pan Image</th>
                                        <th>Required Loan Amount</th>
                                        <th>Existing loan EMI amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loanRequest as $item)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>
                                            @php
                                            $bankS = json_decode(stripslashes($item->bank_statement));
                                            // dd($bankS);
                                        @endphp
                                        @if(!empty($bankS))
                                        @foreach($bankS as $v)

                                        <a target="_blank" href="../../view-files?id={{asset($v)}}">View</a> ||
                                        @endforeach
                                        @endif
                                    </td>
                                        <td>
                                        @php
                                            $adharD = json_decode(stripslashes($item->adhar_card));
                                        @endphp
                                         @if(!empty($adharD))
                                        @foreach($adharD as $v)
                                        <a target="_blank" href="../../view-files?id={{asset($v)}}">View</a> ||
                                        @endforeach
                                        @endif
                                        </td>
                                        <td><a target="_blank" href="../../file-view?id={{asset('upload/photo/'.$item->photo)}}">View</a></td>
                                        <td><a target="_blank" href="../../file-view?id={{asset('upload/pan_card/'.$item->pan_card)}}">View</a></td>
                                        <td>₹{{ $item->loan_amount }}</td>
                                        <td>₹{{ $item->existing_loan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
<ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                    @if (count($loanRequest))
                        
                    {!! $loanRequest->links() !!}
                    @endif
                                                
                                        </ul>
                    <!-- /.card-body -->

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </main>



    
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
    @endsection