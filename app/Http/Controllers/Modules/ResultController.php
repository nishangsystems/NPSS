<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller{
    public function student(Request $request, $id){
        $data = [];
        if(\Auth::user()->hasRole('parent')){
            $data['class'] = null;
            $data['students'] = \Auth::user()->students;
        }elseif(\Auth::user()->hasRole('teacher')){
            $subClass = \Auth::user()->class(getYear());
            if($subClass == null){
                $request->session()->flash('error',"You have Being assigned to no class, contact admin");
                return redirect()->back();
            }else{
                $data['class'] = $subClass;
                $data['students'] = $subClass->students(getYear());
            }
        }else{
            $subClass = \App\ClassSection::find($id);
            if($subClass == null){
                abort(404);
            }
            $data['class'] = $subClass;
            $data['students'] = $subClass->students(getYear());
        }
        return view('result.student')->with($data);
    }

    public function studentPost(Request $request, $id){
        $data['students'] = [];
        $subClass = \App\ClassSection::find($id);
        $data['class'] = $subClass;
        $data['students'] = $subClass->students($request->get('year'));
        return view('result.student')->with($data);
    }

    public function class(Request $request){
        $data['classes'] = \App\Classes::all();
        return view('result.class')->with($data);
    }

    public function subClass(Request $request, $id){
        $data = [];

        if(\Auth::user()->hasRole('teacher')){
            $data['classes'] = \Auth::user()->class(getYear());
        }else{
            $class = \App\Classes::find($id);
            $data['classes'] = $class->subClass;
        }
        return view('result.subclass')->with($data);
    }

    public function result(Request $request, $slug){
        $student = \App\Student::whereSlug($slug)->first();
        if($student == null){
            $request->session()->flash('error',"Invalid URL");
            return redirect()->back();
        }
        $class = $student->class(getYear());
        if($class == null){
            $request->session()->flash('error',"Student was not part of this session");
            return redirect()->back();
        }
        $data['student'] = $student;
        $data['year'] = \App\Session::find(getYear());
        $data['class'] = $class;
        if($request->action == 'print'){
            $data['title'] = $student->name.' Result';
            if($class->section->id == 1){
                $pdf = \PDF::loadView('template.nusery_report', $data);
               // return view('template.nusery_report')->with($data);
                return $pdf->download($student->name.'_result.pdf');
            }else{
                $pdf = \PDF::loadView('template.primary_report', $data);
                return view('template.primary_report')->with($data);
              // return $pdf->download($student->name.'_result.pdf');
            }
        }else{
            if($class->section->id == 1){
                return view('result.nusery_report_card')->with($data);
            }else{
                return view('result.primary_report_card')->with($data);
            }
        }
    }

    public function resultPost(Request $request, $slug){
        $student = \App\Student::whereSlug($slug)->first();
        if($student == null){
            $request->session()->flash('error',"Invalid URL");
            return redirect()->back();
        }
        $class = $student->class($request->get('session'));
        if($class == null){
            $request->session()->flash('error',"Student was not part of this session");
            return redirect()->back();
        }
        $data['student'] = $student;
        $data['year'] = \App\Session::find($request->get('session'));
        $data['class'] = $class;
        if($class->section->id == 1){
            return view('result.nusery_report_card')->with($data);
        }else{
            return view('result.primary_report_card')->with($data);
        }
    }


    public function edit(Request $request, $slug){
        $student = \App\Student::whereSlug($slug)->first();
        if($student == null){
            $request->session()->flash('error',"Invalid URL");
            return redirect()->back();
        }
        $data['student'] = $student;
        if($request->sequence && $request->year){
            $class = $student->class($request->year);
            if($class == null){
                $request->session()->flash('error',"Student was not part of this session");
                return redirect()->back();
            }
            $data['year'] = \App\Session::find($request->year);
            $data['seq'] = \App\Sequence::find($request->sequence);
            $data['class'] = $class;

        }else{
            $class = $student->class(getYear());
            if($class == null){
                $request->session()->flash('error',"Student was not part of this session");
                return redirect()->back();
            }
            $data['year'] = \App\Session::find(getYear());
            $data['seq'] = \App\Sequence::get()->first();
            $data['class'] = $class;
        }
        if($class->section->id == 1){
            return view('result.edit_nusery')->with($data);
        }else{
            return view('result.edit_primary')->with($data);
        }
    }

    public function editPost(Request $request, $slug){
        $this->validate($request, [
            'year' => 'required',
            'sequence' => 'required',
            'student' => 'required',
        ]);

        $student = \App\Student::find($request->student);
        if($student == null){
            $request->session()->flash('error',"Invalid URL");
            return redirect()->back();
        }

        $class = $student->class($request->get('year'));
        if($class == null){
            $request->session()->flash('error',"Student was not part of this session");
            return redirect()->back();
        }

        if($class->section->id == 1){
            foreach(\App\Section::find(1)->subjects as $subject) {
                $student->saveResult($request->year, $request->sequence,$subject->id, $request->get('mark'.$subject->id));
            }
        }else{
            foreach(\App\Section::find(2)->subjects as $subject) {
                $student->saveResult($request->year, $request->sequence,$subject->id, $request->get('mark'.$subject->id));
            }
        }

        $request->session()->flash('success',"Result Inserted Successfully");
        return redirect(route('result.session', $student->slug));
    }

}
