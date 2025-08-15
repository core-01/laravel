<?php

namespace App\Http\Controllers;

use App\Models\ReferenceData;
use App\Models\TextReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;

class TextReportActionController extends Controller
{

    public function showReport()
    {
        $sessiond = Session::get('admin');

        if ($sessiond) {
            if ($sessiond->role == 1) {
                $reports = TextReport::all(); // Fetching all records from the text_report table
                return view('admin.report', compact('reports'));
            } else if ($sessiond->role == 2) {
                $access_url = \DB::table('admin_accesses')->where('admin_id', $sessiond->id)->select('url_id')->first();
                $urls = explode(',', $access_url ? $access_url->url_id : '');
                if (in_array(12, $urls)) {
                    $reports = TextReport::all(); // Fetching all records from the text_report table
                    return view('admin.report', compact('reports'));
                }
            } else {
                return redirect('page-not-found');
            }
            return view('admin.report');
        }
    }

    public function populateReport(Request $request)
    {
        try {
            $headers = TextReport::select('id', 'report_code')->where('is_header', true)->get();
            $footers = TextReport::select('id', 'report_code')->where('is_footer', true)->get();
            $languages = ReferenceData::select('src_value', 'mapped_value')->where('ref_data_code', 'LANGUAGE_SUPPORT')->get();
            //dd($headers.' '.$footers.' '.$languages);
            if ($request->id) {
                $id = $request->id;
                $action = 'Edit';
                $textReport = TextReport::where('id', $id)->first();
                //dd($textReport->getAttributes()+['action'=>$action]);

                if ($textReport) {
                    return view('text-report-view', $textReport->getAttributes() + ['action' => $action, 'headers' => $headers, 'footers' => $footers, 'languages' => $languages]);
                } else {
                }
            } else {
                $action = 'Add';
                $textReport = [
                    'report_code' => '',
                    'language_code' => 'H',
                    'is_header' => '0',
                    'is_footer' => '0',
                    'header_ref' => '',
                    'footer_ref' => '',
                    'report_content' => ''
                ];
                //dd($textReport);
                return view('text-report-view', $textReport + ['action' => $action, 'headers' => $headers, 'footers' => $footers, 'languages' => $languages])->render();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addReport(Request $request)
    {

        try {
            $textReport = new TextReport();
            $textReport->report_code = $request->input('report_code');
            $textReport->language_code = $request->input('language_code');
            $textReport->is_header = $request->input('is_header');
            $textReport->is_footer = $request->input('is_footer');
            $textReport->header_ref = $request->input('header_ref');
            $textReport->footer_ref = $request->input('footer_ref');
            $textReport->report_content = $request->input('report_content');

            $status = $textReport->save();
            //dd($status);

            return redirect()->route('admin.report')->with('success', 'Report Added Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editReport(Request $request)
    {
        try {
            $textReport = TextReport::where('id', $request->input('id'));
            $textReportUpdated = [
                'id' => $request->input('id'),
                'report_code' => $request->input('report_code'),
                'language_code' => $request->input('language_code'),
                'is_header' => $request->input('is_header'),
                'is_footer' => $request->input('is_footer'),
                'header_ref' => $request->input('header_ref'),
                'footer_ref' => $request->input('footer_ref'),
                'report_content' => $request->input('report_content')
            ];

            $status = $textReport->update($textReportUpdated);
            //dd($status);

            return redirect()->route('admin.report')->with('success', 'Report Updated Successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete($id)
    {
        $report = TextReport::find($id);

        if ($report) {
            $report->delete();
            return redirect()->back()->with('success', 'Report deleted successfully!');
        }

        return redirect()->back()->with('error', 'Report not found');
    }
     
}
