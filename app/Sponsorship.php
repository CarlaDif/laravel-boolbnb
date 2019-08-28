<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function apartment() {
      return $this->belongsTo('App\Apartment');
    }

    public function sponsor_type() {
      return $this->belongsTo('App\Sponsor_type');
    }
}
