@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-9">
        <div class="card border-info mb-3">
          <div class="card-header">
            <h5 class="card-title">Informazioni Account Utente</h5>
          </div>
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://www.searchpng.com/wp-content/uploads/2019/02/User-Icon-PNG-715x715.png" class="card-img" alt="Immagine Profilo Utente">
            </div>
            <div class="col-md-8">
              <div class="card-body">
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
      <div class="col-3">
        <button type="button" class="btn btn-outline-info mb-2"><a href="{{ route('upr.my-apartments') }}">Visualizza le tue inserzioni</a></button>
      </div>
    </div>
  </div>
@endsection
