@extends('layouts.app')

@section('content')
  <div class="container">
    <section id="apartments-prewiew">
      <div class="container">
        <div class="row mt-5">
          <h4>{{ Auth::user()->name }}, ecco la lista dei tuoi appartamenti!</h4>
        </div>
        <div class="row justify-content-between mt-3">
          <div class="card-deck" id="apartments">
            @foreach ($apartments as $apartment)
              <a href="{{ route('upr.apartments.show', $apartment->id) }}">
                <div class="card mt-3" style="width: 16rem;">
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
      </div>
    </section>
  </div>
@endsection
