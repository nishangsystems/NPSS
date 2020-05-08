<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder{

      public function run()
      {

            $faker = Faker\Factory::create();
            $date = new \DateTime();
            foreach(config('constants.PERMISSION_GROUPS') as $group){
                if($group['id'] >= 2){
                    DB::table('permission')->insert([
                       'name' => 'Select '.$group['name'],
                       'slug' =>  strtolower('Select_'.$group['name']),
                       'permission_group_id' => $group['id'],
                    ]);

                    DB::table('permission')->insert([
                       'name' => 'Create '.$group['name'],
                       'slug' =>  strtolower('Create_'.$group['name']),
                       'permission_group_id' => $group['id'],
                    ]);
                    DB::table('permission')->insert([
                       'name' => 'Update '.$group['name'],
                       'slug' =>  strtolower('Update_'.$group['name']),
                       'permission_group_id' => $group['id'],
                    ]);
                    DB::table('permission')->insert([
                       'name' => 'Delete '.$group['name'],
                       'slug' =>  strtolower('Delete_'.$group['name']),
                       'permission_group_id' => $group['id'],
                    ]);
                }else{
                    foreach(config('constants.COMMON_PERMISSION') as $pem){
                        DB::table('permission')->insert([
                           'name' => $pem." ".$group['name'],
                           'slug' =>  strtolower($pem."_".$group['name']),
                           'permission_group_id' => $group['id'],
                        ]);
                    }
                }
            }

      }
}
