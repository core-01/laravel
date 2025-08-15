@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
    use Carbon\Carbon;
?>

<style>
  .modal-dialog{
    min-width: 60%;
  }
  
  input[type="date"] {
    position: relative;
}
/* create a new arrow, because we are going to mess up the native one
see "List of symbols" below if you want another, you could also try to add a font-awesome icon.. */
input[type="date"]:after {
    /* font-family: "Font Awesome 5 Free"; */
    /* font-weight: 900; 
    content: "\f073";
    color: #555;
    padding: 0 5px; */
}

  
input[type="date"]::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: auto;
    height: auto;
    color: transparent;
    background: transparent;
}

 
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">EMI Detail</h2>
            <div class="card card-primary">
         <!--  <div class="card-header">
            <h6 class="card-title">Search Results</h6>
           
          </div> -->
          <div class="card-body" id="demo" style="background:#d9e9dc;">
            <form action="{{url('view-and-Pay')}}" mothod="post" id="form" data-parsley-validate>
            @csrf
            @method('post')
            <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="inputName">Mobile</label>
                  <input class="form-control" type="number" name="mobile" required  value="{{old('mobile')}}"
                  data-parsley-error-message="Enter mobile number" data-parsley-length="[10,10]">
                  @if (Session::has('failed'))
                    
                  <span style="color:red;">{{Session::get('failed')}}</span>
                  @endif
                </div>
              </div>
              <!-- <div class="col-sm-3">
                <div class="form-group">
                  <label for="inputName">To Date</label>
                  <input class="form-control" type="date" name="end_date" required 
                  data-parsley-error-message="Select to date">
                </div>
              </div> -->
              
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="inputName">&nbsp;</label>
                  <div class="clear"></div>
                  <input type="submit" value="Search" class="btn btn-success">
                </div>
              </div>
            
              
 
              
            </div>
            </form>
          </div>
        </div>
                                       
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
                                      <div class="table-responsive col-sm-12 fixTableHead">
                                      @if (count($emi)>0)
                        <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2%">Sr.no</th>                  
                                   
                                    <th>Other Charge</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Rate Of Interest</th>
                                    <th>Current EMI Amount</th>
                                    <th>Current Principle Amount</th>
                                    <th>Current EMI Interest</th>
                                    <th>Last EMI Total Pending Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Date</th>
                                    <th>Payment Received Date</th>
                                    <th>Late Interest</th>
                                    <th>Late Fees</th>
                                    <!-- <th>Due Amount</th> -->
                                    <th>Payble Amount</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody >
                              
                               
                                @foreach ($emi as $key=>$item)
                                    <?php
                                     $todaydate = Date('Y-m-d');
                                     $new_date =(((new Carbon($todaydate))->addMonths(1)));
                                     $add_day =(((new Carbon($todaydate))->addDays(30)));
                                     $nextmont = date('Y-m-d', strtotime($new_date->toDateString()));

                               ?>


                              <?php
                            //   dd($item);
                        $late_fees=0;
                        $secondEmi=0;
                        $secondEmi_intrest=0;
                        $decreement_emi =1;
                        $due_date=date('d-m-Y',strtotime($item->emi_due_date));
                        $due_date1=date('d-m-Y',strtotime($item->emi_due_date));
                        $intrest =  0;

                                    $to =Carbon::parse($item->emi_due_date);

                        if($to->toDateString() < date('Y-m-d')){

                                    $from =Carbon::parse(date('Y-m-d'));
                                    $days = $to->diffInDays($from); 

                                    if($item->payment_status == "Pending"){ 
                                      if(($item->due_amount/100*2) <=300){
                                          $late_fees = 300;
                                      }else{  
                                          $late_fees = intval(($item->due_amount/100*2)); 
                                      }  
                                  }

                                  $oneDayIntrest=  (intval($item->due_amount)/100 * intval($item->rate_of_intrest))/30;
                                  $intrest=$oneDayIntrest*$days;
                                    
                                }
                                
                                $other_charge = $item->payment_status != "Paid"?$item->due_other_charge:0;
                                $pay_emi = $item->due_amount -($item->intrest - $item->paid_intrest) - $item->due_late_fees;
                                $intrest = $item->intrest;
                                $late_fees= $item->late_fees;
                                $payble_amount= $item->due_amount + $other_charge;
                                $loanApproved = DB::table('approve_loans')->where('loan_request_number',$item->loan_request_number)->first();
                                if($loanApproved){
                                     $principleAmountInterest = (($loanApproved->approve_loan_amount/100)/$loanApproved->loan_duration)*$item->rate_of_intrest;
                                }else{
                                     $principleAmountInterest =0;
                                }
                               
                                // $principleAmountInterest = round(($item->emi_amount/100)*$item->rate_of_intrest);
                                $principleAmount = round($item->emi_amount - $principleAmountInterest);
                        ?>

                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>
                                      @if($item->other_charge_reason)
                                      <b>Reason: </b>{{ $item->other_charge_reason }} <br> 
                                      <b>Total Amount: </b>₹{{ $item->other_charge_amount }} <br>      
                                      <b>Paid Amount: </b>₹{{ $item->other_charge_amount -$item->due_other_charge }} <br>      
                                      @elseif($key+1==count($emi))
                                      @if($item->payment_status == 'Pending')
                                      <div class="addOtherCharge{{$loop->index+100}}" style="display:none;">
                                    <form action="{{url('addChargeInEmi')}}" data-parsley-validate method="post">
                                      @csrf
                                  <input type="text" class="form-control" name ="fees_reson" required data-parsley-error-message="Enter reason." placeholder="Enter Reason.">
                                  <input type="text" class="form-control" name ="fees_amount" required data-parsley-error-message="Enter amount." placeholder="Enter amount.">
                                  <input type="hidden" class="form-control" name ="emi_id" value="{{$item->id}}">
                                  <br>
                                  <!-- <button>Submit</button> -->
                                  <input type="submit" value="Submit" class="btn btn-success float-right">
                                </form>
                                
                                <button  onclick="backFun('addOtherCharge{{$loop->index+100}}','addOtherChargeBtn{{$loop->index+200}}')" class="btn btn-success">Back</button>
                              </div>
                              <button  onclick="addOtherChargeFun('addOtherCharge{{$loop->index+100}}','addOtherChargeBtn{{$loop->index+200}}')" class="addOtherChargeBtn{{$loop->index+200}} btn btn-success">Add charge</button>
                                  @endif
                                  @endif
                                    </td>
                                    <td>
                                      <?php
                                      $user =DB::table('customer_auths')->where('username',$item->username)->first();
                                      
                                      ?>
                                      @if($user)
                                      {{ $user->costomer_name }}
                                      @endif
                                    </td>

                                   

                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->rate_of_intrest }}%</td>
                                    <td>₹{{ $item->emi_amount }}</td>
                                    <td>₹{{ $principleAmount }}</td>
                                    <td>₹{{ $principleAmountInterest }}</td>
                                    <td>₹
                                    @if($item->last_emi_amount !="" && $item->last_emi_amount !=0)
                                    {{ $item->last_emi_amount- ($item->late_fees +$item->intrest) }}
                                    @else
                                    0
                                    @endif
                                    </td>
                                    <td>₹{{  ($item->paid_amount) }}</td>
                                    <td>{{ date('d/M/Y',strtotime($item->emi_due_date)) }}</td>
                                    <td>
                                      <?php
                                      $history =DB::table('emi_details')->whereRaw('FIND_IN_SET("'.$item->id.'",emi_id)')->latest()->first();
                                      if(!$history){
                                      $history =DB::table('emi_details')->whereRaw('FIND_IN_SET("'.$item->emi_id.'",emi_id)')->latest()->first();
                                            
                                            // dd($item->id,$item->emi_id);
                                      }
                                      ?>
                                      @if($history)
                                      {{ date('d/M/Y',strtotime($history->transaction_date)) }}
                                      @endif
                                    </td>
                                    <td>
                                      <b>Total: </b>₹{{ round($item->intrest)  }} <br> 
                                      <b>Paid: </b>₹{{ round($item->paid_intrest) }} <br>  
                                    </td>
                                    <td>
                                      <b>Total: </b>₹{{ round($item->late_fees)  }} <br> 
                                      <b>Paid: </b>₹{{ round($item->late_fees -$item->due_late_fees) }} <br>  
                                     </td>
                                    <!-- <td>₹{{ $item->due_amount }}</td> -->
                                    <td>₹{{ $payble_amount }}</td>
                                    <!-- <td>0</td> -->
                                    <!-- <td>{{ date('d-m-Y',strtotime($item->next_emi_date)) }}</td> -->
                                    <td>
                                    @if ($item->payment_status == 'Paid') 
                                    <a class="btn  loginbtn" style="background:{{$item->payment_status == 'Pending'?'yellow':'#5cb85c'}};"data-toggle="modal" data-target="#exampleModal{{$item->payment_status == 'Pending'?$item->id:'oiuo' }}" >{{$item->payment_status }}</a> 
                                    @endif

                                      @if ($key+1==count($emi) && $item->payment_status == 'Pending') 
                                      <a class="btn  loginbtn" style="background:{{$item->payment_status == 'Pending'?'yellow':'#5cb85c'}};"data-toggle="modal" data-target="#exampleModal{{$item->payment_status == 'Pending'?$item->id:'oiuo' }}" >{{$item->payment_status }}</a>
                                      @endif
                                  </td>
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
                                                          <select class="form-control" id="mySelect{{$item->id}}" onchange="showModel('{{$item->id}}')">
                                                              <option >select</option>
                                                              
                                                              <option value='Approve'>Pay now</option>
                                                              <!-- <option value='Approve'>Pay now</option> -->
                                                              <!-- <option value='Reject'>Reject</option> -->
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="statusdiv" class="{{$item->id}}" >
                                                    <form action="{{ url('adminpaidEmi1') }}" method="post">
                                                        @csrf
                                                     <div class="row">
                                                     <input type="hidden" value="{{$item->loan_request_number}}" name="loan_request_number" >
                                                        <input type="hidden" value="{{ $item->username }}" name="username" >
                                                        <input type="hidden" value="{{ $payble_amount }}" name="total_payble_amount" id="total_payble_amount{{$item->id}}" >
                                                        <input type="hidden" value="{{ $decreement_emi }}" name="decreement_emi" id="decreement_emi{{$item->id}}">
                                                        <input type="hidden" value="{{ $item->id }}" name="emi_id" >
                                                       

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                              <label for="principleAmount{{$item->id}}">Current Principle Amount </label>
                                                              <input type="text" class="form-control" name="current_Principle_amount" value="{{round($principleAmount)}}" id="principleAmount{{$item->id}}" disabled
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"  data-parsley-error-message="required." required onkeyup="changeAmount('{{$item->id}}','emiAmount{{$item->id}}','{{$pay_emi}}')">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                              <label for="emiInterestAmount{{$item->id}}">Current EMI interest </label>
                                                              <input type="text" class="form-control" name="current_emi_intrest" value="{{round($principleAmountInterest)}}" id="emiInterestAmount{{$item->id}}" disabled
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"  data-parsley-error-message="required." required onkeyup="changeAmount('{{$item->id}}','emiAmount{{$item->id}}','{{$pay_emi}}')">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                              <label for="emiAmount{{$item->id}}">Total Due Amount </label>
                                                              <input type="text" class="form-control" name="emi_amount" value="{{$pay_emi}}" id="emiAmount{{$item->id}}"
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"  data-parsley-error-message="required." required onkeyup="changeAmount('{{$item->id}}','emiAmount{{$item->id}}','{{$pay_emi}}')">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="emiIntrest{{$item->id}}">Late Interest </label>
                                                              <input type="text" class="form-control" name="Intrest"  value="{{$item->intrest-$item->paid_intrest}}" id="emiIntrest{{$item->id}}"
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"  data-parsley-error-message="Enter emi amount." required onkeyup="changeAmount('{{$item->id}}','emiIntrest{{$item->id}}','{{$item->intrest-$item->paid_intrest}}')" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="emilateFees{{$item->id}}">Late fees </label>
                                                              <input type="text" class="form-control" name="late_fees"  value="{{ $item->due_late_fees}}" id="emilateFees{{$item->id}}"
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" data-parsley-error-message="Enter emi amount." required onkeyup="changeAmount('{{$item->id}}','emilateFees{{$item->id}}','{{ $item->due_late_fees}}')" >
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="other_charge_amount{{$item->id}}">Other Charge </label>
                                                              <input type="text" value="{{$item->due_other_charge}}" class="form-control" name="other_charge" 
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"  id="other_charge_amount{{$item->id}}"   onkeyup="changeAmount('{{$item->id}}','other_charge_amount{{$item->id}}','{{$item->due_other_charge}}')"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                              <label for="payble_amount{{$item->id}}">Payble Amount </label>
                                                              <input type="text" class="form-control" name="payble_amount" value="{{$payble_amount}}" 
                                                              onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))" data-parsley-error-message="Enter emi amount." required id="payble_amount{{$item->id}}"
                                                               onkeyup="checkAmount('{{$item->id}}')" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="transaction_id">Transaction id </label>
                                                                  <input type="text" class="form-control" name="transaction_id" id="transaction_id" required 
                                                                  data-parsley-error-message="Enter loan amount." >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="transaction_date">Transaction date</label>
                                                                  <input type="Date" class="form-control" name="transaction_date" id="transaction_date"  required value="{{date('Y-m-d')}}"
                                                              data-parsley-error-message="Enter rate of intrest." >
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                  <label for="current_emi_date1{{$item->id}}">Due date </label>
                                                                    <input type="hidden" value="{{$due_date}}" name="current_emi_date" id ="current_emi_date1{{$item->id}}" />
                                                                  <input type="text" class="form-control" name="current_emi_dateE" disabled  
                                                                  value="{{date('d-m-Y', strtotime( $due_date))}}"
                                                              data-parsley-error-message="Enter processing fees." required  id ="current_emi_date2{{$item->id}}">
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
                                 
                              @else
                                    <?php
                                    $payble_amount ="";
                                    $due_date1  ="";
                                    ?>
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

    <script>
function checkAmount(loan_request_number){
    console.log(loan_request_number);
    $payble_amount = $(`#total_payble_amount${loan_request_number}`).val();
    $pay_amount = $(`#payble_amount${loan_request_number}`).val();
    $due_date1 = '{{ $due_date1}}';
    $next_due_date = '{{date('d-m-Y', strtotime(((( new Carbon($due_date1))->addMonths(1))) ))}}';
// console.log($due_date1, $next_due_date);
    if(parseFloat($payble_amount) > parseFloat($pay_amount)){
        $(`#decreement_emi${loan_request_number}`).val('0');
        $(`#current_emi_date1${loan_request_number}`).val($due_date1);
        $(`#current_emi_date2${loan_request_number}`).val($due_date1);
    }else{
        $(`#decreement_emi${loan_request_number}`).val('1');
        $(`#current_emi_date1${loan_request_number}`).val($next_due_date);
        $(`#current_emi_date2${loan_request_number}`).val($next_due_date);
    }
    console.log(parseFloat($payble_amount)> parseFloat($pay_amount));
    console.log(parseFloat($payble_amount), parseFloat($pay_amount));
   
}



</script>
<script>
function changeAmount(index_value, input_id ,max_value){
  var inputValue = $(`#${input_id}`).val();
  if(parseInt(inputValue) > parseInt(max_value)){
    $(`#${input_id}`).val(max_value);
  }

  $('#payble_amount').val();
  $emi_amount = $(`#emiAmount${index_value}`).val();
  $emi_intrest = $(`#emiIntrest${index_value}`).val();
  $emi_let_fees = $(`#emilateFees${index_value}`).val();
  $other_charge = $(`#other_charge_amount${index_value}`).val();
  
  $total = parseInt($emi_amount)+parseInt($emi_intrest)+parseInt($emi_let_fees) + parseInt($other_charge);
  $(`#payble_amount${index_value}`).val($total);
  $(`#total_payble_amount${index_value}`).val($total);
  console.log( parseInt($emi_amount)+parseInt($emi_intrest)+parseInt($emi_let_fees));
  
}

</script>
<script type="text/javascript" src="https://parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#payEmi").parsley();
    });
    </script>

    <script>

function addOtherChargeFun(classsName,addBtn){
  console.log(classsName);
  $(`.${classsName}`).show();
  $(`.${addBtn}`).hide();
}


function backFun(addclasssName,addBtn){
  $(`.${addclasssName}`).hide();
  $(`.${addBtn}`).show();


}
      </script>

  @endsection