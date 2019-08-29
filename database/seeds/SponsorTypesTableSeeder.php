<?php

use Illuminate\Database\Seeder;
use App\Sponsor_type;

class SponsorTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $servicestype = [
        [
          'name'=>'24h',
          'description'=>'La durata di questa sponsorizzazione sarà di 24h',
          'price'=>'2.99'
        ],
        [
          'name'=>'72h',
          'description'=>'La durata di questa sponsorizzazione sarà di 72h',
          'price'=>'5.99'
        ],
        [
          'name'=>'144h',
          'description'=>'La durata di questa sponsorizzazione sarà di 144h',
          'price'=>'9.99'
        ]
      ];

      foreach ($servicestype as $single_service) {
        $newtype = new Sponsor_type();
        $newtype->fill($single_service);
        $newtype->save();
      }

    }
}
