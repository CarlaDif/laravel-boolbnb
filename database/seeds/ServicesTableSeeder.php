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
        'Basic',
        'WiFi',
        'Aria condizionata',
        'Terrazzo',
        'Cucina',
        'Appendiabiti',
        'Ferro da stiro',
        'Asciugacapelli',
        'Colazione inclusa',
        'Acqua calda',
        'Riscaldamento',
        'Asciugatrice',
        'Rilevatore di fumo',
        'Piscina',
        'Sauna',
        'Posto Macchina',
        'Portineria',
      ];
      foreach ($services as $single_service) {
        $newservice = new Service;
        $newservice->name = $single_service;
        $newservice->save();
      }
    }
}
