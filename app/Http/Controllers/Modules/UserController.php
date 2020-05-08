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
            return view('users.teacher');
        }else{
            return view('users.parent');
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
