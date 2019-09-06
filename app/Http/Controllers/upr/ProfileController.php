<?php

namespace App\Http\Controllers\upr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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

        return view('upr.profile')->with([
          'user'=> $user
        ]);
      }

    }

    //funzione per recuperare i mesaggi inviati all'utente loggato, proprietario di uno o più appartamenti
    public function showMessage() {
      $messages = DB::table('messages')
                      ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
                      ->where('user_id', Auth::user()->id)
                      ->select('messages.*')
                      ->get();
      dd($messages);
    }
}
