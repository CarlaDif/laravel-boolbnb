<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Message;

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

    

    return redirect()->route('thankyou');
  }

  public function thankyou() {
    return view('email.thankyou');
  }
}
