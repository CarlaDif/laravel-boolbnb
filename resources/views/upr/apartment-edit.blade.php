@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">

      <form class="w-50 ml-auto" action="{{ route('upr.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Inserisci i primi dati del tuo appartamento!</h3>
        {{-- title --}}
        <div class="form-group mt-5">
          <label for="title">Nome dell'appartamento</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci un nome del tuo appartamento" value="{{ old('title', $apartment->title) }}" >
        </div>
        {{-- address --}}
        <div class="form-group">
          <label for="address">Indirizzo</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Inserisci l'indirizzo del tuo appartamento" value="{{ old('address', $apartment->address) }}" >
        </div>
        {{-- description --}}
        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" rows="8" placeholder="Inserisci una breve descrizione per il tuo appartamento">{{ old('description', $apartment->description) }}</textarea>
        </div>
        {{-- n_rooms --}}
        <div class="form-group mt-5">
          <label for="n_rooms">Stanze</label>
          <input type="number" class="form-control" id="n_rooms" name="n_rooms" value="{{ old('n_rooms', $apartment->n_rooms) }}" >
        </div>
        {{-- n_single_beds --}}
        <div class="form-group mt-5">
          <label for="n_single_beds">Letti Singoli</label>
          <input type="number" class="form-control" id="n_single_beds" name="n_single_beds" value="{{ old('n_single_beds', $apartment->n_single_beds) }}" >
        </div>
        {{-- n_double_beds --}}
        <div class="form-group">
          <label for="n_double_beds">Letti Matrimoniali</label>
          <input type="number" class="form-control" id="n_double_beds" name="n_double_beds" value="{{ old('n_double_beds', $apartment->n_double_beds) }}" >
        </div>
        {{-- n_baths --}}
        <div class="form-group">
          <label for="n_baths">Numero di Bagni</label>
          <input type="number" class="form-control" id="n_baths" name="n_baths" value="{{ old('n_baths', $apartment->n_baths) }}" >
        </div>
        {{-- mq --}}
        <div class="form-group">
          <label for="mq">Metri quadrati</label>
          <input type="number" class="form-control" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}" >
        </div>
        {{-- services --}}
        <div class="form-group mt-5">
          <label>Servizi dell'appartamento</label>
          <div class="row justify-content-between">
            @foreach ($services as $service)
              <div class="col-4">
                <label>
                  <input type="checkbox" name="services[]"
                  value="{{ $service->id }}"
                  {{ in_array($service->id, old("services") ?: []) ? "checked": ""}}>
                  {{ $service->name }}
                </label>
              </div>
            @endforeach
          </div>
        </div>
        {{-- main_img --}}
        <div class="form-group">
         <label for="main_img">Inserisci una foto dell'appartamento</label>
         <input type="file" name="main_img" class="form-control-file">
       </div>
       {{-- price_per_night --}}
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
        </div>

        @if ($errors->any())
          <div class="alert alert-danger mt-4">
            @error('title')
                <li>Inserire il titolo dell'appartamento</li>
            @enderror
            @error('address')
                <li>Inserire l'indirizzo dell'appartamento</li>
            @enderror
            @error('description')
                <li>Inserire la descrizione dell'appartamento</li>
            @enderror
            @error('n_rooms')
                <li>Inserire il numero delle stanze</li>
            @enderror
            @error('n_single_beds')
                <li>Inserire numero letti singoli</li>
            @enderror
            @error('n_double_beds')
                <li>Inserire numero letti matrimoniali</li>
            @enderror
            @error('n_baths')
                <li>Inserire numero bagni</li>
            @enderror
            @error('mq')
                <li>Inserire metratura dell'appartamento</li>
            @enderror
            @error('price_per_night')
                <div class="alert alert-danger">{{ $message }}</div>
                <li>Inserire il prezzo a notte</li>
            @enderror
            @error('services')
                <li>Inserire almeno un servizio</li>
            @enderror
            @error('main_img')
                <li>Inserire un'immagine per l'appartamento</li>
            @enderror
          </div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Avanti" class="btn btn-success">
      </form>
    </div>
  </div>
@endsection
