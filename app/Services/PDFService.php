<?php
namespace App\Services;

use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class PDFService
{
    protected $mpdf;

    public function __construct()
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $this->mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 20,
            'margin_footer' => 10,
            'fontDir' => array_merge($fontDirs, [
                public_path('assets/fonts'),
            ]),
            'fontdata' => $fontData + [
                'cairo' => [
                    'R' => 'Cairo/Cairo-Regular.ttf',
                    'B' => 'Cairo/Cairo-Bold.ttf',
                    'I' => 'Cairo/Cairo-Light.ttf',
                    'BI' => 'Cairo/Cairo-SemiBold.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
            ],
            'default_font' => 'cairo'
        ]);
    }

    public function writeHTML($html)
    {
        $this->mpdf->WriteHTML($html);
        return $this;
    }

    public function setHTMLHeader($html)
    {
        $this->mpdf->SetHTMLHeader($html);
        return $this;
    }

    public function setHTMLFooter($html)
    {
        $this->mpdf->SetHTMLFooter($html);
        return $this;
    }

    public function setDocTemplate($file = '', $continue = 0, $continue2pages = 0)
    {
        if (!file_exists($file)) {
            throw new \Exception("PDF file not found at path: {$file}");
        }

        $this->mpdf->SetDocTemplate($file, $continue, $continue2pages);
        return $this;
    }

    public function output($path, $type)
    {
        return $this->mpdf->Output($path, $type);
    }

    public function response($filename = '')
    {
        return $this->output($filename, 'I');
    }

    public function download($filename = '')
    {
        return $this->output($filename, 'D');
    }
}

