<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:user', ['except'=>['logout']]);
    }

    public function showLoginForm(){
        return view('auth.login');
    }


    public function login(Request $request){
        //validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //Attempt to log the user in
        if( Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){

        }
        $request->session()->flash('error', 'Invalid Email or Password');
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout(Request $request){
        Auth::guard('user')->logout();
        return redirect(route('home'));
    }
}
