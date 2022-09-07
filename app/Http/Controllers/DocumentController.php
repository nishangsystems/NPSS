<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function renderDocument($filename) {
        return render_file($filename, storage_path('files'));
    }

    public function printPDF()
    {   $data['title'] = "PDF";
        $pdf = \PDF::loadView('template.fee', $data);
        //return $pdf->download('medium.pdf');
        return view('template.fee',$data);
    }
}
