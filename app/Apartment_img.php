<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment_img extends Model
{
    public function apartment() {
      return $this->belongsTo('App\Apartment');
    }
}
