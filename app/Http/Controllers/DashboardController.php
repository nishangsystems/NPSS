<?php


namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(Request $request){
        if($request->user()->hasRole('admin')){
            $year = Carbon::now()->year;
                $fees = \App\StudentFeePayment::select(
                        \DB::raw('MONTH(created_at) as month'),
                        \DB::raw('SUM(amount) as amount')
                    )
                    ->whereMonth('created_at', '=', Carbon::now()->month)
                    ->orWhereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                    ->orWhereMonth('created_at', '=', Carbon::now()->subMonth()->subMonth()->month)
                    ->whereYear('created_at','=',$year)
                    ->groupBy('month')
                    ->get();
                $data['mFees'] = $fees;



            $data['mFees'] = $fees;
            return view('dashboard.admin')->with($data);
        }else if($request->user()->hasRole('teacher')){
            return view('dashboard.teacher');
        }else if($request->user()->hasRole('parent')){
            return view('dashboard.parent');
        }else{
            return view('dashboard.admin');
        }

    }

}
