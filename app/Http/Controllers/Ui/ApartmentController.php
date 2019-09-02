<?php

namespace App\Http\Controllers\Ui;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\User;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  \App\Apartment  $apartment
   * @return \Illuminate\Http\Response
   */
  public function show($apartment_id)
  {
      $apartment = Apartment::find($apartment_id);
      return view('apartmentdetail', compact('apartment'));
  }
}
