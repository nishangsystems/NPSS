<?php

use Illuminate\Database\Seeder;

class SequenceSeeder extends Seeder{

      public function run()
      {
          $faker = Faker\Factory::create();
          $date = new \DateTime();
          foreach(config('constants.SEQUENCE') as $type){
                DB::table('sequences')->insert([
                    'name' => $type['name'],
                    'term_id' => $type['t_id'],
                    'created_at' => $faker->date('Y-m-d h:i:s', 'now'),
                    'updated_at' => $faker->date('Y-m-d h:i:s', 'now')
                ]);
          }
      }
}
