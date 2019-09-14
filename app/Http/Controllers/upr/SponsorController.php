<?php

namespace App\Http\Controllers\Upr;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Apartment;
use App\Sponsorship;
use Carbon\Carbon;
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
    if ($apartment->is_sponsored == 0) {
      return view('upr.sponsor_page')->with([
        'apartment'=> $apartment,
        'token' => $token
      ]);
    }

    return back()->with('message', 'Questo appartamento è già sponsorizzato.');
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

    if ($result->success) {
        $settledTransaction = $result->transaction;
        $transaction = $result->transaction;
        $apartment_id = $request->apartment_id;

        $apartment_is_sponsored = DB::table('apartments')
        ->where('id', $apartment_id)
        ->update(['is_sponsored' => 1]);

        //salvataggio dati sponsorizzazione nel database
        $sponsorship = new Sponsorship;

        if ($transaction->amount == 2.99 || $settledTransaction->amount == 2.99) {
          $sponsorship->sponsor_type_id = '1';
        } elseif ($transaction->amount == 5.99 || $settledTransaction->amount == 5.99) {
          $sponsorship->sponsor_type_id = '2';
        } else {
          $sponsorship->sponsor_type_id = '3';
        }

        $sponsorship->apartment_id = $apartment_id;

        if ($transaction->amount == 2.99 || $settledTransaction->amount == 2.99) {
          $sponsorship->sponsor_end_at = Carbon::now()->addMinutes(5);
        } elseif ($transaction->amount == 5.99 || $settledTransaction->amount == 5.99) {
          $sponsorship->sponsor_end_at = Carbon::now()->addHours(72);
        } else {
          $sponsorship->sponsor_end_at = Carbon::now()->addHours(144);
        }

        $sponsorship->save();

        return redirect()->route('upr.my-apartments')->with('success_message', 'Transazione avvenuta con successo.');
    } else {
        $errorString = '';

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        return back()->withError('Si è verificato un errore: ' . $result->message);
    }
  }

  // public function resetIsSponsored($apartment_id) {
  //   $fine = $sponsorship->sponsor_end_at;

  //   $apartment_is_sponsored = DB::table('apartments')
  //   ->where('id', $apartment_id)
  //   ->update(['is_sponsored' => 0]);
  // }
}
