<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRequest;
use Session;
class DistributeViewController extends Controller
{
    public function distDashboard(){
        return view('distributor.dashboard');
    }

    public function addUser(){
        $loanRequest =LoanRequest::where('distributor_id',Session::get('distributor')->id)->orderBy('id', 'DESC')->paginate(20);
        // dd($loanRequest);
        return view('distributor.add-user',['loanRequest'=>$loanRequest]);
    }

    public function changePassword(){
        return view('distributor.change-password');
    }

    public function addExcelFile(){
        return view('distributor.add-excel-file');
    }


    public function loanStatus(){
        $loanRequest =LoanRequest::where('distributor_id',Session::get('distributor')->id)->orderBy('id', 'DESC')->get();

        return view('distributor.loan-status',['loanRequest'=>$loanRequest]);
    }
    public function distLogin(){
        if(Session::has('distributor')){
            return redirect('distributor-dashboard');
        }
        return view('distributor.index');
    }

    
}
