@extends('layouts.sponsor')

@section('content')
  @if (session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif
  <div class="container">
    <h4 class="mt-5 title">Sponsorizza il tuo appartamento. Bastano pochi secondi!</h4>
    <form method="post" id="payment-form" action="{{ route('upr.checkout') }}" class=" mt-4">
      @csrf
      <section>
        <div class="row">
          <div class="col-md-7 col-lg-7 col-12 mt-4">
            <div class="form-group">
              <label for="amount">Piano di sponsorizzazione</label>
              <div class="input-wrapper amount-wrapper">
                <select id="amount" name="amount" class="form-control">
                  <option value="">Seleziona il tipo di sponsorizzazione</option>
                  <option data-id="1" value="2.99">2.99 - Sponsorizzazione 24h</option>
                  <option data-id="2" value="5.99">5.99 - Sponsorizzazione 72h</option>
                  <option data-id="3" value="9.99">9.99€ - Sponsorizzazione 144h</option>
                  <option data-id="4" value="2001">Errore transazione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="name">Nome:</label>
                  <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nome">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="surname">Cognome:</label>
                  <input type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" placeholder="Cognome">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Indirizzo email">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-lg-5 col-12 ml-auto mt-4">
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
            <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button btn btn-success w-100" type="submit"><span>Sponsorizza adesso</span></button>
          </div>
        </div>
      </section>

    </form>
  </div>
@endsection
