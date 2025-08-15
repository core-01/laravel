@extends('admin.master.adminMaster')
@section('main-content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Add Distributor</h2>
            <div class="row">
                     <div class="col-md-12">
                        <div class="card card-primary">
                                            <div class="card-header">
                                              <h6 class="card-title">Entry Form</h6>
                                              <!-- <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                  <i class="fas fa-minus"></i></button>
                                              </div> -->
                                            </div>
                                            <div class="card-body" id="demo">
                                              <form action="{{url('distributor-register')}}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                                                @csrf

                                                <input type="hidden" name="status" value="Inactive" >
                                              <div class="row">
                                                   <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <label for="inputName">Name <span class="redcolor">*</span> </label>
                                                          <input type="text" class="form-control" name="name" required data-parsley-error-message="Please enter distributor name.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <label for="inputName">Email</label>
                                                          <input type="email" data-parsley-type="email" class="form-control" name="email" data-parsley-error-message="This email not valid.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                        <div class="form-group">
                                                          <label for="inputName">Mobile <span class="redcolor">*</span></label>
                                                          <input type="number" class="form-control" name="mobile" data-parsley-type="digits" data-parsley-length="[10, 10]"
                                                          	 required data-parsley-error-message="Please enter valid number.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                        <div class="form-group">
                                                          <label for="inputName">Address</label>
                                                          <textarea class="form-control" name="address">{{old('address')}}</textarea>
                                                        </div>
                                                   </div>
                                                   <!-- <div class="col-sm-6">
                                                        <div class="form-group">
                                                          <label for="inputName">Password <span class="redcolor">*</span></label>
                                                          <input type="text" class="form-control" name="password" id="password" required data-parsley-error-message="Password cannot be empty." >
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                          <label for="inputName">Confirm Password <span class="redcolor">*</span></label>
                                                          <input type="text" class="form-control" required name ="confirmPassword" data-parsley-equalto="#password" 
                                                          data-parsley-error-message="confirm password should be same as password."
                                                          >
                                                        </div>
                                                   </div> -->

                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Bank statement <span class="redcolor">*</span></label>
                                                          <input id="files" multiple="true" class="form-control" name="files[]" type="file" accept="image/jpg,pdf" />
                     
                                                        <span id="bank_statement"></span>
                                                         
                                                        </div>
                                                   </div>

                                                   <div class="col-sm-6">
                                                        <div class="formrow form-group">
                                                          <label for="inputName">Aadhaar Card <span class="redcolor">*</span></label>
                                                          
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
                                    <th>Address</th>
                                    <th>ID</th>
                                    <th>Password</th>
                                    <th>Photo</th>
                                    <th>Bank Statment</th>
                                    <th>Aadhaar Card</th>
                                    <th>Pan Card</th>
                                    <th>Register Date</th>
                                    <th>Approve Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if ($distributor)
                              
                              @foreach ($distributor as $key=>$item)
                                
                           
                                <tr>
                                    <td>{{$distributor->firstItem()+$key}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->distributor_id }}</td>
                                    <td>{{ $item->visible_pass }}</td>
                                    <td>
                                    @if($item->passport_image)
                                        <a target="_blank" href="{{ url('view-file') }}?id={{asset('upload/distributor/photo/'.$item->passport_image)}}">View</a>
                                        @endif
                                    </td>
                                    <td>
                                      <?php
                                        $statement = explode(',',$item->statement);
                                        ?>
                                        @if($item->statement && count($statement)>0 )
                                          @foreach($statement as $statementItem)
                                        <a target="_blank" href="{{ url('view-file') }}?id={{asset('/distributor/bankstatement/'.$statementItem)}}">View</a> || 
                                            
                                          @endforeach
                                        @endif
                                     
                                    </td>
                                    <td>
                                    <?php
                                        $adharcard = explode(',',$item->adhar_card);
                                        ?>
                                        @if($item->statement && count($adharcard)>0 )
                                          @foreach($adharcard as $adharcardItem)
                                        <a target="_blank" href="{{ url('view-file') }}?id={{asset('/distributor/aadhar/'.$adharcardItem)}}">View</a> || 
                                            
                                          @endforeach
                                        @endif
                                    </td>
                                    <td>
                                    @if($item->pan_image)
                                        <a target="_blank" href="{{ url('view-file') }}?id={{asset('upload/distributor/pan_card/'.$item->pan_image)}}">View</a>
                                        @endif
                                    </td>

                                    <td>
                                    @if($item->register_date)
                                    {{ date('d-m-Y',strtotime($item->register_date)) }}
                                    @endif
                                    </td>
                                    <td>
                                    @if($item->Aprrove_date)
                                    {{ date('d-m-Y',strtotime($item->Aprrove_date)) }}
                                    @endif
                                    </td>
                                    <td><a onclick="return deleteFun('{{$item->status=='Active'?'You are sure to inactive this distributor':'You are sure to active this distributor' }}')" href="{{url('active-distributor').'/'.base64_encode($item->id) }}  " class="btn  loginbtn" style="background: {{$item->status=='Active'?'#5cb85c':'red' }}">{{ $item->status }}</a></td>
                                </tr>
                                @endforeach
                                  
                              @endif
                                <!-- <tr>
                                    <td>2</td>
                                    <td>Irshad Khan</td>
                                    <td>irshad@mail.com</td>
                                    <td>+91-987398989*5</td>
                                    <td>715 Delhi</td>
                                    <td>123</td>
                                    <td>fdfd</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Satendar Sadu</td> 
                                    <td>satendar@mail.com</td>
                                    <td>+91-987398989*5</td>
                                    <td>715 noida</td>
                                    <td>123</td>
                                    <td>fdfd</td>
                                </tr> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>

                                      </div>
                                      <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                     
                                      {!! $distributor->links() !!}
                                       
                                    </ul>
                                    <!-- /.card-body -->
                             
                              </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                        
                              <!-- end -->
                     </div>
            </div>
        </div>
    </main>
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