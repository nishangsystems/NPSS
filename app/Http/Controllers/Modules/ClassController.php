<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class ClassController extends Controller{

    public function index(Request $request){
        $data['class'] = \App\Classes::all();
        return view('class.class')->with($data);
    }

    public function section(Request $request, $id){
        $class = \App\Classes::find($id);
        if($class == null){
            $request->session()->flash('error',"Invalid Class");
            return redirect()->back();
        }
        $data['classes'] = $class->subClass;
        $data['class'] = $class;
        return view('class.section')->with($data);
    }

    public function show(Request $request, $slug){
        return view('class.show');
    }

    public function edit(Request $request, $slug){
        $data['class'] = \App\ClassSection::find($slug);
        return view('class.edit')->with($data);
    }

    public function update(Request $request, $slug){
        if ($request->user()->can('create_class')) {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $class = \App\ClassSection::find($slug);
            $class->name = $request->name;
            $class->save();

            $request->session()->flash('success', "Class Updated successfully");
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('class.section', $request->class));
    }

    public function store(Request $request){
        if ($request->user()->can('create_class')) {
            $this->validate($request, [
                'name' => 'required',
                'class'=> 'required',
            ]);

            $class = new \App\ClassSection();
            $class->name = $request->name;
            $class->class_id = $request->class;
            $class->save();

            $request->session()->flash('success', "Class Created successfully");
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('class.section', $request->class));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete_class')) {
            //Code goes here
        }
        $class = \App\ClassSection::find($id);
        $class->delete();
        return redirect()->to(route('class.index',$class->class_id))->with(['success'=>'Class Deleted Successfully']);
    }

    public  function teacher($id){
        $data['users'] = \App\ClassSection::find($id)->teachers(getYear());
        $data['class'] = \App\ClassSection::find($id);
        return view('class.teacher')->with($data);
    }

    public function Addteacher(Request $request, $id){

        $class = \App\Classes::find($id);
        if($class == null){
            $request->session()->flash('error',"Class Not Found");
            return redirect()->back();
        }

       if($request->action == 'add'){
           $this->validate($request, [
               'teacher' => 'required',
               'action' => 'required'
           ]);

           $class->addTeacher($request->teacher);
       }else{
           $this->validate($request, [
               'action' => 'required',
               'teacher' => 'required',
           ]);

           $class->removeTeacher($request->teacher);
       }
        $request->session()->flash('success',"Successful");
        return redirect()->back();
    }
}
