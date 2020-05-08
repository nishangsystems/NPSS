<?php


namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
        return view('dashboard.parent');
    }

}
