<?php

namespace App\Http\Controllers\Ui;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\User;
use App\Service;
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

      if (empty($apartment)) {
        abort(404);
      }

      $services = Service::all();

      $data = [
      'apartment' => $apartment,
      'services' => $services,
      ];


      return view('apartmentdetail', $data);
  }
}
