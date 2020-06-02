<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder{

      public function run()
      {
          $faker = Faker\Factory::create();
          $date = new \DateTime();
          foreach(config('constants.PAYMENT_METHOD') as $type){
                DB::table('payment_methods')->insert([
                    'name' => $type,
                    'created_at' => $faker->date('Y-m-d h:i:s', 'now'),
                    'updated_at' => $faker->date('Y-m-d h:i:s', 'now')
                ]);
          }
      }
}
