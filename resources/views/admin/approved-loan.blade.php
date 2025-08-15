@extends('admin.master.adminMaster')
@section('main-content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-5 mb-4">Approve Loan</h2>
                        <div class="row">
                                 <div class="col-md-12">
                                          <div class="card card-primary">
                                            <div class="card-header">
                                              <h6 class="card-title">Loan Details</h6>
                                              <!-- <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                                  <i class="fas fa-minus"></i></button>
                                              </div> -->
                                            </div>
                                          <div style="padding:20px">
                                            <form action="../approvedloan" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                        @method('put')
                                                     <div class="row">
                                                     <input type="hidden" value="{{$loan?$loan->loan_request_number	:''}}" name="loan_request_number" >
                                                        <input type="hidden" value="Paid" name="status" >

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Loan Duration (Month) </label>
                                                              <input type="number" class="form-control" name="loan_duration" value="{{$loan?$loan->loan_duration:''}}" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Loan Amount </label>
                                                                  <input type="number" class="form-control" name="loan_amount" value="{{$loan?$loan->approve_loan_amount:''}}"
                                                                  data-parsley-error-message="Enter loan amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Rate of Interest</label>
                                                                  <input type="number" class="form-control" name="rate_of_intrest" value="{{$loan?$loan->interest:''}}"
                                                              data-parsley-error-message="Enter rate of intrest." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">EMI Amount </label>
                                                              <input type="number" class="form-control" name="emi_amount"  value="{{$loan?$loan->emi_amount:''}}"
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                  <label for="inputName">Processing Fees </label>
                                                                  <input type="number" class="form-control" name="processing_fees" value="{{$loan?$loan->processing_fees:''}}"
                                                              data-parsley-error-message="Enter processing fees." required >
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                  <label for="inputName">EMI Date </label>
                                                                  <input type="Date" class="form-control" name="EMI_date"  value="{{$loan?$loan->next_emi_date:''}}"
                                                              data-parsley-error-message="Enter EMI Date." required >
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                  <label for="inputName">Transection Id </label>
                                                                  <input type="text" class="form-control" name="transection_id" value="{{$loan?$loan->transaction_id:''}}"
                                                              data-parsley-error-message="Enter transection Id." required >
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