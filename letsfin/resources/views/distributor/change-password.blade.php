@extends('distributor.master')
@section('main-content')

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-5 mb-4">Change Password</h2>
                        <div class="row">
                                 <div class="col-md-12">
                                          <div class="card card-primary">
                                            <div class="card-header">
                                              <h6 class="card-title">Change Password Form</h6>
                                              <!-- <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                  <i class="fas fa-minus"></i></button>
                                              </div> -->
                                            </div>
                                            <form action="dist-password-change" method="post" id="form" data-parsley-validate>
                                              @csrf
                                            <div class="card-body" id="demo">
                                              <div class="row">
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                          <label for="inputName">Old Password</label>
                                                          <input type="text" class="form-control" name="oldPassword" required data-parsley-error-message="Please enter old password.">
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-6"></div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                          <label for="inputName">New Password</label>
                                                          <input type="text" class="form-control" name="newPassword" id="password" required data-parsley-error-message="Please enter new password." >
                                                        </div>
                                                   </div>
                                                   <div class="col-sm-6"></div>
                                                   <div class="col-sm-6">
                                                        <div class="form-group">
                                                          <label for="inputName">Old Password</label>
                                                          <input type="text" class="form-control" name="confirmPassword" required name ="confirmPassword" data-parsley-equalto="#password" 
                                                          data-parsley-error-message="confirm password should be same as password." >
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
                                            </div>
                                          </form>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                          
                                          <!-- end -->
                                 </div>
                        </div>
                    </div>
                </main>
                @endsection
