<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class TransportController extends Controller{

    public function index(){
        return view('transport.index');
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

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
