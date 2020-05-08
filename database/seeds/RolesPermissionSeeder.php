<?php

use Illuminate\Database\Seeder;

class RolesPermissionSeeder extends Seeder{

      public function run()
      {

            $faker = Faker\Factory::create();
            $date = new \DateTime();
            foreach(\App\Permission::all() as $permission){
                DB::table('roles_permissions')->insert([
                   'role_id' => 1,
                   'permission_id'=>$permission->id,
                ]);
            }
      }
}
