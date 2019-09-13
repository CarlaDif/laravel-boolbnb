<?php

namespace App\Http\Controllers\Upr;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use Braintree;

// use App\User;
// use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
{
  public function index($apartment_id) {
    $gateway = new Braintree\Gateway([
      'environment' => env('BT_ENVIRONMENT', 'sandbox'),
      'merchantId' => env('BT_MERCHANT_ID'),
      'publicKey' => env('BT_PUBLIC_KEY'),
      'privateKey' => env('BT_PRIVATE_KEY')
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
      'environment' => env('BT_ENVIRONMENT', 'sandbox'),
      'merchantId' => env('BT_MERCHANT_ID'),
      'publicKey' => env('BT_PUBLIC_KEY'),
      'privateKey' => env('BT_PRIVATE_KEY')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
          'firstName' => 'Chris',
          'lastName' => 'Evans',
          'email' => 'cap@america.com', //variabili utente che ha fatto la sponsorizzazione
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    dd($result);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back()->with('success_message', 'Transazione avvenuta con successo. L\'ID è: ' . $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        return back()->withErrore('Si è verificato un errore: ' . $result->message);

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");
    }
  }
}
