
@extends('layouts.app')

@section('content')

  {{-- --------------------------------------FIlter-MENU--------------------------- --}}
  <div class="container-fluid search_filters px-4">
     <div class="">
       <form class="" action="{{ route('filtersPage') }}">
        <div class="links d-flex align-items-center">

          <span>
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">Date</a>
          </span>

          <span class="position-relative" >
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter"><span class="ux_filter_result"></span> Ospiti</a>
            <div class="position-absolute sub_filter">
              <ul class="list-group host-menu">
                <li class="list-group-item">
                  <div class="d-flex">
                    <div>
                      Numero Letti Singoli
                    </div>
                    <div class="ml-auto">
                      <i class="fas fa-minus-circle"></i>
                      <input class="count mx-1" value="0" name="n_single_beds" >
                      <i class="fas fa-plus-circle"></i>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex">
                    <div class="">
                      Numero Letti Matrimoniali
                    </div>
                    <div class="ml-auto">
                      <i class="fas fa-minus-circle"></i>
                      <input class="count mx-1" value="0" name="n_double_beds" >
                      <i class="fas fa-plus-circle"></i>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex">
                    <div class="">
                      Numero Bagni
                    </div>
                    <div class="ml-auto">
                      <i class="fas fa-minus-circle"></i>
                      <input class="count mx-1" value="0" name="n_baths" >
                      <i class="fas fa-plus-circle"></i>
                    </div>
                  </div>
                </li>
                <li class="list-group-item ">
                  <div class="w-100 d-flex align-items-center">
                    <div class="save_filter btn btn-success">Salva</div>
                    <div class="reset_filter btn btn-outline-secondary">Reset</div>
                  </div>
                </li>
              </ul>
            </div>
          </span>

          <span>
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">Viaggio Di Lavoro</a>
          </span>

          <span>
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">Tipo Di Alloggio</a>
          </span>

          <span class="position-relative">
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">
              <span class="ux_filter_result"></span > Prezzo </a>
            <div class="position-absolute sub_filter">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="d-flex">
                    <div class="">
                      Prezzo a notte
                    </div>
                    <div class="col-6 ml-auto">
                      <label class="tt-form-label js-slider">Prezzo (<span id="prezzo" class="js-counter">0</span>€)</label>
                      <input type="range" name="price_per_night" value="0" id="id_prezzo" class="count mx-1 form-control-range search-slider" min="0" max="1500">
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="save_filter btn btn-success">Salva</div>
                  <div class="reset_filter btn btn-outline-secondary">Reset</div>
                </li>
            </div>
          </span>

          <span class="position-relative">
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">
              <span class="ux_filter_result"></span > Kilometri </a>
            <div class="position-absolute sub_filter">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="d-flex">
                    <div class="">
                      Distanza dal centro
                    </div>
                    <div class="col-6 ml-auto">
                      <div class="form-group">
                        <label class="tt-form-label js-slider">Raggio: (<span id="km" class="js-counter">0</span>Km)</label>
                          <input type="hidden" name="latitude" value="{{ $latitude }}">
                          <input type="hidden" name="longitude" value="{{ $longitude }}">
                          <input type="range" name="inputRadius" value="0" id="id_raggio" class="tt-slider form-control-range raggio search-slider" min="0" max="200">
                          {{-- <p>Value: <span id="demo"></span></p> --}}
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="save_filter btn btn-success">Salva</div>
                  <div class="reset_filter btn btn-outline-secondary">Reset</div>
                </li>
            </div>
          </span>

          <span>
            <a href="#" class="btn btn-sm btn-outline-secondary search_filter">Prenotazione Immediata</a>
          </span>

          <span>
            <button type="submit" class="btn"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </form>

     </div>
    </div>
  <div class="container search_result">
    <div class="row justify-content-between mt-3">

    @if ($apartments->isNotEmpty())
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
    @else
      <p>Spiacenti, non ci sono risultati per questa ricerca</p>
    @endif

    </div>
  </div>
@endsection
