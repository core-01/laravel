<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ImportExcal;
use App\Models\ImportEmi;
use App\Models\LoanRequest;
use Response;
use DB;
use Excel;


class ExcelController extends Controller
{
    function importData(Request $request){
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
       
        try {
            Excel::import(new ImportExcal, $request->file('uploaded_file'));
           return back()->with('success', 'Import successfully!');
        }catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
            
        }
    
    }

    public function importEMI(Request $request){

        // dd($request->all());
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
    //    dd($request->all());
        try {
            Excel::import(new ImportEmi, $request->file('uploaded_file'));
           return back()->with('success', 'Import successfully!');
        }catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
            // dd($e->getMessage());
            
        }
    }

    public function requestL($data){
        // dd($data);
        $req = new LoanRequest();
        $req->loan_request_number = '213223e';
        $req->name = $data['name'];
        $req->email = $data['email'];
        $req->mobile = $data['mobile'];
        $ee= $req->save();
        dd($ee);

        // $rr =DB::table('loan_requests')->insert($data);
        dd($rr);

    }


    public function getDownload(Request $request){
        //PDF file is stored under project/public/download/info.pdf
        if($request->data=='customers'){
            $file=public_path('excalfile/Customers_data.xlsx');

        }else if($request->data=='EMI'){
            $file=public_path('excalfile/Emi_report_view.xlsx');

        // $file="C:\Users\AKS-Shikhar\Desktop\Emi_report_view.xlsx";
        }
        return Response::download($file);
}
}
