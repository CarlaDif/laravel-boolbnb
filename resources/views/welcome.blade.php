@extends('layouts.app')

@section('content')
  <section id="title-prewiew">
    <div class="container">
      <div class="row">
        @guest
          <h3>Esplora AirBnB</h3>
        @else
          <h3>Cosa possiamo aiutarti a cercare, {{ $user->name }}?</h3>
        @endguest
      </div>
    </div>
  </section>
  <section id="categories">
    <div class="container">
      <div class="row justify-content-between mt-5">
        <div class="col-3">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/8b7519ec-2c82-4c09-8233-fd4d2715bbf9.jpg?aki_policy=x_large" class="card-img" alt="Soggiorni">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title">Soggiorni</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/a77ee672-e790-4362-8cc5-52bec1371ece.jpg?aki_policy=x_large" class="card-img" alt="Esperienze">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title">Esperienze</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/38f2bfd6-1f4d-46d7-babf-61657deef302.jpg?aki_policy=x_large" class="card-img" alt="Avventure">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title">Avventure</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-5">
                <img src="https://a0.muscache.com/im/pictures/da2d8e97-90b7-409f-94ac-5ab0327c289b.jpg?aki_policy=x_large" class="card-img" alt="Ristoranti">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title">Ristoranti</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="apartments-prewiew">
    <div class="container">
      <div class="row mt-5">
        <h4>Alloggi in tutto il mondo</h4>
      </div>
      <div class="row justify-content-between mt-3">
        @foreach ($apartments as $apartment)
          @guest
          <a href="{{ route('ui.apartments.show', $apartment->id) }}">
          @else
            <a href="{{ route('upr.apartments.show', $apartment->id) }}">
          @endguest
            <div class="card" style="width: 17rem;">
              @if (!empty($apartment->main_img))
                <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" alt="Anteprima Appartamento">
                @else
                <img src="https://pmcvariety.files.wordpress.com/2018/07/bradybunchhouse_sc11.jpg?w=1000&h=563&crop=1" class="card-img-top" alt="Anteprima non disponibile">
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
@endsection
