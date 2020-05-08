<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder{

      public function run()
      {

            $faker = Faker\Factory::create();
            $date = new \DateTime();
            foreach(config('constants.ROLES') as $role){
                DB::table('roles')->insert([
                   'name' => $role,
                   'logged_by'=>1,
                   'slug' => strtolower($role),
                ]);
            }
      }
}
