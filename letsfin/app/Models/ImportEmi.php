<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\Models\LoanRequest;
use App\Http\Controllers\ExcelController;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use DB;
use Carbon\Carbon;


class ImportEmi  implements ToCollection ,WithHeadingRow
{
   
    public function collection(Collection $rows){


           foreach($rows as $row1){
                   $row2 = $row1->toArray();
                   
           $validator = Validator::make($row2, [
                       'mobile_number' =>  'required|numeric',

                   ])->validate();
                   
                  //  dd($row1);
          foreach ($rows->toArray() as $row) {
            // $next_due_date =Date::excelToDateTimeObject($row['next_emi_date'])->format('d-m-Y');
            // $transaction_date =Date::excelToDateTimeObject($row['transaction_date'])->format('d-m-Y');
            $transaction_date =Date::excelToDateTimeObject($row['received_date'])->format('d-m-Y');
            $due_date =Date::excelToDateTimeObject($row['due_date'])->format('d-m-Y');

            
            // due_date
             // Check mobile already exists
           $user = DB::table('customer_auths')->where('username',$row['mobile_number'])->first();
           $exist = DB::table('emi_details')->where('username', $row['mobile_number'])->where('transaction_date',$transaction_date)->count();
       
           if($exist > 0){
                continue;
             }
      

        if($user){
            //  $insertData =[
            //     'loan_request_number'=> $user->loan_request_number,
            //     'username'=> $user->username,
            //     'emi_amount'=> $row['emi_amount'],
            //     'late_charge'=> $row['late_charge'],
            //     'pay_amount'=> $row['paid_aamount'],
            //     'due_amount'=> $row['due_amount'],
            //     'transaction_date'=> $transaction_date,
            //     'transaction_id'=> $row['transaction_id'],
            //     'next_emi_date'=> $next_due_date,
            //     'status'=> 'Success',
            //  ];
            $date_due = date('d-m-Y',strtotime($due_date));
                                     $next_due_date =(((new Carbon($date_due))->addMonths(1)));
                                    //  $add_day =(((new Carbon($todaydate))->addDays(30)));

             $insertData =[
               'loan_request_number'=> $user->loan_request_number,
               'username'=> $user->username,
               'emi_amount'=> $row['emi_amount'],
               'late_charge'=> $row['charges_received'],
               'pay_amount'=> $row['total_received'],
               'due_amount'=> $row['pending_amount'],
               'transaction_date'=> $transaction_date,
               'transaction_id'=> $row['transaction_id'],
               'due_date'=> $due_date,
               'interest_amount'=> $row['interest'],
               'comment'=> $row['comment'],
               'principle_amount'=> $row['principle'],
               'next_emi_date'=> date('Y-m-d', strtotime($next_due_date)),
               'status'=> 'Success',
            ];

             $res = DB::table('emi_details')->insert($insertData);
             if($res){
               // $user = DB::table('customer_auths')->where('username',$row['mobile_number'])->first();
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
