<?php

namespace App\Http\Controllers;

use App\Util\TextReportPDFService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TextReportPDFController extends Controller
{

    protected $textReportPDFService;

    public function __construct(TextReportPDFService $textReportPDFService)
    {
        $this->textReportPDFService = $textReportPDFService;
    }

    public function generatePDF(Request $request)
    {
        try{

        $report_code = $request->report_code;

        $variables = array(
            "user_id" => "3344552233",
  "contact_number" => "3344552233",
  "applyy_date" => "2024-03-18",
  "name" => "Raghu Test 1",
  "pan_number" => "MABPS9415D",
  "yearly_income" => null,
  "existing_loan" => "3500",
  "roi" => "42",
  "loan_amount" => "50000",
  "parent_name" => "Abc1",
  "address" => "Add1, Delhi-2",
  "present_address" => "3344552233",
  "loan_amount_w" => "fifty  thousands Rupees ",
  "processing_fees" => "1500",
  "cheque_number" => "444555666",
  "bank_name" => "SBi",
  "garauntor_name1" => "Witness1",
  "garauntor_name2" => "Witness2",
  "total_charges" => 1500,
  "disbursed_amount" => 48500,
  "tenure" => "12"
        );

        $status = $this->textReportPDFService->generatePDF($report_code,'H',$variables,'pavan_test.pdf');
        
        //return $status;
        
         return 'File :'.$status." Generated Successfully";

        }
        catch(\Exception $e)
        {
            Log::error('An error occurred: '. $e->getMessage(), ['exception' => $e]);
            return $e->getMessage();
        }
    }
}
