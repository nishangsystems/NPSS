<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function renderDocument($filename) {
        return render_file($filename, storage_path('files'));
    }
}
