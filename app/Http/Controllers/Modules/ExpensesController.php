<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use \Carbon\Carbon;

class ExpensesController extends Controller{

    public function index(Request $request){
        $data = [];
        if($request->daterange){
            $daterange = str_replace(' ','',$request->daterange);
            $daterange = explode('-', $daterange);
            $start = $daterange[0];
            $end = $daterange[1];
            $start = Carbon::createFromFormat('d/m/Y',  $start)->toDateTimeString();
            $end = Carbon::createFromFormat('d/m/Y',  $end)->toDateTimeString();
            $data['expenses'] = \App\Expenses::where('created_at','>',$start)
                                                ->where('created_at','<=',$end)->get();

        }else{
            $data['expenses'] = \App\Expenses::orderBY('created_at', 'DESC')->paginate(40);
        }

        return view('expenses.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('expenses.show');
    }

    public function edit(Request $request, $slug){
        return view('expenses.edit');
    }

    public function new(Request $request){
        return view('expenses.create');
    }

    public function newSubmit(Request $request){
        if ($request->user()->can('create_fee')) {
            $this->validate($request, [
                'amount' => 'required',
                'date' => 'required',
                'motive' => 'required',
                'status' => 'required',
            ]);

            $input = $request->all();
            $input['user_id'] =\Auth::user()->id;
            $student = \App\Expenses::create($input);

            $request->session()->flash('success', "Expense Created successfully");
        }else{
            $request->session()->flash('error', "Cant perform this action");
        }
        return redirect()->to(route('expenses'));
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }
}
