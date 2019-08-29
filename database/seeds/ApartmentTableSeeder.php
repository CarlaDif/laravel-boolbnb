<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Apartment;
class ApartmentTableSeeder extends Seeder
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
        $new_apartment = new Apartment();
        $new_apartment->user_id = $faker->numberBetween($min=1, $max=10);
        $new_apartment->title = $faker->sentence;
        $new_apartment->n_rooms = $faker->numberBetween($min=1, $max=10);
        $new_apartment->n_single_beds = $faker->numberBetween($min=1, $max=6);
        $new_apartment->n_double_beds = $faker->numberBetween($min=1, $max=6);
        $new_apartment->n_baths = $faker->numberBetween($min=1, $max=3);
        $new_apartment->mq = $faker->numberBetween($min=100, $max=600);
        $new_apartment->address = $faker->address;
        $new_apartment->description = $faker->text;
        $new_apartment->is_public = $faker->boolean;
        $new_apartment->price_per_night = $faker->numberBetween($min=20, $max=120);
        $new_apartment->main_img = $faker->imageUrl($width=800, $height=400, 'cats');
        $new_apartment->save();
    }
  }
}
