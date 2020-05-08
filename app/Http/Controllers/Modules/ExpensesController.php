<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class ExpensesController extends Controller{

    public function index(Request $request){
        return view('expenses.index');
    }

    public function show(Request $request, $slug){
        return view('expenses.show');
    }

    public function edit(Request $request, $slug){
        return view('expenses.edit');
    }

    public function new(Request $request){
        return view('expenses.create');
    }

    public function newSubmit(Request $request){
        return view('welcome');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function delete(Request $request, $slug){
        return view('welcome');
    }
}
