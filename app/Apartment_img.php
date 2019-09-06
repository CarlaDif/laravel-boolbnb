<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment_img extends Model
{
    protected $fillable = ['apartment_id','path','slug','alt'];

    public function apartment() {
      return $this->belongsTo('App\Apartment');
    }
}
