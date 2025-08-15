@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
    use Carbon\Carbon;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">EMI Detail</h2>
          
                                       
            <div class="row">
                     <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">EMI Detail</h6>
                                  <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                      <i class="fas fa-minus"></i></button>
                                  </div> -->
                                </div>
                                <div class="card-body" id="demo">
                                  <div class="row">
                                      <div class="table-responsive col-sm-12">
                        <table class="loantable table table-bordered table-striped fixTableHead" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2%">Sr.no</th>                  
                                   
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Source</th>
                                    <th>EMI Amount</th>
                                    <th>Late Fees</th>
                                    <th>Due date</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody >

                              @if ($emidata)
                                @foreach ($emidata as $item)
                                    <?php
                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                                     $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('loan_requests.loan_request_number',$item->loan_request_number)->first();
                                     $status = ($emidata->next_emi_date >= $todaydate && $emidata->next_emi_date <= $add_day->toDateString());
                                      // dd($status);
                                    if($status){
                                      $pay_status = ApproveLoan::where('loan_request_number',$emidata->loan_request_number)->first();
                                     $pay_status->payment_status ="Pending";
                                     $res = $pay_status->save();
                                     if($res){

                                      //  echo ($emidata->approve_loan_amount);
                                     }
                                    //  echo ($emidata->loan_request_number);

                                
                                    }
                                    //  dd($item->next_emi_date <="2023-10-10" && $item->next_emi_date >="2023-01-10");
                                ?>


                              <?php
                        $late_fees=0;
                        $secondEmi=0;
                        $secondEmi_intrest=0;
                        $decreement_emi =1;
                        $due_date=date('d-m-Y',strtotime($emidata->next_emi_date));
                        $intrest =  $emidata->emi_amount/100*$emidata->interest;

                                    $to =Carbon::parse($emidata->next_emi_date);

                        if($to->toDateString() < date('Y-m-d')){

                          $due_date = (((new Carbon($emidata->next_emi_date))->addMonths(1)));
                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from);
                                   
                                    if(($emidata->emi_amount/100*2)*$days <=300){
                                        $late_fees = 300;
                                    }else{

                                        $late_fees = intval(($emidata->emi_amount/100*2)*$days);
                                       
                                    }
                                    if($loanDetail->due_emi > 1){
                                      $decreement_emi =2;
                                    $secondEmi = $emidata->emi_amount;
                                    $secondEmi_intrest = $emidata->emi_amount/100*$emidata->interest;
                                    }
                                    // dd($days);
                                }
                                $intrest=  $intrest +$secondEmi_intrest;
                                $pay_emi = $emidata->emi_amount + $secondEmi;
                                $payble_amount= $emidata->emi_amount+$late_fees+$intrest+$secondEmi;
                               
                        ?>

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->source }}</td>
                                    <td>{{ $item->emi_amount }}</td>
                                    <td>0</td>
                                    <td>{{ date('d-m-Y',strtotime($item->next_emi_date)) }}</td>
                                    <td><a class="btn  loginbtn" style="background:{{$item->payment_status == 'Pending'?'yellow':'#5cb85c'}};"data-toggle="modal" data-target="#exampleModal{{$item->payment_status == 'Pending'?$item->id:'oiuo' }}" >{{$emidata->payment_status }}</a></td>
                                </tr>
                               
                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">EMI Deatail</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                          <label for="inputName">EMI status</label>
                                                          <select class="form-control" id="mySelect{{$item->loan_request_number}}" onchange="showModel('{{$item->loan_request_number}}')">
                                                              <option>select</option>
                                                              <option value='Approve'>Pay now</option>
                                                              <!-- <option value='Reject'>Reject</option> -->
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="{{$item->loan_request_number}}" >
                                                    <form action="adminpaidEmi" method="post" enctype="multipart/form-data" id="form" data-parsley-validate>
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="{{$item->loan_request_number}}" name="loan_request_number" >
                                                        <input type="hidden" value="{{ $item->mobile }}" name="username" >
                                                        <input type="hidden" value="{{ $decreement_emi }}" name="decreement_emi" >

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">EMI Amount </label>
                                                              <input type="number" class="form-control" name="emi_amount" value="{{$pay_emi}}"
                                                              data-parsley-error-message="required." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Intrest </label>
                                                              <input type="number" class="form-control" name="Intrest"  value="{{$intrest}}"
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Late fees </label>
                                                              <input type="number" class="form-control" name="late_fees"  value="{{$late_fees}}"
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="inputName">Payble Amount </label>
                                                              <input type="number" class="form-control" name="payble_amount" value="{{$payble_amount}}" 
                                                              data-parsley-error-message="Enter emi amount." required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Transaction id </label>
                                                                  <input type="text" class="form-control" name="transaction_id" 
                                                                  data-parsley-error-message="Enter loan amount." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Transaction date</label>
                                                                  <input type="Date" class="form-control" name="transaction_date" 
                                                              data-parsley-error-message="Enter rate of intrest." required>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="inputName">Due date </label>
                                                                  <input type="text" class="form-control" name="current_emi_date" disabled  value="{{date('d-m-Y', strtotime( $due_date))}}"
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

                                                

                                                  
                                              </div>                  
                                            </div>
                                          </div>
                                        </div>
                                @endforeach
                              @endif

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
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $('#mySelect').on('change', function() {
            var val =$('#mySelect').val();
            console.log(val);
            if(val == "Pay now"){
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
                // $(`.reject${id}`).addClass('show');
                $(`.${id}`).removeClass('show');
            }
            }
    </script>


  @endsection