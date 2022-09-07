<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use \Carbon\Carbon;

class ExpensesController extends Controller{


    public function typePost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $type = \App\ExpenceType::create($request->all());
        $request->session()->flash('success',"Successful");
        return redirect()->back();
    }

    public function type(){
        return view('expenses.type');
    }

    public function deleteType(Request $request){
        $request->session()->flash('success',"Successful");
        return redirect()->back();
    }

    public function index(Request $request){
        $data = [];
        if($request->daterange){
            $daterange = str_replace(' ','',$request->daterange);
            $daterange = explode('-', $daterange);
            $start = $daterange[0];
            $end = $daterange[1];
            $start = Carbon::createFromFormat('m/d/Y',  $start)->toDateTimeString();
            $end = Carbon::createFromFormat('m/d/Y',  $end)->toDateTimeString();
            $data['expenses'] = \App\Expenses::where('created_at','>',$start)
                                                ->where('created_at','<=',$end)->get();
            $data['title'] = "All Expenses from ".$daterange[0]." to ".$daterange[1];
        }else{
            $data['title'] = "All Expenses recent expenses";
            $data['expenses'] = \App\Expenses::orderBY('created_at', 'DESC')->paginate(40);
        }

        return view('expenses.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('expenses.show');
    }

    public function edit(Request $request, $id){
        $data['expense'] = \App\Expenses::findOrFail($id);
        return view('expenses.edit')->with($data);
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
                'expense_id' => 'required',
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

    public function update(Request $request, $id){
        if ($request->user()->can('update_fee')) {
            $this->validate($request, [
                'amount' => 'required',
                'date' => 'required',
                'motive' => 'required',
                'status' => 'required',
                'expense_id' => 'required',
            ]);
            $expense = \App\Expenses::findOrFail($id);
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->motive = $request->motive;
            $expense->status = $request->status;
            $expense->expense_id = $request->expense_id;
            $expense->save();


            $request->session()->flash('success', "Expense Updated successfully");
        }else{
            $request->session()->flash('error', "Cant perform this action");
        }
        return redirect()->to(route('expenses'));
    }

    public function destroy(Request $request)
    {
        if ($request->user()->can('delete_fee')) {
            $expense = \App\Expenses::findOrFail($request->id);
            $expense->delete();
                return redirect()->to(route('expenses'))->with(['success'=>'Expense Deleted Successfully']);
        }else{
            $request->session()->flash('error', "Cant perform this action");
            return redirect()->to(route('expenses'));
     }

    }
}
