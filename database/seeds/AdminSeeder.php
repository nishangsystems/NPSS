<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder{

      public function run()
      {
          $date = new \DateTime();
          DB::table('users')->insert([
             'name' => 'John',
             'email' => 'admin@gmail.com',
             'phone' => '67777777',
              'photo' => 'default.png',
             'address' => 'NY 12345, Street 7',
             'slug' => str_replace("/","",\Hash::make('john'.$date->format('Y-m-d H:i:s'))),
             'password' => Hash::make('12345678'),
             'status'=>'active',
          ]);
      }
}
