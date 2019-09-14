@extends('layouts.app')

@section('content')
  <section id="title-prewiew">
    @guest
      <div class="welcome-image"></div>
    @endguest
    <div class="container container-82">
      <div class="row">
        @guest
          <h3 class="mt-4 ml-3 esplora">Esplora BoolBnB</h3>
        @else
          <h3 class="mt-4 ml-3 aiutarti">Cosa possiamo aiutarti a cercare, {{ $user->name }}?</h3>
        @endguest
      </div>
    </div>
  </section>
  <section id="categories">
    <div class="container container-82">
      <div class="row justify-content-between mt-5">
        <div class="col-3">
          <div class="card mb-3">
            <div class="row no-gutters welcome-option">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/8b7519ec-2c82-4c09-8233-fd4d2715bbf9.jpg?aki_policy=x_large" class="card-img" alt="Soggiorni">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h6 class="card-title">Soggiorni</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3">
            <div class="row no-gutters welcome-option">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/a77ee672-e790-4362-8cc5-52bec1371ece.jpg?aki_policy=x_large" class="card-img" alt="Esperienze">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h6 class="card-title">Esperienze</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3">
            <div class="row no-gutters welcome-option">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/38f2bfd6-1f4d-46d7-babf-61657deef302.jpg?aki_policy=x_large" class="card-img" alt="Avventure">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h6 class="card-title">Avventure</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3">
            <div class="row no-gutters welcome-option">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/da2d8e97-90b7-409f-94ac-5ab0327c289b.jpg?aki_policy=x_large" class="card-img" alt="Ristoranti">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h6 class="card-title">Ristoranti</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="apartments-prewiew">
    <div class="container container-82">
      <div class="row mt-5">
        <h4 class="ml-3 alloggi">Alloggi in tutto il mondo</h4>
      </div>
      <div class="row mt-3">
      <div class="card-deck no-gutters" id="apartments">
        @foreach ($apartments as $apartment)
          {{-- <div class="col-md-6 col-sm-12 col-lg-4 single-apartment"> --}}
            <a href=
            @guest
              "{{ route('ui.apartments.show', $apartment->id) }}"
            @else
              "{{ route('upr.apartments.show', $apartment->id) }}"
            @endguest
            >
            <div class="card mt-3 card-apartment position-relative visit-counter">
              {{-- @if ($apartment->is_sponsored == 1)
                <div class="position-absolute">
                  <i class="fas fa-star mt-1 ml-1"></i>
                </div>
              @endif --}}
              @if (!empty($apartment->main_img))
                <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" alt="Anteprima Appartamento">
              @else
                <img src="https://kitv.images.worldnow.com/images/16468883_G.png?lastEditedDate=1522902908000" class="card-img-top" alt="Anteprima non disponibile">
              @endif
                <div class="card-body">
                  @if ($apartment->is_sponsored == 1)
                    <div class="">
                      <h5 class="card-title nome-appartamento"> {{ $apartment->title }} <i class="fas fa-star mt-1 ml-1"></i> </h5>
                    </div>
                    @else
                    <h5 class="card-title nome-appartamento">{{ $apartment->title }}</h5>
                  @endif
                  <p>{{ $apartment->address }}</p>
                </div>
              </div>
            </a>
          {{-- </div> --}}
        @endforeach
      </div>
      </div>
    </div>
  </section>
@endsection
