@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
   use App\Models\LoanRequest; 
    
?>


<style>
    /* .fixTableHead {
      overflow-y: auto;
      height: 400px;
    }
    .stikey_class{
        position: sticky;
      top: 0;
    }
    .fixTableHead thead th {
      position: sticky;
      top: 0;
      background: #ABDD93;
      border:1px solid #000;
    }
    table {
      border-collapse: collapse;        
      width: 100%;
    }
    th,
    td {
      padding: 8px 15px;
      border: 2px solid #529432;
    } */
  </style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Loan Request</h2>
            <div class="row">
                                        <div class="col-sm-3">
                                                    <div class="form-group">
                                                          <label for="inputName">Filter by admin status </label>
                                                         <select class="form-control" id="filterByStatus">
                                                    <option value="">-select Status-</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Paid" >Paid</option>
                                                    <option value="Pending" >Pending</option>
                                                    <option value="Rejected" >Rejected</option>
                                                     </select>
                                                </div>
                                         </div>

                                        <?php
                                        $today_date =date('Y-m-d');
                                        
                                        ?>
                                         <div class="col-sm-3">
                                         <div class="form-group">
                                                          <label for="inputName"> Start date </label>
                                                        <input type="date" class="form-control" name="start_date" id="start_date" />
                                                </div>
                                         </div>

                                         <div class="col-sm-3">
                                         <div class="form-group">
                                                          <label for="inputName">End date </label>
                                                        <input type="date" class="form-control" name="end_date" id="end_date" min="{{$today_date}}" />
                                                </div>
                                         </div>

                                         <div class="col-sm-3">
                                         <div class="form-group">
                                                          <label for="inputName"> </label>
                                                          <a href="#" class="btn  loginbtn form-control" id="filterByDate">search</a>
                                                        <!-- <input type="submit" class="form-control" value="Search" name="start_date" /> -->
                                                </div>
                                         </div>

                                         </div>
            <div class="row ">
                     <div class="col-md-12">
                              <div class="card card-primary stikey_class">
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
                        <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2%">Sr.no</th>  
                                    <th>Request Date</th>

                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Tenure</th>
                                    <th>Existing Loan</th>
                                    <th>Bank Statement</th>                 
                                    <th>Aadhar Card</th>                 
                                    <th>Passport Size Photo</th>                 
                                    <th>Pancard</th>
                                    <th width="5%">Admin Status</th>
                                    <th>Reject Reason</th>
                                    <th>Approved Date</th>
                                    <th>Loan Trasnfer Date</th>
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
                                     <th width="5%">User Status</th>
                                   

                                </tr>
                            </thead>
                            <tbody id ="addfilter">
                                @if(count($loanReq)>0)
                                @foreach ($loanReq as $key =>$item)
                                    <?php
                                 
                                     $bankDetail = BankDetail::where('loan_request_number',$item->loan_request_number)->first();
                                     $customerAuth = CustomerAuth::where('loan_request_number',$item->loan_request_number)->first();
                                     $approveLoan = ApproveLoan::where('loan_request_number',$item->loan_request_number)->first();
                                     
                                   
                                    ?>
                               
                                <tr>
                                    <td>{{ $loanReq->firstItem() + $key}}</td>
                                    <td>
                                        {{ $item?date('d-M-Y',strtotime($item->request_date)):'' }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>₹{{ $item->loan_amount }}</td>
                                    <td>₹{{$item->existing_loan?$item->existing_loan:0}}</td>
                                    <td>
                                        @php
                                            $bankS = json_decode(stripslashes($item->bank_statement));
                                            // dd($bankS);
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
                                            @if($item->photo)
                                        <a target="_blank" href="../../view-file?id={{asset('upload/photo/'.$item->photo)}}">View</a>
                                        @endif
                                    </td>
                                    <td>
                                         @if($item->pan_card)
                                        <a target="_blank" href="../../view-file?id={{asset('upload/pan_card/'.$item->pan_card)}}">View</a>
                                         @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn  loginbtn" style="background: {{$item->loan_status && $item->loan_status=='Approved'?'#5cb85c':''}} {{$item->loan_status && $item->loan_status=='Reject'?'#d9534f':''}}; color:#fff;" data-toggle="modal" data-target="#{{$item->loan_status =='Pending' ?'exampleModal':0}}{{$item->id}}"  >{{$item->loan_status?$item->loan_status:''}}</i></a>

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
                                                                  <label for="inputName">Total interest charge during the entire tenure of the loan </label>
                                                                  <input type="number" class="form-control" name="total_interest_charge" 
                                                              data-parsley-error-message="Enter total interest charge." required >
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Other charge </label>
                                                                  <input type="number" class="form-control" name="other_charge"  value="0"
                                                               required >
                                                            </div>
                                                        </div>



                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Other charge reason </label>
                                                                  <input type="text" class="form-control" name="other_charge_reason"  >
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
                                        {{ $approveLoan?$approveLoan->reject_reason:'' }}
                                    </td>
                                    
                                    
                                    
                                    <td>
                                        {{ $approveLoan?$approveLoan->approved_date:'' }}
                                    </td>
                                    
                                    <td>
                                        {{ $approveLoan?$approveLoan->loan_trasnfer_date:'' }}
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

            }else if(val == "Reject"){
                $(`.reject${id}`).addClass('show');
                $(`.${id}`).removeClass('show');
            }else{
                $(`.reject${id}`).removeClass('show');
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
                 $loanReq_number = data[i].loan__request_number;
                // console.log( data[i].bank_statement);
                // console.log(data[i].bank_statement.replace(/\\/g, ""));
                $adhar_card1 ="";
                if(data[i].adhar_card !=null){
                $adhar_card = data[i].adhar_card.replace(/\\/g, "");
                $adhar_card = $adhar_card.replace('[', "");
                $adhar_card = $adhar_card.replace(']', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar = $adhar_card.split(",");
                
                console.log($adhar_card);
                
                for(var k=0;k<$adhar.length;k++){
                    $adhar_card1 +=`<a target="_blank" href="../../view-file?id=${$adhar_card.split(",")[k]}">View</a>||`;
                    // console.log($adhar_card[k]);

                 }
                }
                $statementTag='';

                if(data[i].bank_statement !=null){
                $input = data[i].bank_statement.replace(/\\/g, "");
                $input = $input.replace('[', "");
                $input2 = $input.replace(']', "");
                $input2 = $input.replace('"', "");
                 $statement = $input2.split('","');
                 for(var j=0;j<$statement.length;j++){
                    $statementTag +=`<a target="_blank" href="../../view-file?id=${$input2.split('","')[j]}">View</a>||`;

                 }
                }

                

                // $.ajax({
                // type:'get',
                //     url: '{!!URL::to('get-statement')!!}',
                //     data:{id: $loanReq_number},
                //     success:function(image){
                //         console.log(image);
                //     }
                // });


            op+=` <tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].name}</td>
                                    <td>${data[i].mobile}</td>
                                    <td>₹${data[i].loan_amount}</td>
                                    <td>₹${(data[i].existing_loan) ? data[i].existing_loan: 0}</td>
                                    <td>
                                    ${$statementTag?$statementTag:''}
                                    
                                    </td>
                                    <td>
                                    ${$adhar_card1?$adhar_card1:''}
                                       
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/photo/' )}}/${data[i].photo}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/pan_card/')}}/${data[i].pan_card}">View</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn  loginbtn" style="background: ; color:#fff;" data-toggle="modal" data-target="#${(data[i].loan_status=='Pending') ? 'exampleModal': ""}${data[i].Loanid}"  >${data[i].loan_status}</i></a>

                                <!-- Modal -->
                                    <div class="modal-backdrop modal fade" id="exampleModal${data[i].Loanid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          <select class="form-control" id="mySelect${data[i].loan__request_number}" onchange="showModel('${data[i].loan__request_number}')">
                                                              <option>select</option>
                                                              <option value='Approve'>Approve</option>
                                                              <option value='Reject'>Reject</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="${data[i].loan__request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data[i].loan__request_number}" name="loan_request_number" >
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

                                                <div id="statusdiv" class="reject${data.loan__request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data.loan__request_number}" name="loan_request_number" >
                                                        <input type="hidden" value="Rejected" name="status" >

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
                                    ${(data[i].reject_reason) ? data[i].reject_reason: ''}
                                    </td>
                                    <td>
                                    ${(data[i].bank_name) ? data[i].bank_name: ''}
                                    </td>
                                    <td>
                                    ${(data[i].branch_name) ? data[i].branch_name: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].account_number) ? data[i].account_number: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].ifscCode) ? data[i].ifscCode: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].source) ? data[i].source: '' }
                                    </td>
                                    <td>
                                    ${(data[i].username) ? data[i].username: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].password) ? data[i].password: ''}
                                    </td>
                                    <td>
                                    ${(data[i].loan_duration) ? data[i].loan_duration+' Months': '' }  

                                    </td>

                                    <td>
                                    ${(data[i].approve_loan_amount) ? '₹'+data[i].approve_loan_amount: '' }

                                    </td>

                                    <td>
                                    ${(data[i].interest) ? data[i].interest+'%': '' } 

                                    </td>
                                    <td>
                                    ${(data[i].emi_amount) ? '₹'+data[i].emi_amount: ''  }

                                    </td>

                                     <td>
                                     ${(data[i].processing_fees) ? '₹'+data[i].processing_fees: ''  } 

                                    </td>

                                    
                                    <td>
                                        <strong class="greentext"> ${data[i].user_status}</strong>           
                                    </td>
                                  
                                </tr>
                                        `;
          }
          // console.log('sucess');
        //   console.log(op);
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
        $(document).ready(function(){
            $('#filterByDate').on('click',function(){
                // console.log( $('#start_date').val());
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                var op = "";
                $.ajax({
        type:'get',
        url: '{!!URL::to('filter-data-by-date')!!}',
        data:{'start_date':start_date,'end_date':end_date},
        success:function(data){


            for(var i =0; i<data.length;i++){

                console.log(data);
                $adhar_card1 ="";

                if(data[i].adhar_card !=null){
                $adhar_card = data[i].adhar_card.replace(/\\/g, "");
                $adhar_card = $adhar_card.replace('[', "");
                $adhar_card = $adhar_card.replace(']', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar_card = $adhar_card.replace('"', "");
                $adhar = $adhar_card.split(",");
                console.log($adhar_card);
                for(var k=0;k<$adhar.length;k++){
                    $adhar_card1 +=`<a target="_blank" href="../../view-file?id=${$adhar_card.split(",")[k]}">View</a>||`;

                 }
                }

                $statementTag='';
                if(data[i].bank_statement !=null){
                $input = data[i].bank_statement.replace(/\\/g, "");
                $input = $input.replace('[', "");
                $input2 = $input.replace(']', "");
                $input2 = $input.replace('"', "");
                 $statement = $input2.split('","');
               
                 for(var j=0;j<$statement.length;j++){
                    $statementTag +=`<a target="_blank" href="../../view-file?id=${$input2.split('","')[j]}">View</a>||`;

                 }
                }
            op+=` <tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].name}</td>
                                    <td>${data[i].mobile}</td>
                                    <td>₹${data[i].loan_amount}</td>
                                    <td>₹${(data[i].existing_loan) ? data[i].existing_loan: 0}</td>
                                    <td>
                                        ${$statementTag?$statementTag:''}
                                      
                                    </td>
                                    <td>
                                    ${$adhar_card1?$adhar_card1:''}
                                       
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/photo/' )}}/${data[i].photo}">View</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="../../view-file?id={{asset('upload/pan_card/')}}/${data[i].pan_card}">View</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn  loginbtn" style="background: ; color:#fff;" data-toggle="modal" data-target="#${(data[i].loan_status=='Pending') ? 'exampleModal': ""}${data[i].Loanid}" onclick="" >${data[i].loan_status}</i></a>

                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal${data[i].Loanid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          <select class="form-control" id="mySelect${data[i].loan__request_number}" onchange="showModel('${data[i].loan__request_number}')">
                                                              <option>select</option>
                                                              <option value='Approve'>Approve</option>
                                                              <option value='Reject'>Reject</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="${data[i].loan__request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data[i].loan__request_number}" name="loan_request_number" >
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

                                                <div id="statusdiv" class="reject${data.loan__request_number}" >
                                                    <form action="approved" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="${data.loan__request_number}" name="loan_request_number" >
                                                        <input type="hidden" value="Rejected" name="status" >

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
                                    ${(data[i].reject_reason) ? data[i].reject_reason: ''}
                                    </td>
                                    <td>
                                    ${(data[i].bank_name) ? data[i].bank_name: ''}
                                    </td>
                                    <td>
                                    ${(data[i].branch_name) ? data[i].branch_name: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].account_number) ? data[i].account_number: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].ifscCode) ? data[i].ifscCode: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].source) ? data[i].source: '' }
                                    </td>
                                    <td>
                                    ${(data[i].username) ? data[i].username: '' } 
                                    </td>
                                    <td>
                                    ${(data[i].password) ? data[i].password: ''}
                                    </td>
                                    <td>
                                    ${(data[i].loan_duration) ? data[i].loan_duration+' Months': '' }  

                                    </td>

                                    <td>
                                    ${(data[i].approve_loan_amount) ? '₹'+data[i].approve_loan_amount: '' }

                                    </td>

                                    <td>
                                    ${(data[i].interest) ? data[i].interest+'%': '' } 

                                    </td>
                                    <td>
                                    ${(data[i].emi_amount) ? '₹'+data[i].emi_amount: ''  }

                                    </td>

                                     <td>
                                     ${(data[i].processing_fees) ? '₹'+data[i].processing_fees: ''  } 

                                    </td>

                                    
                                    <td>
                                        <strong class="greentext"> ${data[i].user_status}</strong>           
                                    </td>
                                  
                                </tr>
                                        `;
          }
          // console.log('sucess');
        //   console.log(op);
          $('#addfilter').html(' ');
          $('#addfilter').html(op);
        

        },
        error:function(){

        }
      })
            });
        });
        </script>
  @endsection