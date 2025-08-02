<?php

namespace App\Http\Controllers;

use App\Models\TextReport;
use Illuminate\Http\Request;
use App\Models\LoanRequest;
use App\Models\Distributor;
use App\Models\BankDetail;
use App\Models\ApproveLoan;
use App\Models\TotalEmi;
use App\Models\EmiDetail;
use App\Models\GenrateEmi;
use App\Models\CustomerAuth;
use Carbon\Carbon;
use Session;


class AdminViewController extends Controller
{


    // public function updatemii(){
    //         $loan = ApproveLoan::where('procces_status_btn','Processed')->get();
    //         if(count($loan)>0){
    //             foreach($loan as $item){
    //                 \DB::table('loan_requests')->where('loan_request_number',$item->loan_request_number)->update(['user_accept_t_N_c'=>"Accepted"]);
    //             }
    //         }
    // }


    public function emiTransactionHistory(Request $request)
    {

        $select_type = "Mobile";
        $fillter_value = "";
        $end_date = "";
        if ($request->fillter_value) {
            if ($request->fillter_by == "Mobile") {

                $exists = EmiDetail::where('username', $request->fillter_value)->latest()->get();
                if (count($exists) <= 0) {
                    return back()->with('failed', 'Record Not Found !')
                        ->withInput($request->all());
                }
            }
        }


        $payment_history = EmiDetail::latest()->paginate(20);
        if ($request->fillter_value) {
            if ($request->fillter_by == "Mobile") {

                $payment_history = EmiDetail::where('username', $request->fillter_value)->latest()->paginate(20);
                $select_type = "Mobile";
                $fillter_value = $request->fillter_value;
            } else if ($request->fillter_by == "Transaction Id") {
                $payment_history = EmiDetail::where('transaction_id', $request->fillter_value)->latest()->paginate(20);
                $select_type = "transaction_id";
                $fillter_value = $request->fillter_value;


            } else if ($request->fillter_by == "Date") {
                // $payment_history = EmiDetail::where('transaction_date',date('Y-m-d',strtotime($request->fillter_value)))->latest()->paginate(20);
                $payment_history = EmiDetail::whereBetween('transaction_date', [date('Y-m-d', strtotime($request->fillter_value)), date('Y-m-d', strtotime($request->end_date))])->latest()->paginate(20);
                $select_type = "date";
                $fillter_value = $request->fillter_value;
                $end_date = $request->end_date;


            } else if ($request->fillter_by == "Name") {
                $user = \DB::table('customer_auths')->where('costomer_name', 'like', $request->fillter_value . '%')->select('loan_request_number')->get();
                $loan_request_numbers = array();
                if (count($user) > 0) {
                    foreach ($user as $user_id) {
                        $loan_request_numbers[] = $user_id->loan_request_number;
                    }
                    $payment_history = EmiDetail::whereRaw('FIND_IN_SET(?,loan_request_number)', $loan_request_numbers)->latest()->paginate(20);
                } else {
                    $payment_history = array();
                }

                // $payment_history = EmiDetail::where('transaction_date',date('Y-m-d',strtotime($request->fillter_value)))->latest()->paginate(20);
                // $payment_history = EmiDetail::whereBetween('transaction_date',[date('Y-m-d',strtotime($request->fillter_value)),date('Y-m-d',strtotime($request->end_date))])->latest()->paginate(20);
                $select_type = "Name";
                $fillter_value = $request->fillter_value;
                $end_date = $request->end_date;


            }
            // dd($payment_history);


        }
        return view('admin.transaction-history', compact('payment_history', 'select_type', 'fillter_value', 'end_date'));
    }
    public function adminLogin()
    {
        if (Session::has('admin')) {
            return redirect('admin-dashboard');
        }
        return view('admin.index');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }



    public function adminDashboard()
    {


        return view('admin.dashboard');
    }

    public function loanrequest(Request $request)
    {

        // $loanReq = LoanRequest::orderBy('id', 'DESC')->paginate(20);
        if ($request->status && $request->start_date && $request->end_date) {
            $loanReq = LoanRequest::whereBetween('request_date', [$request->start_date, $request->end_date])->where('loan_status', $request->status)->orderBy('id', 'DESC')->paginate(20);
        } else if ($request->start_date && $request->end_date) {
            $loanReq = LoanRequest::whereBetween('request_date', [$request->start_date, $request->end_date])->orderBy('id', 'DESC')->paginate(20);

        } else if ($request->status) {
            $loanReq = LoanRequest::where('loan_status', $request->status)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $loanReq = LoanRequest::orderBy('id', 'DESC')->paginate(20);

        }
        // dd()
        return view('admin.loanrequest', ['loanReq' => $loanReq]);
    }



    public function loanAproved()
    {
        $loanReq = LoanRequest::where(['user_status' => 'Accepted', 'user_accept_t_N_c' => 'Accepted'])->orderBy('id', 'DESC')->paginate(20);
        $bankDetail = BankDetail::all();
        // $bankDetail->loan_request_number
        // dd()
        return view('admin.approveLoan', ['loanReq' => $loanReq, 'bankDetail' => $bankDetail]);
    }
    public function viewAndPayEMI(Request $request)
    {
        $emi = array();
        if ($request->mobile) {

            $emi = GenrateEmi::where('username', $request->mobile)->orderBy('id')->get();
            if (count($emi) <= 0) {
                return back()->with('failed', 'Record Not Found !')
                    ->withInput($request->all());
            }
        }

        return view('admin.view-and-pay-emi', compact('emi'));
    }

    public function distributor()
    {
        $distributor = Distributor::orderBy('id', 'DESC')->paginate(20);

        return view('admin.distributor', ['distributor' => $distributor]);
    }

    public function viewFile(Request $request)
    {
        return view('admin.viewFile', ['image' => $request->id]);
    }

    public function ApprovedLoan($id)
    {
        $loan = ApproveLoan::where('loan_request_number', $id)->first();
        return view('admin.approved-loan', ['loan' => $loan]);
    }
    public function emiDetails()
    {
        $emidata = ApproveLoan::where('procces_status_btn', "Processed")->join('loan_requests', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')->get();

        return view('admin.customer-emi-detail', ['emidata' => $emidata]);
    }

    public function dueEmi()
    {


        $emidata = ApproveLoan::where('procces_status_btn', "Processed")->join('loan_requests', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')->where('approve_loans.payment_status', 'Pending')->orderBy('approve_loans.next_emi_date')->paginate(20);
        //  dd($emidata);
        return view('admin.due-emi', ['dueEmidata' => $emidata]);
    }

    public function paidEmi()
    {


        $emidata = ApproveLoan::where('procces_status_btn', "Processed")->join('loan_requests', 'loan_requests.loan_request_number', '=', 'approve_loans.loan_request_number')->where('approve_loans.payment_status', 'Paid')->paginate(20);
        // $emidata = \DB::table('approve_loans')->where('procces_status_btn',"Processed")->join('loan_requests','loan_requests.loan_request_number','=','approve_loans.loan_request_number')->where('approve_loans.payment_status','Paid')->select('approve_loans.*','loan_requests.*')->paginate(20);

        return view('admin.paid-emi', ['paidEmidata' => $emidata]);
    }

    public function addExcelFile()
    {
        return view('admin.add-excel-file');
    }
    public function addExcalEmi()
    {
        return view('admin.add-excal-emi');

    }

    public function viewAndPay($loan_request_number)
    {
        $emi = GenrateEmi::where(['loan_request_number' => base64_decode($loan_request_number), 'payment_status' => 'Pending'])->get();
        // dd(count($emi)>0);
        return view('admin.view-and-pay-emi', compact('emi'));
    }


    public function getStatement(Request $request)
    {
        $loanReq = \DB::table('loan_requests')->where('loan_request_number', $request->id)->first();
        $statement = json_decode(stripslashes($loanReq->bank_statement));
        $adharCard = json_decode(stripslashes($loanReq->adhar_card));
        // dd($statement);

        return response()->json(['statement' => $statement, 'adhar' => $adharCard]);
    }


    public function adminView()
    {
        $admins = \DB::table('admins')->where('role', 2)->latest()->get();

        $sessiond = Session::get('admin');
        if ($sessiond->role == 1) {
            return view('admin.admins', compact('admins'));
        } else if ($sessiond->role == 2) {
            $access_url = \DB::table('admin_accesses')->where('admin_id', $sessiond->id)->select('url_id')->first();
            $urls = explode(',', $access_url ? $access_url->url_id : '');
            if (in_array(11, $urls)) {
                return view('admin.admins', compact('admins'));

            } else {
                return redirect('page-not-found');
            }
        }

    }

    public function admin()
    {
        $url = \DB::table('admin_urls')->get();
        $sessiond = Session::get('admin');
        if ($sessiond->role == 1) {
            return view('admin.create-admin', compact('url'));
        } else if ($sessiond->role == 2) {
            $access_url = \DB::table('admin_accesses')->where('admin_id', $sessiond->id)->select('url_id')->first();
            $urls = explode(',', $access_url ? $access_url->url_id : '');
            if (in_array(11, $urls)) {
                return view('admin.create-admin', compact('url'));

            } else {
                return redirect('page-not-found');
            }
        }

    }


    public function queries()
    {
        $query = \DB::table('contacts')->latest()->paginate(20);

        $sessiond = Session::get('admin');
        if ($sessiond->role == 1) {
            return view('admin.query', compact('query'));
        } else if ($sessiond->role == 2) {
            $access_url = \DB::table('admin_accesses')->where('admin_id', $sessiond->id)->select('url_id')->first();
            $urls = explode(',', $access_url ? $access_url->url_id : '');
            if (in_array(10, $urls)) {
                return view('admin.query', compact('query'));

            } else {
                return redirect('page-not-found');
            }
        }

    }   
}