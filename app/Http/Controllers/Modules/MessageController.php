<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Messages;
use App\SMS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MessageController extends Controller{

    public function index(Request $request){
        return view('message.index');
    }

    public function create(Request $request){
        $data['action'] = $request->action;
        $data['title'] = $request->title;
        $data['amount'] = $request->amount;
        $data['message'] = $request->message;
        $data['year'] = $request->year;
        $data['contact'] = __('text.no_matching_contact_found');
        return view('message.create')->with($data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'amount' => 'required',
            'message' => 'required',
            'year' => 'required',
            'contact'=>'required'
        ]);
        $data['action'] = $request->action;
        $data['contact'] = __('text.no_matching_contact_found');
        if($request->action == 'send'){
            $message = new SMS();
            $message->sender_id = \Auth::user()->id;
            $message->title = $request->title;
            $message->message = $request->message;
            $message->contacts = $request->contact;





            $message->save();
            $request->session()->flash('success', __('text.message_successfully_sent'));
            return redirect(route('message.index'));
        }else{
            $students = [];
            foreach(\App\Classes::get() as $class){
                foreach( $class->students($request->year) as $student){
                    if($student->dept($request->year) >= $request->amount){
                       if($student->parent() != null){
                           array_push($students, $student->parent()->phone);
                       }elseif($student->phone){
                           array_push($students, $student->phone);
                       }
                    }
                }
            }

            $input = $request->all();
            if(count($students) == 0){
                $data = array_merge($data, $input);
                $data['contact'] = __('text.no_matching_contact_found');
            }else{
                $data = array_merge($data, $input);
                $data['contact'] = json_encode($students);
                $data['action'] = 'send';
            }

            return view('message.create')->with( $data);
        }

    }

}
