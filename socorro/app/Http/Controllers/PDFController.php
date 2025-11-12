<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\CategoryCheck;

class PDFController extends Controller
{
    public function pdf(Request $request){
        $data = $request;
        $pdf = PDF::loadView('pdf.checklist', compact('data'));
        return $pdf->download('checklist.pdf');
    }
}
