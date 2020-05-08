<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class AttendanceController extends Controller{

    public function index(Request $request){
        return view('attendance.index');
    }

    public function show(Request $request, $id){
        return view('attendance.show');
    }

}
