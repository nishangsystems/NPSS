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
        $data['i']=1;
        $data['title'] = "All Subjects";
        if(\request('class')){
            $class = \App\Classes::find(\request('class'));
            if($class != null){
                $data['title'] = $class->name." Subjects";
                $data['i']=1;
                $data['subjects'] = $class->subjects();
            }
        }
        return view('subject.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('subject.show');
    }

    public function edit(Request $request, $slug){
        $data['subject'] = \App\Subject::whereSlug($slug)->first();
        return view('subject.edit')->with($data);
    }

    public function create(Request $request){
        return view('subject.create');
    }


    public function update(Request $request, $slug){
        if ($request->user()->can('create_subject')) {
            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'section' => 'required',
                'score' => 'required',
            ]);

            $subject = \App\Subject::whereSlug($slug)->first();
            $subject->name = $request->name;
            $subject->code = $request->code;
            $subject->score = $request->score;
            $subject->slug = str_replace('/','',$slug);
            $subject->section_id = $request->section;
            $subject->save();

            $request->session()->flash('success', __('text.subject_updated_successfully'));
        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }
        return redirect()->to(route('subject.index'));
    }

    public function store(Request $request) {
        if ($request->user()->can('create_subject')) {
            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'section' => 'required',
                'score' => 'required',
            ]);
            $date = new \DateTime();
            $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));

            $subject = new \App\Subject();
            $subject->name = $request->name;
            $subject->code = $request->code;
            $subject->score = $request->score;
            $subject->slug = $slug;
            $subject->section_id = $request->section;
            $subject->save();

            $request->session()->flash('success', __('text.subject_created_successfully'));
        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }
        return redirect()->to(route('subject.index'));
    }

    public function destroy(Request $request, $slug){
        if ($request->user()->can('create_subject')) {
            $subject = \App\Subject::whereSlug($slug)->first();
            $subject->delete();
            $request->session()->flash('success', __('text.subject_deleted_successfully'));
        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }
        return redirect()->to(route('subject.index'));
    }
}
