<?php


namespace App\Http\Controllers;

use App\Classes;
use App\StudentsClass;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller{

    public function index(Request $request){
        if($request->user()->hasRole('admin')){
        
            $classes = Classes::join('annual_classes', 'annual_classes.class_id', '=', 'classes.id')->where('annual_classes.year_id', getYear())
            ->select('annual_classes.id as annual_class_id', 'classes.name', 'annual_classes.section_id')->get();

            $_data = Classes::join('annual_classes', 'annual_classes.class_id', '=', 'classes.id')->where('annual_classes.year_id', getYear())
                    ->join('class_fees', 'class_fees.class_id', '=', 'classes.id')
                    ->where('class_fees.year_id', getYear())->where('class_fees.type_id', 1)->distinct()
                    ->join('students_classes', 'students_classes.class_id', '=', 'annual_classes.id')
                    ;

            // dd($_data->get('annual_classes.*'));
            $expected = $_data->select('annual_classes.id as annual_class_id', DB::raw('SUM(class_fees.amount) as expected_sum, COUNT(*) as student_count'))->groupBy(['annual_class_id'])->get();
            $recieved = $_data->join('student_fee_payments', 'student_fee_payments.student_id', '=', 'students_classes.student_id')
                    ->where('student_fee_payments.year_id', getYear())->where('student_fee_payments.type_id', 1)
                    ->select('annual_classes.id as annual_class_id', DB::raw('SUM(student_fee_payments.amount) as paid'))->groupBy('annual_class_id')->get();
            $data['data'] = $classes->map(function($el)use($expected, $recieved){
                $el->expected = $expected->where('annual_class_id', $el->annual_class_id)->first()->expected_sum??0;
                $el->student_count = $expected->where('annual_class_id', $el->annual_class_id)->first()->student_count??0;
                $el->recieved = $recieved->where('annual_class_id', $el->annual_class_id)->first()->paid??0;
                return $el;
            });
            return view('dashboard.admin', $data);
        }else if($request->user()->hasRole('teacher')){
            return view('dashboard.teacher');
        }else if($request->user()->hasRole('parent')){
            return view('dashboard.parent');
        }else{
            return view('dashboard.admin');
        }

    }

}
