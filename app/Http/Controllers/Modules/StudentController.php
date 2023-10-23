<?php


namespace App\Http\Controllers\Modules;

use App\AnnualClass;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentsClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class StudentController extends Controller{
    public function index(Request $request){
        $data['students'] =[];
        $year = $request->year?$request->year:getYear();
        $data['year'] = $year;
        if(!$request->class){
            $data['students'] = Student::join('students_classes', 'students_classes.student_id', '=', 'students_classes.student_id')
                        ->join('annual_classes', 'annual_classes.id', '=', 'students_classes.class_id')->where('annual_classes.year_id', $year)
                        ->select('students.*')->orderBy('created_at','DESC')->distinct()->paginate(100);
            // $data['students'] = \App\Student::orderBy('created_at','DESC')->distinct()->paginate(100);
        }else{
            $class = \App\AnnualClass::find(\request('class'));
            $data['students'] = $class->student()->paginate(100);
        }
        $data['class'] = \App\AnnualClass::find(\request('class'));
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

                \DB::commit();
                $request->session()->flash('success', __('text.student_saved_successfully'));
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', __('text.something_went_wrong'));
            }

        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
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
                $input['matricule'] = genMat($request->class, getYear());
                $student = \App\Student::create($input);

                 \App\StudentsClass::create([
                    'student_id'=> $student->id,
                    'class_id'=> getSection($request->class, getYear())->id
                ]);
                \DB::commit();
                $request->session()->flash('success', __('text.student_saved_successfully'));
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', __('text.something_went_wrong'));
            }

        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }
        return redirect()->to(route('student.index'));
    }
    public function destroy(Request $request, $id)
    {
        $year = $request->year ?? getYear();
        if ($request->user()->can('delete_student')) {
            $student = \App\Student::whereSlug($id)->first();
            if($student == null){
                abort(404);
            }
            // remove fee entries
            if($student->feePayment()->count() == 0 && $student->discount->count() == 0){
                $student->feePayment()->where('student_fee_payments.year_id', $year)->each(function($pmt){$pmt->delete();});
            }
            // remove student-class instances
            StudentsClass::where('student_id', $student->id)->each(function($row){$row->delete();});
            $student->delete();
            $request->session()->flash('success', __('text.student_deleted_successfully'));

        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }

        return redirect()->to(route('student.index'));
    }

    public function promote(Request $request){
        $students = new \App\Student();
        $year = getYear();
        if($request->year){
            $year = $request->year;
        }

        if($request->next_year){
            if($request->next_year < $year){
                $request->session()->flash('error', __('text.invalid_promotion_ay'));
            }
        }

        if($request->class){
            $students= \App\Classes::find($request->class)->students($year);
        }

        $data['students'] = $students;
        return view('student.promote')->with($data);
    }

    public function promoteSubmit(Request $request){
        $this->validate($request, [
            'class' => 'required',
            'students' => 'required',
            'year' => 'required',
            'next_year' => 'required',
        ]);
        try{
            $class = \App\Classes::find($request->class);
            $newClass = $class;
            $students = $newClass->parent->students($request->next_year);
           foreach ($request->students as $stud){
               $student = \App\Student::find($stud);
               if(!$this->isMember($student, $students)){
                   $s =  \App\StudentsClass::create([
                       'student_id'=> $student->id,
                       'class_id'=> getSection($newClass->next_class, $request->next_year)->id
                   ]);
               }
           }
           $request->session()->flash('success', __('text.student_promoted_successfully'));
           return redirect()->back();
        }catch(\Exception $e){
           
            $request->session()->flash('error', __('text.something_went_wrong'));
        }
    }

    public function changeClass(Request $request){
        return view('student.search');
    }

    public function isMember( $student, $students){
        $isMember = false;
        foreach($students as $stud){
            $isMember = $isMember || ($stud->student_id === $student->id);
        }
           
        return $isMember;
    }


    public function changeClassForm(Request $request, $student){
        $data['student'] = \App\Student::findOrFail($student);
        return view('student.changeClass')->with($data);
    }

    public function changeClassFormPost(Request $request, $student){
        $this->validate($request, [
            'class' => 'required_without:remove',
            'student' => 'required',
            'current_class' => 'required',
        ]);

        $student = \App\Student::findOrFail($student);
        // dd($request->all());
        try{
            \DB::beginTransaction();
            // $classR = $student->classR($student->sClass()->id);


            $current_student_classes = StudentsClass::join('students', 'students.id', '=', 'students_classes.student_id')->where('students.id', $request->student)
                ->join('annual_classes', 'annual_classes.id', '=', 'students_classes.class_id')->where('year_id', getYear())
                ->where('annual_classes.class_id', $request->current_class)->select('students_classes.*')->get();

                
          if(!isset($request->remove)){
              $studentClass = new \App\StudentsClass([
                'student_id'=> $student->id,
                'class_id'=> getSection($request->class, getYear())->id
                ]);
                $studentClass->save();
            }
            // delete current student class after inserting new class if required
            if($current_student_classes->count() > 1 && $studentClass->id != null){
                $current_student_classes->each(function($class){
                    $class->delete();
                });
            }



            \DB::commit();
            $request->session()->flash('success', __('text.student_migrated_successfully'));
        }catch(\Exception $e){
            \DB::rollback();
            //echo $e;
        $request->session()->flash('error', __('text.something_went_wrong'));
       }

         return redirect()->back();
    }
}
