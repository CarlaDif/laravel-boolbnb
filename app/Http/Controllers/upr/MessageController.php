<?php

namespace App\Http\Controllers\upr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
  //funzione per recuperare i mesaggi inviati all'utente loggato, proprietario di uno o più appartamenti
  public function showMessages() {
    $messages = DB::table('messages')
                    ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
                    ->where('user_id', Auth::user()->id)
                    ->select('messages.*')
                    ->get();

    return view('upr.mymessages', compact('messages'));
  }

}
