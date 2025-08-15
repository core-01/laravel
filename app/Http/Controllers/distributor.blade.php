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
                                              <form action="../distributor-register" method="post" enctype="multipart/form-data" id="form" data-parsley-validate >
                                                @csrf

                                                <input type="hidden" name="status" value="Active" >
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
                                                   <div class="col-sm-6">
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
                                      <div class="table-responsive col-sm-12">
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($distributor as $item)
                                
                           
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->distributor_id }}</td>
                                    <td>{{ $item->visible_pass }}</td>
                                    <td><a onclick="return deleteFun('You are sure active this distributor?')" href="{{$item->status=='Inactive'?'../../active-distributor/'.$item->distributor_id:'#' }}  " class="btn  loginbtn" style="background: {{$item->status=='Active'?'#5cb85c':'red' }}">{{ $item->status }}</a></td>
                                </tr>
                                @endforeach
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