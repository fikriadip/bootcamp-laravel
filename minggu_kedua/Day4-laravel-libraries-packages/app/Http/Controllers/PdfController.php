<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    // DOMPDF Controller
    public function TestPdf()
    {
        // hanya melempar data tanpa array
        $datapdf = "Bismillahirrahmannirrahiim 2021 jadi lebih baik";
        $pdf = PDF::loadView('pdf.test', compact('datapdf'));
        return $pdf->download('test.pdf');
    }
}
