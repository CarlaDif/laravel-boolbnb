@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $apartment->title }}</h1>
    <div class="card" style="width: 50rem;">
      <img src="https://pmcvariety.files.wordpress.com/2018/07/bradybunchhouse_sc11.jpg?w=1000&h=563&crop=1" class="card-img-top" alt="Anteprima Appartamento">
      <div class="card-body">
        <p>{{ $apartment->description }}</p>
        <p>N. Stanze: {{ $apartment->n_rooms }}</p>
        <p>Letti singoli: {{ $apartment->n_single_beds }}</p>
        <p>Letti matrimoniali: {{ $apartment->n_double_beds }}</p>
        <p>Prezzo per notte: {{ $apartment->price_per_night }}€</p>
        <p>Servizi:<br>
          @foreach ($apartment->services as $service)
            {{ $service->name }} @if (!$loop->last), @endif
          @endforeach
        </p>
      </div>
    </div>
  </div>
@endsection
