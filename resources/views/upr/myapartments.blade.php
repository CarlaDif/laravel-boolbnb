@extends('layouts.app')

@section('content')
  @if (session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif
  @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
  @endif
  <section id="apartments-prewiew">
    <div class="container container-82">
      @if (count($apartments) == 0)
        <div class="row mt-5">
          <h4>{{ Auth::user()->name }}, non hai ancora caricato nessun appartamento <i class="fas fa-frown"></i></h4><br>
        </div>
        <div class="row mt-3">
          <a href="{{ route('upr.apartments.create-step0') }}" class="btn btn-info mt-3">Diventa un host</a>
        </div>
      @else
        <div class="row mt-5">
          <h4 class="mia-lista">{{ Auth::user()->name }}, ecco la lista dei tuoi appartamenti! <i class="far fa-smile"></i></h4>
        </div>
        <div class="row justify-content-between mt-3">
          <div class="card-deck no-gutters" id="apartments">
            @foreach ($apartments as $apartment)
              <a href="{{ route('upr.apartments.show', $apartment->id) }}">
                <div class="card card-apartment mt-3 position-relative">
                  @if (!empty($apartment->main_img))
                    <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" alt="Anteprima Appartamento">
                  @else
                    <img style="width: 100%; height: 150px; object-fit: cover;" src="https://kitv.images.worldnow.com/images/16468883_G.png?lastEditedDate=1522902908000" class="card-img-top" alt="Anteprima non disponibile">
                  @endif
                  <div class="card-body">
                    @if ($apartment->is_sponsored == 1)
                      <h5 class="card-title nome-appartamento"> {{ $apartment->title }} <i class="fas fa-star"></i> </h5>
                    @else
                      <h5 class="card-title nome-appartamento">{{ $apartment->title }}</h5>
                    @endif
                    <p>{{ $apartment->address }}</p>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </section>
@endsection
