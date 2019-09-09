
@extends('layouts.app')
@section('content')
  {{-- --------------------------------------FIlter-MENU--------------------------- --}}
   <div class="container-fluid search_filters px-4">
     <div class="">
      <div class="links">
        <a href="#" class="btn btn-sm btn-outline-secondary">Date</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Ospiti</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Viaggio Di Lavoro</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Tipo Di Alloggio</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Prezzo</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Prenotazione Immediata</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Piu Filtri</a>
      </div>
     </div>
    </div>
  <div class="container search_result px-4">
    @foreach ($apartments as $apartment)
      <h3>{{ $apartment->title }}</h3>
      <p>{{ $apartment->address }}</p>
      <img src="{{ asset('storage/' . $apartment->main_img) }}" alt="">
    @endforeach
  </div>
@endsection
