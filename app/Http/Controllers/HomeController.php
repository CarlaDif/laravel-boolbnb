<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      if(Auth::user()) {
        $user = Auth::user();
        $apartments = Apartment::all();

        return view('welcome')->with([
          'apartments'=>$apartments,
          'user'=> $user
        ]);
      }

      $apartments = Apartment::all();
      return view('welcome')->with([
        'apartments'=>$apartments,
      ]);
    }
}
