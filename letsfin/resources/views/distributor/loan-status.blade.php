@extends('distributor.master')
@section('main-content')

<?php
use App\Models\ApproveLoan;
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-5 mb-4">Loan Status</h2>
                        <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">Entry Form</h6>
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
                                    <th>Mobile</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Duration</th>
                                    <th>Approve Loan Amount</th>
                                    <th>Rate of Interest</th>
                                    <th>EMI Amount</th>
                                    <th>Processing Fees</th>
                                    <th>Loan Request Date</th>
                                    <th>Loan Trasnfer Date</th>
                                    <th>Loan Approved Date</th>
                                    <th>Reject Reason</th>
                                    <th width="5%">Admin Status</th>
                                    <th width="5%">User Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loanRequest as $item)
                                    <?php
                                            $approveLoan = ApproveLoan::where('loan_request_number',$item->loan_request_number)->first();
                                    ?>
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>₹{{ $item->loan_amount }}</td>
                                    <td>{{ $approveLoan && $approveLoan->loan_duration !=null ?$approveLoan->loan_duration.' Month':'' }}</td>
                                    <td>{{ $approveLoan && $approveLoan->loan_amount !=null ?'₹'.$approveLoan->loan_amount:'' }}</td>
                                    <td>{{ $approveLoan && $approveLoan->interest !=null ?'₹'.$approveLoan->interest:'' }}</td>
                                    <td>{{ $approveLoan && $approveLoan->emi_amount !=null ?'₹'.$approveLoan->emi_amount:'' }}</td>
                                    <td>{{ $approveLoan && $approveLoan->processing_fees !=null ?'₹'.$approveLoan->processing_fees:'' }}</td>
                                    
                                      <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                    <td>{{ $approveLoan && $approveLoan->approved_date !=null ? date('d-m-Y',strtotime($approveLoan->approved_date)):'' }}</td>
                                    <td>{{ $approveLoan && $approveLoan->loan_trasnfer_date !=null ? date('d-m-Y',strtotime($approveLoan->loan_trasnfer_date)):'' }}</td>
                                    
                                    <td>{{ $approveLoan && $approveLoan->reject_reason !=null ?$approveLoan->reject_reason:'' }}</td>

                                    <td>
                                        <strong class="{{ $item->loan_status == 'Approved' ?'greentext':'' }} {{ $item->loan_status == 'Reject' ||$item->loan_status == 'Rejected' ?'redtext':'' }}">{{ $item->loan_status }}</strong>           
                                    </td>
                                    <td>
                                        <strong class="{{ $item->user_status == 'Accepted' ?'greentext':'' }}">{{ $item->user_status }}</strong>           
                                    </td>
                                </tr>
                                
                                @endforeach
                                <!-- <tr>
                                    <td>2</td>
                                    <td>Harpreet Singh</td>
                                    <td>+91-987398989*5</td>
                                    <td>₹25000</td>
                                    <td>
                                        <strong class="redtext">Rejected</strong>           
                                    </td>
                                    <td>
                                        <strong class="redtext">Rejected</strong>           
                                    </td>
                                </tr> -->

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
                </main>
               @endsection