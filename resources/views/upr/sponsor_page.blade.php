@extends('layouts.form')

@section('content')
  <div class="container">
    <form method="post" id="payment-form" action="{{ route('upr.checkout') }}">
      @csrf
        <section>
          <div class="form-group">
            <label for="amount">
                <span class="input-label">Sponsorizzazione: </span>
                <div class="input-wrapper amount-wrapper form-control">
                  <select name="amount">
                    <option value="">Seleziona il tipo di sponsorizzazione</option>
                    <option data-id="1" value="2.99">2.99 - Sponsorizzazione 24h</option>
                    <option data-id="2" value="5.99">5.99 - Sponsorizzazione 72h</option>
                    <option value="9.99">9.99€ - Sponsorizzazione 144h</option>
                    <option value="2001">2001€ - Prova Errore</option>
                  </select>
                    <!-- <input id="amount" name="amount" type="tel hidden" min="1" value=""> -->
                </div>
            </label>
          </div>

            <div class="bt-drop-in-wrapper">
                {{-- scelta metodo pagamento --}}
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
    <div class="messaggi-pagamento">
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
    </div>
  </div>
@endsection
