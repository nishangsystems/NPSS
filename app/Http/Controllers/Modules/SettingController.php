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

        $request->session()->flash('success',__('text.session_created_successfully'));
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
            'sequence' => 'required',
        ]);

        setting(['current_year' => $request->year])->save();
        setting(['current_term' => $request->sequence])->save();

        $request->session()->flash('success', __('text.current_ay_set_successfully'));
        return redirect()->back();
    }

}
