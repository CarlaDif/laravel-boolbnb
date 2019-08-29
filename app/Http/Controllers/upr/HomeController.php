<?php

namespace App\Http\Controllers\upr;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apartment;

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
        $apartments = Apartment::all();
        return view('upr.home_upr')->with([
          'apartments'=>$apartments
        ]);
    }
}
