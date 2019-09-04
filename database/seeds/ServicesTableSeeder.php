<?php

use Illuminate\Database\Seeder;
use App\Service;
class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $services = [
        'basic',
        'wifi',
        'aria condizionata',
        'terrazzo',
        'cucina',
        'appendiabiti',
        'ferro da stiro',
        'asciugacapelli',
        'colazione',
        'acqua calda',
        'riscaldamento',
        'asciugatrice',
        'rilevatore di fumo',
      ];
      foreach ($services as $single_service) {
        $newservice = new Service;
        $newservice->name = $single_service;
        $newservice->save();
      }
    }
}
