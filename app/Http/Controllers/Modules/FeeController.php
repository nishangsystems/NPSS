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
        return view('fees.create');
    }

    public function collectSubmit(Request $request){
        return view('welcome');
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
