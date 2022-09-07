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


}
