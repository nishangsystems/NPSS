<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class FeeController extends Controller{

    public function index(Request $request){
        return view('fees.index');
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

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
