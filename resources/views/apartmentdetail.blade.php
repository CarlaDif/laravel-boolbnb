@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $apartment->title }}</h1>
    <div class="row justify-content-between">
      <div class="col-md-8">
        <div class="card mb-3">
          @if (!empty($apartment->main_img))
            <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" alt="Anteprima Appartamento">
            @else
            <img src="http://www.newdesignfile.com/postpic/2015/02/nophoto-available-clip-art_68021.jpg" class="card-img-top" alt="Anteprima non disponibile">
          @endif
          <div class="card-body">
            <p>{{ $apartment->description }}</p>
            <p>Servizi:<br>
              @foreach ($apartment->services as $service)
                {{ $service->name }} @if (!$loop->last), @endif
              @endforeach
            </p>
          </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">N. Stanze: {{ $apartment->n_rooms }}</li>
              <div class="row no-gutters">
                <div class="col-md-6">
                  <li class="list-group-item">Letti singoli: {{ $apartment->n_single_beds }}</li>
                </div>
                <div class="col-md-6">
                  <li class="list-group-item">Letti matrimoniali: {{ $apartment->n_double_beds }}</li>
                </div>
              </div>
              <li class="list-group-item">Prezzo per notte: {{ $apartment->price_per_night }}€</li>
            </ul>
        </div>
        @guest
        <a href="{{ route('home') }}" class="btn btn-danger">Torna alla home</a>
        @else
        <a href="{{ route('home') }}" class="btn btn-danger">Torna alla home</a>
        <a href="{{ route('upr.apartments.edit', $apartment->id) }}" class="btn btn-warning">Modifica dati appartamento</a>
        @endguest
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="https://media.wired.com/photos/59269cd37034dc5f91bec0f1/master/pass/GoogleMapTA.jpg" class="card-img-top" alt="Anteprima non disponibile">
          <div class="card-body">
            <p class="card-text"><a href="#">{{ $apartment->address }}</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
