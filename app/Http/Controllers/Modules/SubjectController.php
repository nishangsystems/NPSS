<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class SubjectController extends Controller{

    public function index(){
        $data['subjects'] = \App\Subject::all();
        $data['title'] = "All Subjects";
        if(\request('class')){
            $class = \App\Classes::find(\request('class'));
            if($class != null){
                $data['title'] = $class->name." Subjects";
                $data['subjects'] = $class->subjects();
            }
        }
        return view('subject.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('subject.show');
    }

    public function edit(Request $request, $slug){
        return view('subject.edit');
    }

    public function create(Request $request){
        return view('subject.create');
    }


    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request) {
        if ($request->user()->can('create_subject')) {
            $this->validate($request, [
                'name' => 'required',
                'type' => 'nullable',
                'code' => 'required',
                'section' => 'required',
                'score' => 'required',
            ]);
            $date = new \DateTime();
            $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));

            $subject = new \App\Subject();
            $subject->name = $request->name;
            $subject->type = $request->type;
            $subject->code = $request->code;
            $subject->score = $request->score;
            $subject->slug = $slug;
            $subject->section_id = $request->section;
            $subject->save();

            $request->session()->flash('success', "Subject Created successfully");
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('subject.index'));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }
}
