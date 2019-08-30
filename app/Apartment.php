<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Apartment extends Model
{
  protected $fillable = ['user_id', 'title', 'n_rooms', 'n_single_beds', 'n_double_beds','n_baths', 'mq', 'address', 'description', 'is_public', 'price_per_night', 'main_img'];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function sponsorships() {
    return $this->hasMany('App\Sponsorship');
  }

  public function apartment_imgs() {
    return $this->hasMany('App\Apartment_img');
  }

  public function messages() {
    return $this->hasMany('App\Message');
  }

  public function services() {
    return $this->belongsToMany('App\Service');
  }

}
