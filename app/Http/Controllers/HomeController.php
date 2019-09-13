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
    public function index(Request $request)
    {
      $request->session()->forget('apartment');

      if(Auth::user()) {
        $user = Auth::user();
        $apartments = Apartment::where('is_public', 1)->orderBy('is_sponsored', 'DESC')->get();

        return view('welcome')->with([
          'apartments'=>$apartments,
          'user'=> $user
        ]);
      }

      $apartments = Apartment::where('is_public', 1)->orderBy('is_sponsored', 'DESC')->get();

      return view('welcome')->with([
        'apartments'=>$apartments,
      ]);
    }
}
