@extends('admin.master.adminMaster')
@section('main-content')
   
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-5 mb-4">Add Excel File</h2>
                        

                        <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">Entry Form</h6>
                                  <!-- <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                  <i class="fas fa-minus"></i></button>
                                              </div> --> 
    </div>
    <div class="card-body" id="demo">
      <form action="../importData" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
        @csrf
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label for="inputName">Upload Excel File <span class="redcolor">*</span> </label>
            <input type="file" class="form-control" name="uploaded_file" required >
          </div>
        </div>

        <div class="col-sm-2">
</div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="inputName"> 	Download the Excel file containing Customers detail information.<br /> (<b>Important</b>: Do not change title name of the column.)</label><br />
            <a href="excel-Download?data=customers" target="_blank">Download Now</a>
          </div>
        </div>
        
        <!-- <div class="col-sm-6"></div> -->
        <div class="col-sm-4">
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
  
  
                    </div>
                </main>
                
                @endsection