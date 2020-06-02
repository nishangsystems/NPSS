<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder{

      public function run()
      {
          $faker = Faker\Factory::create();
          $date = new \DateTime();
          foreach(config('constants.SECTION') as $type){
                DB::table('sections')->insert([
                    'name' => $type,
                    'created_at' => $faker->date('Y-m-d h:i:s', 'now'),
                    'updated_at' => $faker->date('Y-m-d h:i:s', 'now')
                ]);
          }
      }
}
