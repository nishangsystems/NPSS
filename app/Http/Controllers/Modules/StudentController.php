<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class StudentController extends Controller{

    public function index(){
        $data['students'] = \App\Student::all();
        return view('student.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('student.show');
    }

    public function edit(Request $request, $slug){
        return view('student.edit');
    }

    public function create(Request $request){
        return view('student.create');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
