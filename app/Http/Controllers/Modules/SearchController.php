<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class SearchController extends Controller{

    public function student(Request $request){
        $param = $request->param;
        $data = \App\Student::where('name', 'like', '%'.$param.'%')
            ->orWhere('email', 'like', '%'.$param.'%')
            ->paginate(30);
        return response()->json([
            'success' => '200',
            'data' =>Student::collection($data)
        ]);
    }

    public function pupil(Request $request){
        $year = getYear();
        if($request->year){
            $year = $request->year;
        }
        $students = [];
        foreach(\App\Classes::get() as $class){
            foreach( $class->students($year) as $student){
                array_push($students, $student);
            }
        }
        $data['students'] = $students;
        $data['year'] = $year;
        return view('student_parent')->with($data);
    }


    public function student_fee(Request $request){
        $param = $request->param;
        $year = getYear();
        $data = \App\Student::where('name', 'like', '%'.$param.'%')
            ->orWhere('email', 'like', '%'.$param.'%')
            ->paginate(30)->map(function($el)use($year){
                $el->class = ($el->sClass())?$el->sClass()->class->byLocale()->name:'';
                $el->paid = $el->totalPaid($year) < 0?0:$el->totalPaid($year);
                $el->debt = $el->dept($year);
                $el->scholarship = $el->scholarship($year);
                $el->print_link = route('fee.print')."?student=$el->slug&action=print";
                $el->collect_link = route('fee.collect')."?student=$el->slug";
                $el->scholarship_link = route('fee.scholarship')."student=$el->slug";
                return $el;
            });
        return response()->json(['data'=>$data->toArray()]);
    }
}
