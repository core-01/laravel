<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\Models\LoanRequest;
use App\Http\Controllers\ExcelController;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

use DB;

class ImportExcal  implements ToCollection ,WithHeadingRow
{
   
        public function collection(Collection $rows){

       
        

            foreach($rows as $row1){
                    $row2 = $row1->toArray();
                    
            $validator = Validator::make($row2, [
                        'mobile' =>  'required|numeric',
                        // 'client_name' =>  'required',
                        // 'distribution_date' =>  'required',
                      
                        
                    ])->validate();
                 
           foreach ($rows->toArray() as $row) {
            // dd($row);
            $loan_request_date =Date::excelToDateTimeObject($row['loan_request_date'])->format('d-m-Y');
            $approved_date =Date::excelToDateTimeObject($row['approved_date'])->format('d-m-Y');
            // dd('uuyiouy');
            $loan_trasnfer_date =Date::excelToDateTimeObject($row['loan_trasnfer_date'])->format('d-m-Y');
            $next_emi_date =Date::excelToDateTimeObject($row['next_emi_date'])->format('d-m-Y');
            $first_emi =Date::excelToDateTimeObject($row['first_emi'])->format('d-m-Y');
            $distribution_date =Date::excelToDateTimeObject($row['distribution_date'])->format('d-m-Y');
            // dd($approved_date);

           
              // Check mobile already exists
            $exist = LoanRequest::where('mobile',$row['mobile'])->count();
            // $exist1 = LoanRequest::all();  
            if($exist > 0){
                 continue;
              }
            // dd($exist1);
           
              $loan_req_number = 'TRISH'.rand(11111,99999);
            $req = new LoanRequest();
            $req->loan_request_number = $loan_req_number;
            $req->name = $row['client_name'];
            $req->email = $row['email'];
            $req->mobile = $row['mobile'];
            $req->loan_amount = $row['amount'];
            $req->existing_loan = $row['existing_loan'];
            $req->source = 'ExcelSheet';
            $req->father_name = $row['father_name'];
            $req->mother_name = $row['mother_name'];
            $req->alternate_mobile = $row['2nd_mobile'];
            $req->profession = $row['profession'];
            $req->reason = $row['reason'];
            $req->employer_company_name = $row['employer_company_name'];
            $req->salary = $row['income'];
            // $req->spause = $row['first_name'];
            $req->present_address = $row['present_address'];
            $req->pincode = $row['pincode'];
            $req->permanent_address = $row['permanent_address'];
            $req->witness_1 = $row['witness_1'];
            $req->witness_2 = $row['witness_2'];
            $req->qualification = $row['qualification'];
            $req->cheque_no_received = $row['cheque_no_received'];
            $req->no_of_years_in_present_Job = $row['no_of_years_in_present_job'];
            $req->no_of_employee_in_company = $row['no_of_employee_in_company'];
            $req->married_status = $row['married_status'];
            $req->family_income = $row['family_income'];
            $req->other_loan_details = $row['other_loan_details'];
            $req->rent_paid = $row['rent'];
            $req->request_date = $loan_request_date; //loan request date
            $req->user_status = "Accepted";
            $req->loan_status = "Approved";
            $res = $req->save();
            if($res){
                //create username and password
               //  return back()->with('success',"done");
               // dd($res);
                $password = trim(substr($row['client_name'], 0, 4)).rand(1111,9999);
                $customer = new CustomerAuth();
                $customer->costomer_name = $row['client_name'];
                $customer->loan_request_number = $loan_req_number;
                $customer->username = $row['mobile'];
                $customer->password = $password;
                $res1 = $customer->save();

                if($res1){

            // // insert bank details
            $bankDtail = new BankDetail();
            $bankDtail->loan_request_number = $loan_req_number;
            $bankDtail->username = $row['mobile'];
            $bankDtail->bank_name = $row['bank'];
            // $bankDtail->branch_name = $row['client_name'];
            $bankDtail->ifscCode = $row['ifsc'];
            $bankDtail->account_number = $row['account'];
            $res2= $bankDtail->save();
            if($res2){
                $aprovedLoan = new ApproveLoan();
            $aprovedLoan->loan_request_number = $loan_req_number;
             $aprovedLoan->loan_duration = $row['month_duretion'];
            $aprovedLoan->approve_loan_amount = $row['amount'];
            $aprovedLoan->emi_amount = $row['emi_amount'];
            $aprovedLoan->status = "Approved";
            $aprovedLoan->procces_status_btn = "Processed";
            // $aprovedLoan->approved_date = $row['month_duretion'];
            $aprovedLoan->loan_trasnfer_date = $row['month_duretion'];

            $aprovedLoan->interest = $row['rate_of_interest'];
            $aprovedLoan->processing_fees = $row['processing_fees'];
            $aprovedLoan->up_front_charges = $row['up_front_charges'];
            $aprovedLoan->other_charge = $row['other_charge'];
            $aprovedLoan->total_payble_amount = $row['amount'];
            $aprovedLoan->first_emi_date = $first_emi;
            $aprovedLoan->next_emi_date = $next_emi_date;
            $aprovedLoan->transaction_id = $row['transaction_id'];
            $aprovedLoan->total_payble_due_amount = $row['payble_due_amount'];
            $aprovedLoan->due_emi = $row['due_emi'];
            $aprovedLoan->total_receve_late_charge = $row['total_received_late_charge'];
            $aprovedLoan->approved_date = $approved_date;
            $aprovedLoan->loan_trasnfer_date = $loan_trasnfer_date;
            // $aprovedLoan->total_interest_charge = $row['month_duretion'];
            $res= $aprovedLoan->save();

           
            $user = \DB::table('customer_auths')->where('loan_request_number',$loan_req_number)->first();
            for($i=0; $i < intval($row['month_duretion']);$i++){
              if($i < intval($row['due_emi'])){

              
                $create_emi = new TotalEmi();
                $create_emi->loan_request_number = $loan_req_number;
                $create_emi->username = $user?$user->username:'';
                $create_emi->emi_due_date =  (((new Carbon($first_emi))->addMonths($i)))->toDateString();
                $create_emi->emi_amount = $row['emi_amount'];
                $create_emi->intrest = (intval($row['emi_amount'])/100) * intval($row['rate_of_interest']);
                $create_emi->paid_amount = intval($row['emi_amount']) + (intval($row['emi_amount'])/100) * intval($row['rate_of_interest']);

                $create_emi->late_fees = 0;
                $create_emi->due_amount = 0;
                $create_emi->rate_of_intrest = $row['rate_of_interest'];
                $create_emi->payment_status = 'Paid' ;
                $create_emi->save();
              }else{

                $create_emi = new TotalEmi();
                $create_emi->loan_request_number = $loan_req_number;
                $create_emi->username = $user?$user->username:'';
                $create_emi->emi_due_date =  (((new Carbon($first_emi))->addMonths($i)))->toDateString();
                $create_emi->emi_amount = $row['emi_amount'];
                $create_emi->intrest = (intval($row['emi_amount'])/100) * intval($row['rate_of_interest']);
                $create_emi->paid_amount = 0;
                $create_emi->late_fees = 0;
                $create_emi->due_amount = $row['emi_amount'];
                $create_emi->rate_of_intrest = $row['rate_of_interest'];
                $create_emi->payment_status = 'Upcoming';
                $create_emi->save();
              }
            }


            }
                }

            }
          
           }
          }
        }
    
        // Specify header row index position to skip
        public function headingRow(): int {
           return 1;
        }
    }
