<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use Carbon\Carbon;

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

      //query per aggiornare lo status sponsorizzazione degli appartamenti
      $sponsorships = DB::table('sponsorships')
                      ->join('apartments', 'sponsorships.apartment_id','=' , 'apartments.id' )
                      ->select('sponsorships.*')
                      ->orderBy('apartment_id', 'ASC')
                      ->orderBy('sponsor_end_at', 'DESC')
                      ->get();

      $now = Carbon::now()->format('Y-m-d H:i:s');

      foreach ($sponsorships as $sponsor) {
        $end = $sponsor->sponsor_end_at;
        $now_string = strval($now);
        $end_string = strval($end);

        $diff = Carbon::parse($now_string)->greaterThanOrEqualTo($end_string);
        if ($diff) {
          $apartment_is_sponsored = DB::table('apartments')
          ->where('id', $sponsor->apartment_id)
          ->update(['is_sponsored' => 0]);
        }
      }

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
