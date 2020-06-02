<?php


namespace App\Http\Controllers\Modules;

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
        $data['students'] = [];
        foreach(\App\Classes::get() as $class){
            foreach( $class->students(getYear()) as $student){
                array_push($data['students'],$student);
            }
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
        return view('fees.student')->with($data);
    }
}
