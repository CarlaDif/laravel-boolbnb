@extends('layouts.form')

@section('content')
  @if (session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="container">
    <form method="post" id="payment-form" action="{{ route('upr.checkout') }}">
      @csrf
        <div class="form-group">
        <section>
          <label for="amount">
              <span class="input-label">Sponsorizzazione: </span>
              <div class="input-wrapper amount-wrapper">
                <select id="amount" name="amount" class="form-control">
                  <option value="">Seleziona il tipo di sponsorizzazione</option>
                  <option data-id="1" value="2.99">2.99 - Sponsorizzazione 24h</option>
                  <option data-id="2" value="5.99">5.99 - Sponsorizzazione 72h</option>
                  <option data-id="3" value="9.99">9.99€ - Sponsorizzazione 144h</option>
                </select>
              </div>
          </label>
        </div>

        <div class="bt-drop-in-wrapper">
            <div id="bt-dropin"></div>
        </div>
      </section>
      <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <button class="button btn btn-success" type="submit"><span>Acquista</span></button>
    </form>
  </div>
@endsection
