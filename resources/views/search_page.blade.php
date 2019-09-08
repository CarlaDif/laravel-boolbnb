
@extends('layouts.app')
@section('content')
  {{-- --------------------------------------FIlter-MENU--------------------------- --}}
   <div class="container-fluid search_filters px-4">
     <div class="">
       <h5>Search by Filters:</h5>
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
  <div class="container-fluid search_result px-4">
    {{ $search }}
  </div>
@endsection
