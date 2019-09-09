
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
  <div class="container search_result">
    <div class="row justify-content-between mt-3">
      @foreach ($apartments as $apartment)
      <a href=
      @guest
        "{{ route('ui.apartments.show', $apartment->id) }}"
      @else
        "{{ route('upr.apartments.show', $apartment->id) }}"
      @endguest
      >
      <div class="card mt-3 " style="width: 16rem;">
        @if (!empty($apartment->main_img))
          <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" alt="Anteprima Appartamento">
        @else
          <img style="width: 100%; height: 150px; object-fit: cover;" src="https://kitv.images.worldnow.com/images/16468883_G.png?lastEditedDate=1522902908000" class="card-img-top" alt="Anteprima non disponibile">
        @endif
          <div class="card-body">
            <h5 class="card-title">{{ $apartment->title }}</h5>
            <p>{{ $apartment->address }}</p>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
@endsection
