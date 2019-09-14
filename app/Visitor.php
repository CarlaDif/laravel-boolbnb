<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
  public function apartments() {
    return $this->belongsToMany('App\Apartments');
  }
}
