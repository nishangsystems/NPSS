<?php

use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder{

      public function run()
      {

            $faker = Faker\Factory::create();
            $date = new \DateTime();
            foreach(\App\Permission::all() as $permission){
                DB::table('users_permissions')->insert([
                   'user_id' => 1,
                   'permission_id'=>$permission->id,
                ]);
            }
      }
}
