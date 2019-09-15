@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="ml-auto" action="{{ route('upr.apartments.create-step0') }}" method="post">
        @csrf
        <h3>Inserisci i primi dati del tuo appartamento!</h3>
        <div class="step-inserimento mb-4">
          <p>Passaggio 1 di 4</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
              {{-- <span class="sr-only">73% Complete</span> --}}
            </div>
          </div>
        </div>

        {{-- indirizzo --}}
        <div class="form-group">
          <div class="tt-search-box-search-icon form-group has-search mt-auto mb-auto position-relative">
            <div class="form-group">
              <label>Paese</label>
              <input type="text" name="country" value="" class="tt-search-box-input country form-control" placeholder="Paese" autocomplete="off">
            </div>

            <div class="form-group">
              <label>Via</label>
              <input type="text" name="place" value="" class="tt-search-box-input form-control input-address" placeholder="Indirizzo" autocomplete="off">
              <div class="bootstrap-select-wrapper position-absolute w-100">
                <div class="tendina">
                  {{-- select che restituisce il codice della nazione --}}
                  <select class="list_results custom-select" name="" multiple></select>
                </div>
              </div>
            </div>



            <div class="form-group">
              <label>Città</label>
              <input type="text" name="city" value="" class="form-control" placeholder="Città">
            </div>

            <div class="form-group">
              <label>Regione</label>
              <input type="text" name="regione" value="" class="form-control" placeholder="Regione">
            </div>

            <div class="form-group">
              <label>CAP</label>
              <input type="text" name="cap" value="" class="form-control" placeholder="CAP">
            </div>

            {{-- input hidden --}}
            <input type="hidden" value="" name="address">
            <input type="hidden" value="" id="latitude_hidden" name="latitude">
            <input type="hidden" value="" id="longitude_hidden" name="longitude">
          </div>
          @error('address')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        @endif

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Avanti" class="btn btn-success bt_cerca">
      </form>
    </div>
  </div>
@endsection
