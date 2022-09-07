<?php


namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
        if($request->user()->hasRole('admin')){
            return view('dashboard.admin');
        }else if($request->user()->hasRole('teacher')){
            return view('dashboard.teacher');
        }else if($request->user()->hasRole('parent')){
            return view('dashboard.parent');
        }else{
            return view('dashboard.admin');
        }

    }

}
