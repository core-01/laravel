@extends('admin.master.adminMaster')
@section('main-content')

<style>
a button{
    padding:10px; 
    background:#5554FF; 
    border-radius:10px;
    margin-bottom:5px;
    color:#fff; 
    float:right;
}
    </style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Admins</h2>

            <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <a href="{{url('add-new-admin')}}">
                <button style="padding:10px; background:#5554FF; border-radius:10px;margin-bottom:5px;color:#fff; float:right;">Add new Admin</button>
                    </a> </div>
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Admin List</h6>
                            <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                      <i class="fas fa-minus"></i></button>
                                  </div> -->
                        </div>
                        <div class="card-body" id="demo">
                            <div class="row">

                                <div class="table-responsive col-sm-12 fixTableHead">
                                    @if (count($admins)>0)
                                    <table class="loantable table table-bordered table-striped " width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">Sr.no</th>

                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th> 
                                                <th>Username</th>
                                                <th>password</th>
                                                <th>Status</th>
                                                <th>Edit</th> 
                                                <th>Delete</th> 
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($admins as $key =>$item)
                                            <tr>
                                            <td width="2%">{{  $key+1  }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->password }}</td>
                                            <td>{{ $item->status==1?'Active':'Deactive' }}</td>
                                            <td><a href ="{{url('update-admin',['id'=>base64_encode($item->id)])}}">Edit</a></td>
                                            <td><a onclick="return deleteFun('You are to delete this Admin.')" href ="{{url('delete-admin',['id'=>base64_encode($item->id)])}}">Delete</a></td>
                                           
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    @endif
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