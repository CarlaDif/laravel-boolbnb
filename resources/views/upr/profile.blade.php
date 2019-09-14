@extends('layouts.app')

@section('content')
  <div class="container col-sm-12 dettagli-utente">
    <div class="row mt-5 info-utente col-sm-12">
      <div class="col-md-9 col-sm-12">
        <div class="card border-info mb-3">
          <div class="card-header">
            <h5 class="card-title info-account-utente">Informazioni Account</h5>
          </div>
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://www.searchpng.com/wp-content/uploads/2019/02/User-Icon-PNG-715x715.png" class="card-img" alt="Immagine Profilo Utente">
            </div>
            <div class="col-md-8">
              <div class="card-body dettagli-account-utente">
                <p class="card-text">
                  <small class="text-muted mt-0">Nome e Cognome: </small><br>{{ Auth::user()->name }} {{ Auth::user()->surname }}
                </p>
                <p class="card-text">
                  <small class="text-muted">Data di nascita: </small><br>{{ Auth::user()->birth }}
                </p>
                <p class="card-text">
                  <small class="text-muted">Email: </small><br>{{ Auth::user()->email }}
                </p>
                <p class="card-text">
                  <small class="text-muted">Telefono: </small><br>{{ Auth::user()->tel }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 visualizza-inserzioni">
        <button type="button" class="btn mb-2"><a href="{{ route('upr.my-apartments') }}">Visualizza le tue inserzioni</a></button>
      </div>
    </div>

  </div>
@endsection
