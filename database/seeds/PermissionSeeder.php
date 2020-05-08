<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder{

      public function run()
      {

            $faker = Faker\Factory::create();
            $date = new \DateTime();
            foreach(config('constants.PERMISSION_GROUPS') as $group){
                if($group['id'] >= 2){
                    DB::table('permissions')->insert([
                       'name' => 'Select '.$group['name'],
                       'slug' =>  strtolower('Select_'.$group['name']),
                    ]);

                    DB::table('permissions')->insert([
                       'name' => 'Create '.$group['name'],
                       'slug' =>  strtolower('Create_'.$group['name']),
                    ]);
                    DB::table('permissions')->insert([
                       'name' => 'Update '.$group['name'],
                       'slug' =>  strtolower('Update_'.$group['name']),
                    ]);
                    DB::table('permissions')->insert([
                       'name' => 'Delete '.$group['name'],
                       'slug' =>  strtolower('Delete_'.$group['name']),
                    ]);
                }else{
                    foreach(config('constants.COMMON_PERMISSION') as $pem){
                        DB::table('permissions')->insert([
                           'name' => $pem." ".$group['name'],
                           'slug' =>  strtolower($pem."_".$group['name']),
                        ]);
                    }
                }
            }

      }
}
