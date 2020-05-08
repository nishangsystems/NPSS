<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MessageController extends Controller{

    public function index(Request $request){
        return view('message.index');
    }

    public function create(Request $request){
        return view('message.create');
    }

}
