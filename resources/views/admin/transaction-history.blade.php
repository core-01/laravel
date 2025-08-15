@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
    use Carbon\Carbon;
?>

<style>
    input[type=radio]{
        color: red;
    }
    </style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Transaction History</h2>
          
            <h4>Fillter By</h4>
            <div class="card-body" id="demo" style="background:#d9e9dc;">
            <form action="{{url('emi-transaction-history')}}" mothod="post" id="form" data-parsley-validate>
            @csrf
            @method('post')
            <div class="row" id ="search_container">
           
              <div class="col-sm-4">
                
                <div class="form-group">
                  <label for="inputName">
                    
                  <input type="radio" value="Mobile" name="fillter_by" checked id="fillter_mobile"   onclick="fillterFun('fillter_mobile')"  {{ $select_type  == "Mobile"?'checked':'' }}> Mobile number 
                  <input type="radio" value="Date" name="fillter_by" id="fillter_date" onclick="fillterFun('fillter_date')" {{ $select_type =="date"?'checked':'' }}> Date
                  <!-- <input type="radio" value="Transaction Id" name="fillter_by" id="transaction_id"  onclick="fillterFun('transaction_id')" {{ $select_type =="transaction_id"?'checked':'' }}> Transaction Id  -->
                  <input type="radio" value="Name" name="fillter_by" id="name"  onclick="fillterFun('name')" {{ $select_type =="Name"?'checked':'' }}> Name

                </label>


                <?php
                        if($select_type=='Mobile'){
                            $type ='number';
                            $length ="[10,10]";
                            $message = "Enter valid number.";
                        }else if($select_type=='Name'){
                          $type ='text';
                          $length ="";
                          $message = "Enter Name.";
                      }else if($select_type=='transaction_id'){
                            $type ='text';
                            $length ="";
                            $message = "Enter valid transaction id.";
                        }else if($select_type=='date'){
                            $type ='date';
                            $length ="";
                            $message = "Select date.";
                        }else{
                            $type ='number';
                            $length ="[10,10]";
                            $message = "Enter valid number.";
                        }
                ?>
                  <input class="form-control" type="{{ $type }}"  name="fillter_value" required  
                  value="{{old('mobile')?old('mobile'):$fillter_value}}"
                  data-parsley-error-message="{{ $message }}"  
                  data-parsley-length="{{ $length }}"   id="fillter_value_input" />


                  @if (Session::has('failed'))
                    
                  <span style="color:red;">{{Session::get('failed')}}</span>
                  @endif
                </div>
              </div>
              <div class="col-sm-4" id="to_date" style="display:{{$select_type=="date"?'':'none' }}">
                <div class="form-group">
                  <label for="inputName">To Date</label>
                  <input class="form-control" type="date" name="end_date"  value="{{$end_date}}" 
                  data-parsley-error-message="Select to date" id="end_date_id">
                </div>
              </div>
              
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
                                       
            <div class="row">
                     <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h6 class="card-title">Transaction History</h6>
                                  <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#demo">
                                      <i class="fas fa-minus"></i></button>
                                  </div> -->
                                </div>
                                <div class="card-body" id="demo">
                                  <div class="row">
                                      <div class="table-responsive col-sm-12 fixTableHead">
                                      @if (count($payment_history)>0)
                        <table class="loantable table table-bordered table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="2%">Sr.no</th>                  
                                   
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <!-- <th>Due Date</th> -->
                                    <th>Transaction Date</th>
                                    <th>Transaction Id</th>
                                    <!-- <th>EMI Amount</th> -->
                                    <!-- <th>Late Fees</th> -->
                                    <th>Amount</th>
                                    <th>Late Fees</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody >
                             
                                @foreach ($payment_history as $item)
                                <tr>
                                    <?php
                                $user =DB::table('customer_auths')->where('username',$item->username)->first();
                                    ?>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $user?$user->costomer_name:'' }}</td>
                                    <td>{{ $item->username }}</td>
                                    <!-- <td>{{ $item->due_date }}</td> -->
                                    <td>{{ $item->transaction_date }}</td>
                                    <td>{{ $item->transaction_id }}</td>
                                    <!-- <td>{{ $item->emi_amount }}</td> -->
                                    <td>{{ $item->pay_amount }}</td>
                                    <td>{{ $item->late_charge }}</td>
                                    <!-- <td>{{ date('d-m-Y',strtotime($item->next_emi_date)) }}</td> -->
                                    <td><a class="btn  loginbtn" style="background:{{$item->status == 'Success'?'#5cb85c':'Red'}};"  >{{$item->status }}</a></td>
                                </tr>
                               
                                
                                @endforeach
                                 
                             
                            </tbody>
                        </table>
                        @else

                            <h1 styly="display:flex; justify-content:center; align-items:center;">Record not found !</h1>
                        @endif
                    </div>
                    



                                      </div>
                                      <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                      @if(count($payment_history)>0)
                                      {!! $payment_history->links() !!}
                                      @endif
                                              
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
        function fillterFun(Fillter_id){
            if(Fillter_id == 'fillter_mobile'){
                
                $('#fillter_value_input').attr('data-parsley-length','[10,10]');
                $('#fillter_value_input').attr('Placeholder','Mobile number');
                $('#fillter_value_input').attr('data-parsley-error-message','Enter valid mobile number');
                $('#fillter_value_input').attr('type','number');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');




            }else if(Fillter_id == 'transaction_id'){
                $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('Placeholder','Transaction Id');

                $('#fillter_value_input').attr('data-parsley-error-message','Enter valid transaction Id');
                $('#fillter_value_input').attr('type','text');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');



            }else if(Fillter_id == 'fillter_date'){

              var html = `  <div class="col-sm-4"><input class="form-control" type="date"  name="fillter_value2" required   
                  data-parsley-error-message="Enter end date."  
                     id="fillter_value_input1" /></div>`;

                $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('data-parsley-error-message','Select date');
                $('#fillter_value_input').attr('type','date');
                $('#fillter_value_input').val('');
                $('#to_date').show();
                $('#end_date_id').attr('required','required');

            }else if(Fillter_id == 'name'){

              
              $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('Placeholder','Name');

                $('#fillter_value_input').attr('data-parsley-error-message','Enter name');
                $('#fillter_value_input').attr('type','text');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');
            }
        }

</script>

  @endsection