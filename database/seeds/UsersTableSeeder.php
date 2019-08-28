<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i=0; $i < 10; $i++) {
        $new_user = new User();
        $new_user->name = $faker->firstName;
        $new_user->surname = $faker->lastName;
        $new_user->birth = $faker->date($format = 'Y-m-d', $max = '2001-12-31');
        $new_user->email = $faker->email;
        $new_user->tel = $faker->phoneNumber;
        $new_user->password = $faker->password;
        $new_user->save();
      }
    }
}
