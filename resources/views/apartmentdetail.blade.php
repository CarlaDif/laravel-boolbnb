@extends('layouts.app')

@section('content')
  <div class="container-fluid no-gutters px-0">
    <div class="row no-gutters">
      <div class="col-md-6" style="height:500px;">
        @if (!empty($apartment->main_img))
          <img style="height:500px;" src="{{ asset('storage/' . $apartment->main_img) }}" class="img-fluid" alt="Anteprima Appartamento">
          @else
          <img style="height:500px;" src="http://www.newdesignfile.com/postpic/2015/02/nophoto-available-clip-art_68021.jpg" class="img-fluid" alt="Anteprima non disponibile">
        @endif
      </div>
      <div class="col-md-6">
        <div class="row no-gutters">
          <div class="col-md-6" style="max-height:250px;">
            {{-- @if (!empty($apartment->main_img))
              <img src="{{ asset('storage/' . $apartment->main_img) }}" class="img-fluid" alt="Anteprima Appartamento">
              @else --}}
              <img style="height:250px;" src="https://media.gettyimages.com/photos/spring-field-picture-id539016480?s=612x612" class="img-fluid" alt="Anteprima non disponibile">
            {{-- @endif --}}
          </div>
          <div class="col-md-6" style="max-height:250px;">
            {{-- @if (!empty($apartment->main_img))
              <img src="{{ asset('storage/' . $apartment->main_img) }}" class="img-fluid" alt="Anteprima Appartamento">
              @else --}}
              <img style="height:250px;" src="https://images.pexels.com/photos/248797/pexels-photo-248797.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid" alt="Anteprima non disponibile">
            {{-- @endif --}}
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-md-6" style="max-height:250px;">
            {{-- @if (!empty($apartment->main_img))
              <img src="{{ asset('storage/' . $apartment->main_img) }}" class="img-fluid" alt="Anteprima Appartamento">
              @else --}}
              <img style="height:250px;" src="https://media.gettyimages.com/photos/spring-field-picture-id539016480?s=612x612" class="img-fluid" alt="Anteprima non disponibile">
            {{-- @endif --}}
          </div>
          <div class="col-md-6" style="max-height:250px;">
            {{-- @if (!empty($apartment->main_img))
              <img src="{{ asset('storage/' . $apartment->main_img) }}" class="img-fluid" alt="Anteprima Appartamento">
              @else --}}
              <img style="height:250px;" src="https://images.pexels.com/photos/248797/pexels-photo-248797.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid" alt="Anteprima non disponibile">
            {{-- @endif --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-12">
        <h1>{{ $apartment->title }}</h1>
      </div>
      <div class="col-12">
        <a href="#">{{ $apartment->address }}</a>
      </div>
    </div>
    <div class="row justify-content-between mt-3">
      <div class="col-md-8">
        <div class="card mb-3">
          {{-- @if (!empty($apartment->main_img))
            <img src="{{ asset('storage/' . $apartment->main_img) }}" class="card-img-top" alt="Anteprima Appartamento">
            @else
            <img src="http://www.newdesignfile.com/postpic/2015/02/nophoto-available-clip-art_68021.jpg" class="card-img-top" alt="Anteprima non disponibile">
          @endif --}}
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
        <hr>
        {{-- FORM EMAIL --}}

        @if ($apartment->user_id != Auth::user()->id)
          <h4 class="mt-3">Contatta il proprietario dell'appartamento</h4>
          <form class="mt-3" action="{{ route('store-message', $apartment->id) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="name" placeholder="Inserisci il tuo nome">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email:</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Inserisci la tua email"
                @guest
                  value=""
                @else
                  value="{{ Auth::user()->email }}"
                @endguest
                >
              <small id="emailHelp" class="form-text text-muted">Non condivideremo la tua email con nessuno.</small>
            </div>
            <div class="form-group">
              <label for="subject">Oggetto:</label>
              <input type="text" class="form-control" name="subject" placeholder="Inserisci oggetto email">
            </div>
            <div class="form-group">
              <label for="message">Testo messaggio:</label>
              <textarea class="form-control" name="message" rows="6" placeholder="Scrivi un messaggio a proprietario di questo appartamento"></textarea>
            </div>
           <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        @endif

        @guest
        <a href="{{ route('home') }}" class="btn btn-danger">Torna alla home</a>
        @else
        <a href="{{ route('home') }}" class="btn btn-danger">Torna alla home</a>
          @if ($apartment->user_id == Auth::user()->id)
            <a href="{{ route('upr.apartments.edit', $apartment->id) }}" class="btn btn-warning">Modifica dati appartamento</a>
          @endif
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
