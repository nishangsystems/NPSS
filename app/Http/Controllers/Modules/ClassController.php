<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ClassController extends Controller{

    public function index(Request $request){
        $data['class'] = \App\Classes::all();
        return view('class.class')->with($data);
    }

    public function create(Request $request){
        return view('class.create');
    }

    public function section(Request $request, $id){
        $class = \App\Classes::find($id);
        $year = $request->year?$request->year:getYear();

        if($class == null){
            $request->session()->flash('error',"Invalid Class");
            return redirect()->back();
        }

        $data['classes'] = $class->subClass($year);
        $data['clas'] = $class;
        $data['year'] =  $year;
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
                'limit' => 'required',
            ]);

            $class = \App\Classes::find($slug);
            $class->name = $request->name;
             $class->limit = $request->limit;
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
                'section_id'=> 'nullable',
                'limit' => 'required',
                'abbreviations' => 'required',
            ]);
              $class = \App\Classes::create([
                   'name' => $request->name,
                    'section_id'=> $request->section_id,
                    'limit' => $request->limit,
                    'abbreviations' => $request->abbreviations,
               ]);

               $request->session()->flash('success', "Class Created successfully");
               return redirect()->to(route('class.section', $class->id));
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
      return redirect()->back();
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
        $data['users'] = \App\AnnualClass::find($id)->teacher;
        $data['class'] = \App\AnnualClass::find($id);
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
