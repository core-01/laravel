@extends('admin.master.adminMaster')
@section('main-content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-5 mb-4">Create Admin</h2>
                        <div class="row">
                                 <div class="col-md-12">
                                          <div class="card card-primary">
                                            <div class="card-header">
                                              <h6 class="card-title">Admin Details</h6>
                                             
                                            </div>
                                          <div style="padding:20px">
                                            <form action="{{ url('add-admin') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                         
                                                     <div class="row"> 
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Name </label>
                                                              <input type="text" class="form-control" name="name" value="{{old('name')}}" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Email </label>
                                                                  <input type="email" class="form-control" name="email" value="{{old('email')}}"
                                                                  data-parsley-error-message="Enter valid email." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Mobile</label>
                                                                  <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}"
                                                              data-parsley-error-message="Enter valid number." required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Username</label>
                                                                  <input type="text" class="form-control" name="username" value="{{old('username')}}"
                                                                    data-parsley-error-message="Create username." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">password </label>
                                                              <input type="password"class="form-control" name="password"
                                                              data-parsley-error-message="Enter New password." required>
                                                            </div>
                                                        </div> 


                                                        <div class="col-md-12">
                                                          <div class="card card-primary">
                                                              <div class="card-header">
                                                                  <h6 class="card-title">Links</h6> 
                                                              </div>
                                                              <div class="card-body" id="demo">
                                                                  <div class="row">
                                                                      <div class="table-responsive col-sm-12 fixTableHead"> 
                                                                          <table class="loantable table table-bordered table-striped" width="100%"
                                                                              cellspacing="0">
                                                                              <thead>
                                                                                  <tr>
                                                                                      <th width="2%">Sr.no</th> 
                                                                                      <th>Tab</th>
                                                                                      <th>Action</th> 
                                                                                  </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                @if (count($url)>0)
                                                                                  @foreach ($url as $link)
                                                                                  <tr> 
                                                                                  <td>{{$loop->index+1}}</td>
                                                                                  <td>{{$link->manu_name}}</td>
                                                                                  <td><input type="checkbox" value="{{$link->id}}" name="links[]"></td>
                                                                                    </tr>
                                                                                  @endforeach
                                                                                @endif
                                                                                
                                                                              </tbody>
                                                                          </table>
                                                                          
                                                                          
                                                                      </div>




                                                                  </div>
                                                                  <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                                                      

                                                                  </ul>
                                                                  <!-- /.card-body -->

                                                              </div>
                                                              <!-- /.card-body -->
                                                          </div>
                                                          <!-- /.card -->

                                                          <!-- end -->
                                                      </div>


                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <input type="checkbox"   name="status"  value="1" >
                                                              <label for="inputName">Status</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12" style="margin-right:20px; padding-right:20px; padding-bottom:20px;">
                                                            <div class="form-group">
                                                                <input type="submit" value="Submit" class="btn btn-success float-right">
                                                            </div>
                                                        </div>
                                                   
                                                    </form>
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