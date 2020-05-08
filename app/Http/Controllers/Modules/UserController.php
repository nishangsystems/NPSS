<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserController extends Controller{

    public function index(){
        if(\request('type') == 'teacher'){
            $data['users'] = \App\Role::whereSlug('teacher')->first()->users;
            return view('users.teacher')->with($data);
        }else if(\request('type') == 'parent'){
            $data['users'] = \App\Role::whereSlug('parent')->first()->users;
            return view('users.parent')->with($data);
        }else{
            $data['users'] = \App\User::all();
            return view('users.index')->with($data);
        }

    }

    public function show(Request $request, $slug){
        if(\request('type') == 'teacher'){
            return view('users.show_teacher');
        }else{
            return view('users.show_parent');
        }
    }

    public function edit(Request $request, $slug){
        if(\request('type') == 'teacher'){
            return view('users.edit_teacher');
        }else{
            return view('users.edit_parent');
        }
    }

    public function create(Request $request){
        if(\request('type') == 'teacher'){
            return view('users.create_teacher');
        }else{
            return view('users.create_parent');
        }
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
