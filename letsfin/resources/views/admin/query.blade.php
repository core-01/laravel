@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
    use Carbon\Carbon;
?>

<style>
    input[type=radio] {
        color: red;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Queries</h2>



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Queries</h6>

                        </div>
                        <div class="card-body" id="demo">
                            <div class="row">
                                <div class="table-responsive col-sm-12 fixTableHead">
                                    @if (count($query)>0)
                                    <table class="loantable table table-bordered table-striped" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">Sr.no</th>

                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($query as $key => $item)
                                            <tr>

                                                <td>{{ $query->firstItem() + $key}}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->message }}</td>
                                                <td><a onclick="return deleteFun('You are to delete this query.')"
                                                        href="{{url('delete-query',['id'=>base64_encode($item->id)])}}">Delete</a>
                                                </td>
                                            </tr>


                                            @endforeach


                                        </tbody>
                                    </table>
                                    @else

                                    <h1 styly="display:flex; justify-content:center; align-items:center;">Record not
                                        found !</h1>
                                    @endif
                                </div>




                            </div>
                            <ul class="pagination pagination-sm" style="float:right; margin: 30px 0px;">
                                @if(count($query)>0)
                                {!! $query->links() !!}
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
        function fillterFun(Fillter_id) {
            if (Fillter_id == 'fillter_mobile') {

                $('#fillter_value_input').attr('data-parsley-length', '[10,10]');
                $('#fillter_value_input').attr('Placeholder', 'Mobile number');
                $('#fillter_value_input').attr('data-parsley-error-message', 'Enter valid mobile number');
                $('#fillter_value_input').attr('type', 'number');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');




            } else if (Fillter_id == 'transaction_id') {
                $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('Placeholder', 'Transaction Id');

                $('#fillter_value_input').attr('data-parsley-error-message', 'Enter valid transaction Id');
                $('#fillter_value_input').attr('type', 'text');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');



            } else if (Fillter_id == 'fillter_date') {

                var html = `  <div class="col-sm-4"><input class="form-control" type="date"  name="fillter_value2" required   
                  data-parsley-error-message="Enter end date."  
                     id="fillter_value_input1" /></div>`;

                $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('data-parsley-error-message', 'Select date');
                $('#fillter_value_input').attr('type', 'date');
                $('#fillter_value_input').val('');
                $('#to_date').show();
                $('#end_date_id').attr('required', 'required');

            } else if (Fillter_id == 'name') {


                $('#fillter_value_input').removeAttr('data-parsley-length');
                $('#fillter_value_input').attr('Placeholder', 'Name');

                $('#fillter_value_input').attr('data-parsley-error-message', 'Enter name');
                $('#fillter_value_input').attr('type', 'text');
                $('#fillter_value_input').val('');
                $('#to_date').hide();
                $('#end_date_id').removeAttr('required');
            }
        }

    </script>

    @endsection