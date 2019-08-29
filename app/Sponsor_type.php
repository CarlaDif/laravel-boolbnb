<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor_type extends Model
{
    public $timestamps = null;

    public function sponsorships() {
      return $this->hasMany('App\Sponsorship');
    }

    protected $fillable = ['name', 'description', 'price'];
}
