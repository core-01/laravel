@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
   use App\Models\LoanRequest; 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Loan Request</h2>
          
                                       
            <div class="row">
                     <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">Loan Request List</h6>
                                  <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                      <i class="fas fa-minus"></i></button>
                                  </div> -->
                                </div>
                                <div class="card-body" id="demo">
                                  <div class="row">
                                      <div class="table-responsive col-sm-12 fixTableHead">
                        <table class="loantable table table-bordered table-striped " width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2%">Sr.no</th>                  
                                    <th>Procces Status</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Tenure</th>
                                    <th>Existing Loan</th>
                                    <th>Bank Statement</th>                 
                                    <th>Aadhar Card</th>                 
                                    <th>Passport Size Photo</th>                 
                                    <th>Pancard</th>
                                    <th width="5%">Admin Status</th>
                                    <th>Request Date</th>
                                    <th>Approved Date</th>
                                    <th>Loan Trasnfer Date</th>
                                    <th>First EMI Date</th>
                                    
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th>Account Number</th>
                                    <th>IFSC Code</th>
                                    <th>Source</th>
                                    <th>username</th>
                                    <th>password</th>
                                    <th>Loan Duration</th>
                                    <th>Loan Amount</th>
                                    <th>Rate of Interest</th>
                                    <th>EMI Amount</th>
                                    <th>Processing Fees</th>


                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Alternate Mobile</th>
                                    <th>Profession</th>
                                    <th>Reason</th>
                                    <th>Employer Company Name</th>
                                    <th>Salary</th>
                                    <th>Spause</th>
                                    <th>Present Address</th>
                                    <th>Pin Code</th>
                                    <th>Permanent Address</th>
                                    <th>Witness 1</th>
                                    <th>Witness 2</th>
                                    <th>Qualification</th>
                                    <th>Cheque No Received</th>
                                    <th>No Of Month In Present Job</th>
                                    <th>No Of Employee  In Company</th>
                                    <th>Family Income</th>
                                    <th>Other Loan Details</th>
                                    <th>Rent Paid</th>
                                   
                                    <th>Edit</th>
                                    <th width="5%">User Status</th>
                                    

                                </tr>
                            </thead>
                            <tbody id ="addfilter">

                                @if ($loanReq)
                                @foreach ($loanReq as $key =>$item)
                                    <?php
                                 
                                     $bankDetail = BankDetail::where('loan_request_number',$item->loan_request_number)->first();
                                     $customerAuth = CustomerAuth::where('loan_request_number',$item->loan_request_number)->first();
                                     $approveLoan = ApproveLoan::where('loan_request_number',$item->loan_request_number)->first();
                                     $loanReq1 = LoanRequest::where('loan_request_number',$item->loan_request_number)->first();
                                    // dd($customerAuth);
                                    ?>
                               
                                <tr>
                                    
                                    <td>{{ $loanReq->firstItem() + $key}}</td>
                                    <td> <a class="btn  loginbtn" style="background: {{$approveLoan && $approveLoan->procces_status_btn && $approveLoan && $approveLoan->procces_status_btn=='Processed'?'#5cb85c':'Yellow'}}; color:#000;" href="{{ $approveLoan && $approveLoan->procces_status_btn == 'Process now'?'../../Approved-loan/'.$approveLoan->loan_request_number:'#' }}">{{$approveLoan?$approveLoan->procces_status_btn:''}}</a></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>₹{{ $item->loan_amount }}</td>
                                    <td>₹{{$item->existing_loan?$item->existing_loan:0}}</td>
                                    <td>
                                        @php
                                            $bankS = json_decode(stripslashes($item->bank_statement));
                                        @endphp
                                        @if(!empty($bankS))
                                        @foreach($bankS as $v)

                                        <a target="_blank" href="../../view-file?id={{asset($v)}}">View</a> ||
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $adharD = json_decode(stripslashes($item->adhar_card));
                                        @endphp
                                         @if(!empty($adharD))
                                        @foreach($adharD as $v)
                                        <a target="_blank" href="../../view-file?id={{asset($v)}}">View</a> ||
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/photo/'.$item->photo)}}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/pan_card/'.$item->pan_card)}}">View</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn  loginbtn" style="background: {{$item->loan_status && $item->loan_status=='Approved'?'#5cb85c':''}} {{$item->loan_status && $item->loan_status=='Reject'?'#d9534f':''}}; color:#fff;" data-toggle="modal" data-target="#{{$item->loan_status =='Pending' ?'exampleModal':0}}{{$item->id}}" onclick="" >{{$item->loan_status?$item->loan_status:''}}</i></a>

                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Loan Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                          <label for="inputName">Select Status</label>
                                                          <select class="form-control" id="mySelect{{$item->loan_request_number}}" onchange="showModel('{{$item->loan_request_number}}')">
                                                              <option>select</option>
                                                              <option value='Approve'>Approve</option>
                                                              <option value='Reject'>Reject</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="{{$item->loan_request_number}}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="{{$item->loan_request_number}}" name="loan_request_number" >
                                                        <input type="hidden" value="Approved" name="status" >

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Loan Duration (Month) </label>
                                                              <input type="number" class="form-control" name="loan_duration" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Loan Amount </label>
                                                                  <input type="number" class="form-control" name="loan_amount" 
                                                                  data-parsley-error-message="Enter loan amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Rate of Interest</label>
                                                                  <input type="number" class="form-control" name="rate_of_intrest" 
                                                              data-parsley-error-message="Enter rate of intrest." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">EMI Amount </label>
                                                              <input type="number" class="form-control" name="emi_amount" 
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                  <label for="inputName">Processing Fees </label>
                                                                  <input type="number" class="form-control" name="processing_fees" 
                                                              data-parsley-error-message="Enter processing fees." required >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Submit" class="btn btn-success float-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>

                                                <div id="statusdiv" class="reject{{$item->loan_request_number}}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="{{$item->loan_request_number}}" name="loan_request_number" >
                                                        <input type="hidden" value="Reject" name="status" >

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                              <label for="inputName">Reject Reason </label>
                                                              <input type="text" class="form-control" name="reject_reason" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Submit" class="btn btn-success float-right">
                                                            </div>
                                                        </div>
                                                             </div>
                                                    </form>
                                                </div>

                                                  
                                              </div>                  
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $loanReq1?$loanReq1->request_date:'' }}
                                    </td>
                                    <td>
                                        {{ $approveLoan?$approveLoan->approved_date:'' }}
                                    </td>

                                    <td>
                                        {{ $approveLoan?$approveLoan->approved_date:'' }}
                                    </td>

                                    <td>
                                        {{ $approveLoan?date('d-m-Y', strtotime($approveLoan->first_emi_date)):'' }}
                                    </td>

                                   


                                    <td>
                                        {{ $bankDetail?$bankDetail->bank_name:'' }}
                                    </td>
                                    <td>
                                    {{ $bankDetail?$bankDetail->branch_name:'' }}
                                    </td>
                                    <td>
                                    {{ $bankDetail?$bankDetail->account_number :'' }}
                                    </td>
                                    <td>
                                    {{ $bankDetail?$bankDetail->ifscCode:'' }}
                                    </td>
                                    <td>
                                       {{$item->source}}
                                    </td>
                                    <td>
                                      {{ $customerAuth?$customerAuth->username:'' }}
                                    </td>
                                    <td>
                                      {{ $customerAuth?$customerAuth->password:'' }}
                                    </td>
                                    <td>
                                    {{ $approveLoan && $approveLoan->loan_duration ?$approveLoan->loan_duration.' Months' :'' }} 

                                    </td>

                                    <td>
                                    {{ $approveLoan && $approveLoan->approve_loan_amount !=null?'₹'.$approveLoan->approve_loan_amount:'' }} 

                                    </td>

                                    <td>
                                    {{ $approveLoan && $approveLoan->interest !=null?$approveLoan->interest.'%':'' }} 

                                    </td>
                                    <td>
                                    {{ $approveLoan && $approveLoan->emi_amount !=null?'₹'.$approveLoan->emi_amount:'' }} 

                                    </td>

                                     <td>
                                    {{ $approveLoan && $approveLoan->processing_fees !=null ?'₹'.$approveLoan->processing_fees:'' }} 

                                    </td>

                                    <td>{{$loanReq1->father_name}}</td>
                                    <td>{{$loanReq1->mother_name}}</td>
                                    <td>{{$loanReq1->alternate_mobile}}</td>
                                    <td>{{$loanReq1->profession}}</td>
                                    <td>{{$loanReq1->reason}}</td>
                                    <td>{{$loanReq1->employer_company_name}}</td>
                                    <td>{{$loanReq1->salary}}</td>
                                    <td>{{$loanReq1->spause}}</td>
                                    <td>{{$loanReq1->present_address}}</td>
                                    <td>{{$loanReq1->pincode}}</td>
                                    <td>{{$loanReq1->permanent_address}}</td>
                                    <td>{{$loanReq1->witness_1}}</td>
                                    <td>{{$loanReq1->witness_2}}</td>
                                    <td>{{$loanReq1->qualification}}</td>
                                    <td>{{$loanReq1->cheque_no_received}}</td>
                                    <td>{{$loanReq1->no_of_years_in_present_Job}}</td>
                                    <td>{{$loanReq1->no_of_employee_in_company}}</td>
                                    <td>{{$loanReq1->family_income}}</td>
                                    <td>{{$loanReq1->other_loan_details}}</td>
                                    <td>{{$loanReq1->rent_paid}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="updateDeatil(`{{$loanReq1->name}}`,`{{$item->id}}`,`{{$loanReq1->father_name}}`,`{{$loanReq1->mother_name}}`,`{{$loanReq1->alternate_mobile}}`,`{{$loanReq1->profession}}`,`{{$loanReq1->reason}}`,`{{$loanReq1->employer_company_name}}`,`{{$loanReq1->salary}}`,`{{$loanReq1->spause}}`,`{{$loanReq1->present_address}}`,`{{$loanReq1->pincode}}`,`{{$loanReq1->permanent_address}}`,`{{$loanReq1->witness_1}}`,`{{$loanReq1->witness_2}}`,`{{$loanReq1->qualification}}`,`{{$loanReq1->cheque_no_received}}`,`{{$loanReq1->no_of_years_in_present_Job}}`,`{{$loanReq1->no_of_employee_in_company}}`,`{{$loanReq1->family_income}}`,`{{$loanReq1->other_loan_details}}`,`{{$loanReq1->rent_paid}}`)" data-toggle="modal" data-target="#myModal"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <strong class="greentext"> {{$item->user_status}}</strong>           
                                    </td>
                                 
                                </tr>
                                @endforeach
                                @endif
                                
                               
                            </tbody>
                        </table>
                       
                    </div>
                    



                                      </div>
                                      <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                      {!! $loanReq->links() !!}
                                                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link " href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li> -->
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
    <!-- Modal -->
  
  <div class="modal fade" id="myModal" role="dialog">
    <form action="{{url('/admin/bank-details-update')}}" method="post">
    <div class="modal-dialog">
    
    <input type="hidden" name="id" id="request_id" value="">
    @csrf
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5>Bank Other Details</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
                <label>Name</label>
                <input type="text" class="form-control" id="loan_name" disabled readonly>
            </div>
          <div class="col-sm-12">
              <label>Father Name</label>
              <input type="text" name="father_name" id="father_name" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Mother Name</label>
              <input type="text" name="mother_name" id="mother_name" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Alternate Mobile</label>
              <input type="number" name="alternate_mobile" id="alternate_mobile" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Profession</label>
              <input type="text" name="profession" id="profession" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Reason</label>
              <input type="text" name="reason" id="reason" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Employer Company Name</label>
              <input type="text" name="employer_company_name" id="employer_company_name" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Salary</label>
              <input type="text" name="salary" id="salary" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Spause</label>
              <input type="text" name="spause" id="spause" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Present Address</label>
              <input type="text" name="present_address" id="present_address" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Pin Code</label>
              <input type="number" name="pincode" id="pincode" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Permanent Address</label>
              <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Witness 1</label>
              <input type="text" name="witness_1" id="witness_1" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Witness 2</label>
              <input type="text" name="witness_2" id="witness_2" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Qualification</label>
              <input type="text" name="qualification" id="qualification" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Cheque No Received</label>
              <input type="text" name="cheque_no_received" id="cheque_no_received" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>No Of Month In Present Job</label>
              <input type="text" name="no_of_years_in_present_Job" id="no_of_years_in_present_Job" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>No Of Employee In Company</label>
              <input type="text" name="no_of_employee_in_company" id="no_of_employee_in_company" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Family Income</label>
              <input type="number" name="family_income" id="family_income" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Other Loan Details</label>
              <input type="text" name="other_loan_details" id="other_loan_details" class="form-control" value="">
          </div>
          <div class="col-sm-12">
              <label>Rent Paid</label>
              <input type="number" name="rent_paid" id="rent_paid" class="form-control" value="">
          </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="Submit">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
    </form>
  </div>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   
    <script>
        $('#mySelect').on('change', function() {
            var val =$('#mySelect').val();
            console.log(val);
            if(val == "Approve"){
                $('#statusdiv').addClass('show');
            }else{
                $('#statusdiv').removeClass('show');
            }
            });

           function showModel(id){
            var val =$(`#mySelect${id}`).val();
            console.log(val);
            if(val == "Approve"){
                $(`.${id}`).addClass('show');
                $(`.reject${id}`).removeClass('show');

            }else{
                $(`.reject${id}`).addClass('show');
                $(`.${id}`).removeClass('show');
            }
            }
    </script>

    <script>
        $(document).ready(function(){
            $('#filterByStatus').on('change',function(){
                console.log( $('#filterByStatus').val());
                var status = $('#filterByStatus').val();
                var op = "";
                $.ajax({
        type:'get',
        url: '{!!URL::to('filter-data')!!}',
        data:{'status':status},
        success:function(data){
            for(var i =0; i<data.length;i++){
            op+=` <tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].name}</td>
                                    <td>${data[i].mobile}</td>
                                    <td>₹${data[i].loan_amount}</td>
                                    <td>₹${data[i].existing_loan}</td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/bank_statement/')}}/${data[i].bank_statement}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/adhar_card/' )}}/${data[i].adhar_card}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/photo/' )}}/${data[i].photo}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/pan_card/')}}/${data[i].pan_card}">View</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn  loginbtn" style="background: {{$item->loan_status && $item->loan_status=='Approved'?'#5cb85c':''}} {{$item->loan_status && $item->loan_status=='Reject'?'#d9534f':''}}; color:#fff;" data-toggle="modal" data-target="#{{$item->loan_status =='Pending' ?'exampleModal':0}}{{$item->id}}" onclick="" >{{$item->loan_status?$item->loan_status:''}}</i></a>

                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal.${data[i].Loanid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Loan Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                          <label for="inputName">Select Status</label>
                                                          <select class="form-control" id="mySelect${data[i].loan_request_number}" onchange="showModel('${data[i].loan_request_number}')">
                                                              <option>select</option>
                                                              <option value='Approve'>Approve</option>
                                                              <option value='Reject'>Reject</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="${data[i].loan_request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data[i].loan_request_number}" name="loan_request_number" >
                                                        <input type="hidden" value="Approved" name="status" >

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Loan Duration (Month) </label>
                                                              <input type="number" class="form-control" name="loan_duration" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Loan Amount </label>
                                                                  <input type="number" class="form-control" name="loan_amount" 
                                                                  data-parsley-error-message="Enter loan amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Rate of Interest</label>
                                                                  <input type="number" class="form-control" name="rate_of_intrest" 
                                                              data-parsley-error-message="Enter rate of intrest." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">EMI Amount </label>
                                                              <input type="number" class="form-control" name="emi_amount" 
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                  <label for="inputName">Processing Fees </label>
                                                                  <input type="number" class="form-control" name="processing_fees" 
                                                              data-parsley-error-message="Enter processing fees." required >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Submit" class="btn btn-success float-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>

                                                <div id="statusdiv" class="reject${data.loan_request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data.loan_request_number}" name="loan_request_number" >
                                                        <input type="hidden" value="Reject" name="status" >

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                              <label for="inputName">Reject Reason </label>
                                                              <input type="text" class="form-control" name="reject_reason" 
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="submit" value="Submit" class="btn btn-success float-right">
                                                            </div>
                                                        </div>
                                                             </div>
                                                    </form>
                                                </div>
                                              </div>                  
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                    <td>
                                    ${data[i].reject_reason}
                                    </td>
                                    <td>
                                    ${data[i].bank_name}
                                    </td>
                                    <td>
                                    ${data[i].branch_name} 
                                    </td>
                                    <td>
                                    ${data[i].account_number} 
                                    </td>
                                    <td>
                                    ${data[i].ifscCode} 
                                    </td>
                                    <td>
                                    ${data[i].source}
                                    </td>
                                    <td>
                                    ${data[i].username} 
                                    </td>
                                    <td>
                                    ${data[i].password}
                                    </td>
                                    <td>
                                    ${data[i].loan_duration}  

                                    </td>

                                    <td>
                                    ${data[i].loan_amount}

                                    </td>

                                    <td>
                                    ${data[i].interest} 

                                    </td>
                                    <td>
                                    ${data[i].emi_amount}

                                    </td>

                                     <td>
                                     ${data[i].processing_fees} 

                                    </td>

                                    
                                    <td>
                                        <strong class="greentext"> ${data[i].user_status}</strong>           
                                    </td>
                                  
                                </tr>
                                        `;
          }
          // console.log('sucess');
          console.log(op);
          $('#addfilter').html(' ');
          $('#addfilter').html(op);
        

        },
        error:function(){

        }
      })
            });
        });
        </script>
        <script>
            function updateDeatil(name,id,father_name,mother_name,alternate_mobile,profession,reason,employer_company_name,salary,spause,present_address,pincode,permanent_address,witness_1,witness_2,qualification,cheque_no_received,no_of_years_in_present_Job,no_of_employee_in_company,family_income,other_loan_details,rent_paid){
                $('#loan_name').val(name);
                $('#request_id').val(id);
                $('#father_name').val(father_name);
                $('#mother_name').val(mother_name);
                $('#alternate_mobile').val(alternate_mobile);
                $('#profession').val(profession);
                $('#reason').val(reason);
                $('#employer_company_name').val(employer_company_name);
                $('#salary').val(salary);
                $('#spause').val(spause);
                $('#present_address').val(present_address);
                $('#pincode').val(pincode);
                $('#permanent_address').val(permanent_address);
                $('#witness_1').val(witness_1);
                $('#witness_2').val(witness_2);
                $('#qualification').val(qualification);
                $('#cheque_no_received').val(cheque_no_received);
                $('#no_of_years_in_present_Job').val(no_of_years_in_present_Job);
                $('#no_of_employee_in_company').val(no_of_employee_in_company);
                $('#family_income').val(family_income);
                $('#other_loan_details').val(other_loan_details);
                $('#rent_paid').val(rent_paid);
                   
            }
        </script>
  @endsection