<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class StudentController extends Controller{

    public function index(){
        $data['students'] = \App\Student::all();
        return view('student.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('student.show');
    }

    public function edit(Request $request, $slug){
        return view('student.edit');
    }

    public function create(Request $request){
        return view('student.create');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create_student')) {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'email' => 'nullable|email',
                'class' => 'required',
                'section' => 'required',
                'admission_year' => 'required',
                'phone' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,jpg|max:1024'
            ]);

            $image = "";
            if($request->file('image')!=null){
                $image = explode('/', $request->image->store('files'))[1];
            }

            $date = new \DateTime();
            $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));
            $input = $request->all();
            $input['slug'] = str_replace("/","",$slug);
            $input['photo'] = $image;
            $student = \App\Student::create($input);

            $request->session()->flash('success', "Student Created successfully");
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('student.index'));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete_student')) {
            //Code goes here
        }
        return redirect()->to(route('student.index'));
    }
}
