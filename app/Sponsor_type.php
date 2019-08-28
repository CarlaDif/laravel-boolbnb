<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor_type extends Model
{
    public function sponsorships() {
      return $this->hasMany('App\Sponsorship');
    }
}
