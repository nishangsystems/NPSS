<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class ClassController extends Controller{

    public function index(Request $request){
        $data['class'] = \App\Classes::all();
        return view('class.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('class.show');
    }

    public function edit(Request $request, $slug){
        return view('class.edit');
    }

    public function create(Request $request){
        return view('class.create');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
