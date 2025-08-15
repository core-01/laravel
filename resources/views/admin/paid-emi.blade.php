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
            <h2 class="mt-5 mb-4">Paid EMI </h2>
          
                                       
            <div class="row">
                     <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">Paid EMI List</h6>
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
                                    <th>Last Pay Date</th>
                                    <th>Last Pay Amount</th>
                                    <th>Next Emi Date</th>
                                    <th>Source</th>
                                    <th>EMI Amount</th>
                                    <th>Total Receved Late Fees</th>
                                    <!-- <th>Due date</th> -->
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody >
                              @if (count($paidEmidata)>0)
                               
                                @foreach ($paidEmidata as $key=>$item)
                                    <?php
                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                                     $emidata = ApproveLoan::where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('loan_requests.loan_request_number',$item->loan_request_number)->first();

                                     $last_pay = DB::table('emi_details')->where(['loan_request_number'=>$item->loan_request_number, 'status'=>'Success'])->latest()->first();
                                     $emi_due = DB::table('total_emis')->where(['loan_request_number'=>$item->loan_request_number, 'payment_status'=>'Pending'])->first();
                                      if(!$emi_due){
                                        $emi_due = DB::table('total_emis')->where(['loan_request_number'=>$item->loan_request_number, 'payment_status'=>'Upcoming'])->first();

                                      }
                                 ?>


                            

                                <tr>
                                    <td>{{$paidEmidata->firstItem()+$key}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{$last_pay?date('d-M-Y', strtotime($last_pay->transaction_date)):''}}</td>
                                    <td>{{ $last_pay?$last_pay->pay_amount:'' }}</td> 
                                    <td>{{$emi_due?date('d-M-Y', strtotime($emi_due->emi_due_date)):''}}</td>

                                    <td>{{ $item->source }}</td>
                                    <td>{{ $item->emi_amount }}</td>
                                    <td>{{ $item->total_receve_late_charge }}</td> 
                                    <td><a class="btn  loginbtn" style="background:{{$item->payment_status == 'Pending'?'yellow':'#5cb85c'}};"data-toggle="modal" data-target="#exampleModal{{$item->payment_status == 'Pending'?$item->id:'oiuo' }}" >{{$emidata->payment_status }}</a></td>
                                </tr> 

                                @endforeach
                                 
                              @endif
                            </tbody>
                        </table>
                    </div>
                    



                                      </div>
                                      <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                     {{ $paidEmidata->links() }}
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