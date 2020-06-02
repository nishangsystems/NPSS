<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class SettingController extends Controller{

    public function session(Request $request){
        return view('setting.session');
    }

    public function sessionPost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
        $session = new \App\Session();
        $session->name = $request->name;
        $session->save();

        $request->session()->flash('success',"Session created successfully");
        return redirect()->to(route('settings.session'));
    }

    public function terms(Request $request){
        return view('setting.terms');
    }

    public function sequences(Request $request){
        return view('setting.sequences');
    }

    public function config(Request $request){
        $this->validate($request, [
            'year' => 'required',
        ]);

        setting(['current_year' => $request->year])->save();

        $request->session()->flash('success',"Current Academic Year Set Successfully");
        return redirect()->back();
    }

}
