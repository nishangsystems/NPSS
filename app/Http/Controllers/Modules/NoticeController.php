<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class NoticeController extends Controller{

    public function index(Request $request){
        return view('notice.index');
    }

    public function create(Request $request){
        return view('notice.create');
    }

}
