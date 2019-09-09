<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Message;
use App\Mail\MessageConfirm;
use App\Mail\MessageFromWebsite;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
  public function storeMessage(Request $request, $apartment_id) {

    $apartment = Apartment::find($apartment_id);

    $validatedData = $request->validate([
      'name' => 'required',
      'subject' => 'max:255',
      'email' => 'required|email',
      'message' => 'required'
    ]);

    $data = $request->all();

    $data['apartment_id'] = $apartment->id;

    $new_message = new Message();
    $new_message->fill($data);
    $new_message->save();

    //assegno il messaggio dell'utente ad una variabile
    $email_utente = $data['email'];

    //invio l'email di conferma all'utente che ha inviato il messaggio
    Mail::to($email_utente)->send(new MessageConfirm($new_message));
    Mail::to($email_utente)->send(new MessageFromWebsite($new_message));

    //

    return redirect()->route('thankyou');
  }

  public function thankyou() {
    return view('email.thankyou');
  }
}
