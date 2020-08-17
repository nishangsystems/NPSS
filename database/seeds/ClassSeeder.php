<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder{

      public function run()
      {
          $faker = Faker\Factory::create();
          foreach(\App\Section::get() as $sec){
              $name = explode(' ',$sec->name,2);
              if($sec->id <= 2){
                  for($i=0; $i<3; $i++){
                      DB::table('classes')->insert([
                          'name' => config('constants.CLASS')[$i],
                          'section_id'=> $sec->id,
                          'next_class'=> $sec->id,
                          'created_at' => $faker->date('Y-m-d h:i:s', 'now'),
                          'updated_at' => $faker->date('Y-m-d h:i:s', 'now'),
                          'abbreviations' => substr($name[0],0,1).substr($name[1],0,1),
                      ]);
                  }
              }else{
                  for($i=3; $i<9; $i++){
                      DB::table('classes')->insert([
                          'name' => config('constants.CLASS')[$i],
                          'section_id'=> $sec->id,
                          'next_class'=> $sec->id,
                          'created_at' => $faker->date('Y-m-d h:i:s', 'now'),
                          'updated_at' => $faker->date('Y-m-d h:i:s', 'now'),
                          'abbreviations' => substr($name[0],0,1).substr($name[1],0,1),
                      ]);
                  }
              }
          }

      }
}
