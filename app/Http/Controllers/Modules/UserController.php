<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserController extends Controller{

    public function index(){
        if(\request('type') == 'teacher'){
            $data['users'] = \App\Role::whereSlug('teacher')->first()->users;
            return view('users.teacher')->with($data);
        }else if(\request('type') == 'parent'){
            $data['users'] = \App\Role::whereSlug('parent')->first()->users;
            return view('users.parent')->with($data);
        }else{
            if(\request('role')){
                $data['users'] =\App\Role::whereSlug(\request('role'))->first()->users;
                return view('users.index')->with($data);
            }else if(\request('permission')){
                $data['users'] =\App\Permission::whereSlug(\request('permission'))->first()->users;
                return view('users.index')->with($data);
            }else{
                $data['users'] = \App\User::all();
                return view('users.index')->with($data);
            }
        }

    }

    public function show(Request $request, $slug){
        $data['user'] = \App\User::whereSlug($slug)->first();
        if(!$data['user']){
            abort(404);
        }
        return view('users.show_parent')->with($data);
    }

    public function edit(Request $request, $slug){

        $user = \App\User::whereSlug($slug)->first();
        if(!$user){
            abort(404);
        }


        $data['user'] = $user;
        return view('users.edit')->with($data);
    }

    public function create(Request $request){
            return view('users.create');
    }

    public function update(Request $request, $slug){
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'username'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jpg|max:1024',
        ]);

        $user = \App\User::whereSlug($slug)->first();
        if(!$user){
            abort(404);
        }

        if($request->file('image')!=null){
            $image = explode('/', $request->image->store('files'))[1];
            $user->photo = $image;
        }
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->email = $request->username;
        $user->phone = $request->phone;
        $user->save();

        $request->session()->flash('success', "Account Updated successfully");
        $data['user'] = $user;
        return view('users.show_parent')->with($data);
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create_user')) {
            $this->validate($request, [
                'name' => 'required',
                'gender' => 'required',
                'address' => 'nullable',
                'username' =>'required|unique:users,email',
                'phone' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jpg|max:1024',
                'type'=>'required'
            ]);

            $role = \App\Role::whereSlug($request->type)->first();
            if($role == null){
                $request->session()->flash('error', "Invalid Role");
            }else{

                if($request->file('image')!=null){
                    $image = explode('/', $request->image->store('files'))[1];
                    $input['photo'] = $image;
                }
                $date = new \DateTime();
                $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));
                $input = $request->all();
                $input['slug'] = str_replace("/","",$slug);
                $input['email'] =$request->username;

                $input['password'] = \Hash::make("12345678");
                $user = \App\User::create($input);

                \DB::table('users_roles')->insert([
                    'user_id' => $user->id,
                    'role_id'=>$role->id
                ]);
            }

            $request->session()->flash('success', "User Created successfully");
        }else{
            $request->session()->flash('error', "Not allowed to perform this action");
        }
        return redirect()->to(route('user.index')."?type=".$request->type);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'))->with(['success'=>'Roles Created Successfully']);
    }

    public function parentAssign(Request $request, $slug){
        $user = \app\User::whereSlug($slug)->first();
        if($user == null){
            abort(404);
        }
        $data['user'] = $user;
        return view('users.assign')->with($data);
    }

    public function parentAssignPost(Request $request, $slug){
        $this->validate($request, [
            'student_id' => 'required',
            'parent_id' => 'required',
        ]);

        $studentGuardient = \App\StudentsGuardient::create([
            'student_id'=>$request->student_id,
            'parent_id'=>$request->parent_id
        ]);
        $request->session()->flash('success', "Student Assign to parent Successfully");
        return redirect()->to(route('user.index'));
    }

    public function password(Request $request){
        return view('users.password');
    }
    public function passwordPost(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:5',
        ]);

        if(\Hash::check($request->old_password, \Auth::user()->password)){
            $user = \Auth::user();
            $user->password = \Hash::make($request->password);
            $user->save();

            $request->session()->flash('success', "Password changed successfully");
            return redirect(route('home'));
        }else{
            $request->session()->flash('error', "Invalid old password");
            return redirect()->back()->withInput();
        }

    }
}
