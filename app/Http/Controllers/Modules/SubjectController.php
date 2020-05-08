<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class SubjectController extends Controller{

    public function index(){
        $data['subjects'] = \App\Subject::all();
        return view('subject.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('subject.show');
    }

    public function edit(Request $request, $slug){
        return view('subject.edit');
    }

    public function create(Request $request){
        return view('subject.create');
    }


    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
