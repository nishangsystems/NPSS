<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class StudentController extends Controller{

    public function genMat($class, $year){
        $class = \App\Classes::find($class);
        $count = $class->students($year)->count();
        return $class->abbreviations.$count.$this->getSection($class->id, $year);
    }

    public function getSection($class, $year){
        $class = \App\Classes::find($class);
        $sections = ['A','B','C','D','E','F'];
        $count = $class->students($year)->count();
        $position = ($count - ($count % $class->limit))/$class->limit;
        if($position > 5){
            return $sections[5];
        }else{
            return $sections[$position];
        }
    }

    public function index(Request $request){
        $data['students'] =[];
        $data['year'] = $request->year?$request->year:getYear();
        if(!$request->class){
            $data['students'] = \App\Student::orderBy('created_at','DESC')->get();
        }else{
            $class = \App\ClassSection::find(\request('class'));
            $data['students'] = $class->students($data['year']);
        }
        return view('student.index')->with($data);
    }

    public function show(Request $request, $slug){
        $data['student'] = \App\Student::whereSlug($slug)->first();
        $data['year'] = $request->year?$request->year:getYear();
        if($data['student'] == null){
            abort(404);
        }
        return view('student.show')->with($data);
    }
    public function edit(Request $request, $slug){
        $data['student'] = \App\Student::whereSlug($slug)->first();
        if($data['student'] == null){
            abort(404);
        }
        return view('student.edit')->with($data);
    }
    public function create(Request $request){
        return view('student.create');
    }
    public function update(Request $request, $slug){
        if (\Auth::user()->can('create_student')) {
            $this->validate($request, [
                'name' => 'required',
                'gender' => 'required',
                'dob' => 'nullable',
                'address' => 'nullable',
                'email' => 'nullable|email',
                'class' => 'nullable',
                'section' => 'nullable',
                'admission_year' => 'required',
                'phone' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jpg|max:1024'
            ]);
            $student = \App\Student::whereSlug($slug)->first();
            $image = $student->photo;
            if($request->file('image')!=null){
                $image = explode('/', $request->image->store('files'))[1];
            }

            try{
                \DB::beginTransaction();
                $student->photo = $image;
                $student->name = $request->name;
                $student->gender = $request->gender;
                $student->dob = $request->dob;
                $student->address = $request->address;
                $student->email = $request->email;
                $student->phone = $request->phone;
                $student->save();

                $class = \App\Classes::find($student->class);
                $classR = $student->classR($request->admission_year);
                $classR->delete();
                $studentClass = \App\StudentsClass::create([
                    'student_id'=> $student->id,
                    'class_id'=> $student->class,
                    'year_id'=> $request->admission_year,
                    'section_id'=> $this->getSection($request->class, getYear()),
                ]);
                \DB::commit();
                $request->session()->flash('success', "Student updated successfully");
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', "Something went wrong");
            }

        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('student.index'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create_student')) {
            $this->validate($request, [
                'name' => 'required',
                'gender' => 'required',
                'dob' => 'nullable',
                'address' => 'nullable',
                'email' => 'nullable|email',
                'class' => 'nullable',
                'admission_year' => 'required',
                'phone' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jpg|max:1024'
            ]);

            $image = "";
            if($request->file('image')!=null){
                $image = explode('/', $request->image->store('files'))[1];
            }
            try{
                \DB::beginTransaction();
                $date = new \DateTime();
                $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));
                $input = $request->all();
                $input['slug'] = str_replace("/","",$slug);
                $input['photo'] = $image;
                $input['matricule'] = $this->genMat($request->class, getYear());
                $student = \App\Student::create($input);
                $class = \App\Classes::find($student->class);
                $studentClass = \App\StudentsClass::create([
                    'student_id'=> $student->id,
                    'class_id'=> $student->class,
                    'year_id'=> $request->admission_year,
                    'section_id'=> $this->getSection($request->class, getYear()),
                ]);
                \DB::commit();
                $request->session()->flash('success', "Student Created successfully");
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', "Something went wrong");
            }

        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('student.index'));
    }
    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete_student')) {
            $student = \App\Student::whereSlug($id)->first();
            if($student == null){
                abort(404);
            }
           if($student->feePayment->count() == 0 ){
               $student->delete();
               $request->session()->flash('success', "Student Deleted successfully");
           }else{
               $request->session()->flash('error', "Cant Delete Student, has some transaction saved");
           }

        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }

        return redirect()->to(route('student.index'));
    }
}
