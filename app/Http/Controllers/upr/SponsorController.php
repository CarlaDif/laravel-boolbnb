<?php

namespace App\Http\Controllers\Upr;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Apartment;
use Braintree;

// use App\User;
// use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
{
  public function index($apartment_id) {
    $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->clientToken()->generate();

    $apartment = Apartment::find($apartment_id);

    return view('upr.sponsor_page')->with([
      'apartment'=> $apartment,
      'token' => $token
    ]);
  }

  public function checkout(Request $request) {
    $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;

    // $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => 'fake-valid-nonce',
        'customer' => [
          'firstName' => 'Chris',
          'lastName' => 'Evans',
          'email' => 'cap@america.com', //variabili utente che ha fatto la sponsorizzazione
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success || !is_null($result->transaction)) {
        $transaction = $result->transaction;
        $apartment_id = $request->apartment_id;
        $apartment_is_sponsored = $users = DB::table('apartments')
        ->where('id', $apartment_id)
        ->update(['is_sponsored' => 1]);

        return back()->with('success_message', 'Transazione avvenuta con successo.');
    } else {
        $errorString = '';

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        return back()->withError('Si è verificato un errore: ' . $result->message);
    }
  }
}
