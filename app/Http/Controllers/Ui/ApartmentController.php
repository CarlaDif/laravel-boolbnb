<?php

namespace App\Http\Controllers\Ui;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\User;
use App\Service;
use Illuminate\Http\Request;
use App\Apartment_img;

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
      $apartment_imgs = Apartment_img::where('apartment_id', $apartment_id)->take(4)->get();
      // dd($apartment_imgs);

      if (empty($apartment)) {
        abort(404);
      }

      $services = Service::all();

      $data = [
      'apartment' => $apartment,
      'services' => $services,
      'apartment_imgs' => $apartment_imgs
      ];


      return view('apartmentdetail', $data);
  }
}
