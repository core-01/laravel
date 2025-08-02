@extends('admin.master.adminMaster')
@section('main-content')
<?php
   use App\Models\BankDetail; 
   use App\Models\CustomerAuth; 
   use App\Models\ApproveLoan; 
   use Carbon\Carbon;
   use App\Models\TextReport;
?>
<style>
    input[type=radio] {
        color: red;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-5 mb-4">Report</h2>
            <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <a href="{{url('populate-report')}}">
                <button style="padding:10px; background:#5554FF; border-radius:10px;margin-bottom:5px;color:#fff; float:right;">Add new Report</button>
                    </a> </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Reports</h6>
                        </div>
                        <div class="card-body" id="demo">
                            <div class="row">
                                <div class="table-responsive col-sm-12 fixTableHead">
                               
                                    <table class="loantable table table-bordered table-striped" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">Sr.no</th>
                                                <th>Report's Name</th>
                                                <th>Action </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $report)
                                                <tr>
                                                    <td>{{ $loop->index+1}}</td>
                                                    <td>{{ $report->report_code }}</td>
                                                    <td><a href="{{ url('populate-report?id=' . $report->id) }}">Edit</a> |
                    
                                                                  <!-- Delete Button -->
                                                             <form action="{{ route('delete.report', ['id' => $report->id]) }}" method="post" style="display: inline-block;">
                                                             @csrf
                                                             @method('DELETE')
                                                              <button type="submit" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                                             </form>
                                                     </td>
                                                    <!-- <td><a href="{{url('populate-report?id='.$report->id)}}">Edit</a></td> -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    
                                    <!-- <h1 styly="display:flex; justify-content:center; align-items:center;">Record not
                                        found !
                                    </h1> -->
                                

                                        
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </main>
    @endsection
</div>