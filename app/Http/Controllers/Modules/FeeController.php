<?php


namespace App\Http\Controllers\Modules;

use anlutro\LaravelSettings\ArrayUtil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class FeeController extends Controller{

    public function index(Request $request){
        $data['fees'] = \App\StudentFeePayment::all();
        return view('fees.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('fees.show');
    }

    public function edit(Request $request, $slug){
        return view('fees.edit');
    }

    public function collect(Request $request){
        $data['student'] = \App\Student::whereSlug($request->student)->first();
        if(!$data['student']){
            abort(404);
        }
        return view('fees.create')->with($data);
    }

    public function collectSubmit(Request $request){
        return view('welcome');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create_fee')) {
            $this->validate($request, [
                'student' => 'required',
                'amount' => 'required|integer',
                'reference' => 'required',
                'method' =>'required',
                'year'=>'required',
                'type'=>'required'
            ]);
            \Auth::user()->collectFee($request);
            $request->session()->flash('success',"Fee Collected Successfully");
            return redirect(route('fee'));
        }else{
            return redirect()->back()->with(['error'=>'Not allowed to perform this action']);
        }

    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }

    public function classFee(Request $request){
        return view('fees.class');
    }

    public function classFeeUpdate(Request $request){
        $this->validate($request, [
            'class' => 'required',
        ]);
        foreach ($request->class as $id){
            $class = \App\Classes::find($id);
            foreach(\App\FeeType::get() as $t){
                $amount = $request->get("fee_".$id."_".$t->id, 0);
                $class->setFee($amount, $t->id);
            }
        }
        $request->session()->flash('success',"Successful");
        return redirect()->back();
    }

    public function type(){
        return view('fees.type');
    }

    public function typePost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $type = \App\FeeType::create($request->all());
        $request->session()->flash('success',"Successful");
        return redirect()->back();
    }

    public function owing(){
        $students = [];
        foreach(\App\Classes::get() as $class){
            foreach( $class->students(getYear()) as $student){
                if($student->dept(getYear()) > 0){
                    array_push($students, $student);
                }
            }
        }
        $data['students'] = $students;
        return view('fees.owing_student')->with($data);
    }

    public function student(Request $request){
        $student = [];
        if($request->action == 'scholarship'){
            $students = \App\Student::where('admission_year',0)->orderBy('created_at','DESC')->get();
            foreach(\App\Classes::get() as $class){
                foreach( $class->students(getYear()) as $student){
                    $students->push($student);
                }
            }
            $data['students'] = $students;
        }else{
            $students = \App\Student::where('admission_year',0)->orderBy('created_at','DESC')->get();
            foreach(\App\Classes::get() as $class){
                foreach( $class->students(getYear()) as $student){
                    if($student->dept(getYear()) > 0){
                        $students->push($student);
                    }
                }
            }
            $data['students'] = $students;
        }
        return view('fees.student')->with($data);
    }

    public function print(Request $request){
        if($request->action == 'print'){
            $student = \App\Student::whereSlug($request->student)->first();
            $data['title'] = $student->name."'s Fee Reciept for ".\App\Session::find(getYear())->name;
            $data['student'] = $student;
            $pdf = \PDF::loadView('template.fee', $data);
            return $pdf->download($student->name.'_fee.pdf');
        }else{
            $students = \App\Student::where('admission_year',0)->orderBy('created_at','DESC')->get();
            foreach(\App\Classes::get() as $class){
                foreach( $class->students(getYear()) as $student){
                    if($student->feePayment->count() > 0){
                        $students->push($student);
                    }
                }
            }
            $data['students'] = $students;
            return view('fees.student')->with($data);
        }
    }

    public function report(Request $request){
        if($request->action == 'print') {
            $data['title'] = "Fee Report";
            $data['fees'] = \App\StudentFeePayment::all();
            $pdf = \PDF::loadView('template.income', $data);
            return $pdf->download('_fee.pdf');
        }else{
            $data['fees'] = \App\StudentFeePayment::all();
            return view('fees.report')->with($data);
        }
    }

    public function scholarship(Request $request){
        $data['student'] = \App\Student::whereSlug($request->student)->first();
        if(!$data['student']){
            abort(404);
        }

            return view('fees.scholarship')->with($data);

    }

    public function scholarshipSave(Request $request){
        if ($request->user()->can('create_fee')) {
            $this->validate($request, [
                'student' => 'required',
                'amount' => 'required|integer',
            ]);
            \App\Student::find($request->student)->setScholarShip($request);
            $request->session()->flash('success',"Scholarship Saved Successfully");
            return redirect(route('fee.student')."?action=scholarship");
        }else{
            return redirect()->back()->with(['error'=>'Not allowed to perform this action']);
        }
    }

    public function scholarshipReport (Request $request){
        $data['fees'] =   \App\StudentDiscount::where('year_id',getYear())->get();
        $data['title'] =   "Scholarships";
        if($request->action == 'print'){
            $pdf = \PDF::loadView('template.scholarship', $data);
            return $pdf->download('Scholarship.pdf');
        }else {
            return view('fees.scholarship_report')->with($data);
        }
    }

    public function income(Request $request){
        $data['title'] =   "Income Statement";
        if($request->action == 'print'){
            $pdf = \PDF::loadView('template.income', $data);
            return $pdf->download('Income_report.pdf');
        }else {
            return view('fees.income')->with($data);
        }
    }

}
