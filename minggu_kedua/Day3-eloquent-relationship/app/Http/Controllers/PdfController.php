<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function ExportPdf()
    {
        $pdf = PDF::loadView('pdf.index');
        return $pdf->download('posts.pdf');
    }
}
