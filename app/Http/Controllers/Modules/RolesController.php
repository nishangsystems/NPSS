<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller{

    public function index(){
        $data['roles'] = \App\Role::all();
        return view('roles.index')->with($data);
    }

    public function show(Request $request, $slug){
        return view('roles.show');
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('create_roles')){
            $this->validate($request, [
                'name' => 'required',
                'permissions' => 'required',
            ]);
            \DB::beginTransaction();
            try{
                $role = new \App\Role();
                $role->name = $request->name;
                $role->slug = str_replace(" ","_",strtolower($request->name));
                $role->save();

                foreach($request->permissions as $perm){
                    \DB::table('roles_permissions')->insert([
                        'role_id' => $role->id,
                        'permission_id'=>$perm,
                    ]);
                }
                \DB::commit();
                $request->session()->flash('success', $request->role.' '.__('text.saved_successfully'));
            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', $e->getMessage());
            }
        }else{
            $request->session()->flash('error', __('text.action_not_allowed'));
        }
        return redirect()->to(route('roles.index'));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            //Code goes here
        }
        return redirect()->to(route('roles.index'));
    }

    public function edit(Request $request, $slug){
        $data['role'] = \App\Role::whereSlug($slug)->first();
        if(!$data['role']){
            abort(404);
        }
        return view('roles.edit')->with($data);
    }

    public function create(Request $request){
        return view('roles.create');
    }


    public function update(Request $request, $slug){
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        \DB::beginTransaction();
        try{
            if($slug !== 'admin' || $slug !== 'teacher' || $slug !== 'parent'){
                $role = \App\Role::whereSlug($slug)->first();
                $role->name = $request->name;
                $role->save();
                foreach ($role->permissionsR as $pem){
                    $pem->delete();
                }
                foreach($request->permissions as $perm){
                    \DB::table('roles_permissions')->insert([
                        'role_id' => $role->id,
                        'permission_id'=>$perm,
                    ]);
                }
                \DB::commit();
                $request->session()->flash('success', $request->role.' '.__('text.saved_successfully'));
            }else{
                $request->session()->flash('error', __('text.cant_edit_this_role'));
            }
        }catch(\Exception $e){
            \DB::rollback();
            $request->session()->flash('error', $e->getMessage());
        }

        return redirect()->to(route('roles.index'));
    }


    public function permissions(Request $request){
        $data['permissions'] = [];
        if($request->role){
            $data['permissions'] = \App\Role::whereSlug($request->role)->first()->permissions;
        }else{
            $data['permissions'] = \App\Permission::all();
        }
        return view('roles.permissions')->with($data);
    }

    public function rolesView(Request $request){
        $data['user'] = \App\User::whereSlug(request('user'))->first();
        return view('roles.assign')->with($data);
    }

    public function rolesStore(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = \App\User::find($request->user_id);
        if(!$user->hasRole('admin')){
            $role = \App\Role::find($request->role_id);
            \DB::beginTransaction();
            try{
                if($user == null || $role == null){
                    abort(404);
                }

                foreach ($user->roleR as $r){
                    $r->delete();
                }
                \DB::table('users_roles')->insert([
                    'role_id' => $role->id,
                    'user_id'=>$user->id,
                ]);
                \DB::commit();
                $request->session()->flash('success', $request->role.' '.__('text.saved_successfully'));

            }catch(\Exception $e){
                \DB::rollback();
                $request->session()->flash('error', $e->getMessage());
            }
        }else{
            $request->session()->flash('error', __('text.cant_edit_this_role'));
        }
        return redirect()->to(route('user.index'));
    }
}
