<?php

namespace App\Util;

use App\Models\TextReport;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Log;

/**
 * Service To create PDF
 */
class TextReportPDFService
{
    //This method creates a temporray file to be used by WKHTMLTOPDF will be called only if Header/Footer is needed
    protected function createTemporaryFile($content = null, $extension = null)
    {
        $filename = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid('trishyodaya', true);

        if (null !== $extension) {
            $filename .= '.' . $extension;
        }

        if (null !== $content) {
            file_put_contents($filename, $content);
        }

        return $filename;
    }

    //This method is used for putting values in variables defined in Report
    protected function renderHtmlWithVariables($htmlContent, $variables)
    {
        // Create a temporary Blade view file
        $viewPath = tempnam(sys_get_temp_dir(), 'blade_view_') . '.blade.php';
        file_put_contents($viewPath, $htmlContent);

        // Render the view with variables
        $renderedHtml = view()->file($viewPath, $variables)->render();

        // Remove the temporary Blade view file
        unlink($viewPath);

        return $renderedHtml;
    }

    //This method will generate PDF and return its path
    public function generatePDF(string $report_code = null, string $language_code = null,$variables = null, string $file_name = null)
    {
        //dd($report_code);
        //dd($variables);

        // Fetch data from the TEXT_REPORT table using report_code and language_code
        $condition = ['report_code' => $report_code, 'language_code' => $language_code];
        $data = TextReport::where($condition)->first();

        if ($data) {
            // Record found, handle it as needed

            $header = $data->getHeaderRef();
            $footer = $data->getFooterRef();

            
        } else {
            // Record not found
            throw new \Exception('Report not found.');
        }

        // Create a view using the data (you can also use plain HTML)
        $report_content = $data['report_content'];

        $header_content = $header['report_content'];
        $footer_content = $footer['report_content'];


        $text = $this->renderHtmlWithVariables($report_content, $variables);
        $view = view('admin.text-report', ['report_content' => $text])->render();

        //dd($view);

        //return $view;

        // Generate the PDF with the dynamic content

        $header_view = view('admin.text-report_header', ['header_content' => $header_content])->render();
        $pdf = SnappyPdf::loadHTML($view);
        $pdf->setOption("enable-local-file-access", true);
        $pdf->setOption('header-html', $header_view);
        $pdf->setOption('margin-top', '20mm');
        $pdf->setOption('lowquality', false);
        //$pdf->setTimeOut(60);
        //$pdf->setOption('javascript-delay', 13500);
        //$pdf->setOption('enable-smart-shrinking', true);
        //$pdf->setOption('no-stop-slow-scripts', true);
        //$pdf->setLogger(Log::channel('snappy'));


        //return $pdf->inline('output.pdf');

        // You can save the PDF if needed
        Log::debug("Reached Here ");
        try
        {
            $pdf->save(public_path('upload/tNc/'.$file_name), true);
        }
        catch(\Exception $e)
        {
            Log::error('An error occurred: '. $e->getMessage(), ['exception' => $e]);
            return $e->getMessage();
        }

        Log::debug("Reached Here 2");

        return 'SUCCESS';
    }
}
