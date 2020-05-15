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
        if(\request('type') == 'teacher'){
            return view('users.show_teacher')->with($data);
        }else{
            return view('users.show_parent')->with($data);
        }
    }

    public function edit(Request $request, $slug){
        if(\request('type') == 'teacher'){
            return view('users.edit_teacher');
        }else{
            return view('users.edit_parent');
        }
    }

    public function create(Request $request){
            return view('users.create');
    }

    public function update(Request $request, $slug){
        return view('welcome');
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create_user')) {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'email' =>'required|unique:users,email',
                'phone' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,jpg|max:1024',
                'type'=>'required'
            ]);



            $role = \App\Role::whereSlug($request->type)->first();
            if($role == null){
                $request->session()->flash('error', "Invalid Role");
            }else{
                $image = "";
                if($request->file('image')!=null){
                    $image = explode('/', $request->image->store('files'))[1];
                }

                $date = new \DateTime();
                $slug = \Hash::make($request->name.$date->format('Y-m-d H:i:s'));
                $input = $request->all();
                $input['slug'] = str_replace("/","",$slug);
                $input['photo'] = $image;
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
}
