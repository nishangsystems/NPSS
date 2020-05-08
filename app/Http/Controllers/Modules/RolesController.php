<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class RolesController extends Controller{

    public function index(Request $request){
        $data['roles'] = \App\Role::all();
        return view('roles.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('roles.show');
    }

    public function edit(Request $request, $slug){
        return view('roles.edit');
    }

    public function create(Request $request){
        return view('roles.create');
    }


    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
