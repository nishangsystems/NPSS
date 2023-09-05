<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class TransportController extends Controller{

    public function index(){
        $data['transports'] = \App\Transport::all();
        return view('transport.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('transport.show');
    }

    public function edit(Request $request, $slug){
        return view('transport.edit');
    }

    public function create(Request $request){
        return view('transport.create');
    }


    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>__('text.roles_created_successfully')]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>__('text.roles_created_successfully')]);
    }
}
