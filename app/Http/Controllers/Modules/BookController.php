<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class BookController extends Controller{

    public function index(Request $request){
        return view('books.index');
    }

    public function show(Request $request, $slug){
        return view('books.show');
    }

    public function edit(Request $request, $slug){
        return view('books.edit');
    }

    public function create(Request $request){
        return view('books.create');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }

    public function destroy(Request $request, $id)
    {

        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }
}
