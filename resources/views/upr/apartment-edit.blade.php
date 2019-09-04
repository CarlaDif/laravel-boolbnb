@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">

      <form class="w-50 ml-auto" action="{{ route('upr.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Modifica i dati del tuo appartamento!</h3>
        {{-- title --}}
        <div class="form-group mt-5">
          <label for="title">Nome dell'appartamento</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci un nome del tuo appartamento" value="{{ old('title', $apartment->title) }}" >
          @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- address --}}
        <div class="form-group">
          <label for="address">Indirizzo</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Inserisci l'indirizzo del tuo appartamento" value="{{ old('address', $apartment->address) }}" >
          @error('address')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- description --}}
        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" rows="8" placeholder="Inserisci una breve descrizione per il tuo appartamento">{{ old('description', $apartment->description) }}</textarea>
          @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- n_rooms --}}
        <div class="form-group mt-5">
          <label for="n_rooms">Stanze</label>
          <input type="number" class="form-control" id="n_rooms" name="n_rooms" value="{{ old('n_rooms', $apartment->n_rooms) }}">
          @error('n_rooms')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- n_single_beds --}}
        <div class="form-group mt-5">
          <label for="n_single_beds">Letti Singoli</label>
          <input type="number" class="form-control" id="n_single_beds" name="n_single_beds" value="{{ old('n_single_beds', $apartment->n_single_beds) }}">
          @error('n_single_beds')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- n_double_beds --}}
        <div class="form-group">
          <label for="n_double_beds">Letti Matrimoniali</label>
          <input type="number" class="form-control" id="n_double_beds" name="n_double_beds" value="{{ old('n_double_beds', $apartment->n_double_beds) }}">
          @error('n_double_beds')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- n_baths --}}
        <div class="form-group">
          <label for="n_baths">Numero di Bagni</label>
          <input type="number" class="form-control" id="n_baths" name="n_baths" value="{{ old('n_baths', $apartment->n_baths) }}">
          @error('n_baths')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- mq --}}
        <div class="form-group">
          <label for="mq">Metri quadrati</label>
          <input type="number" class="form-control" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}">
          @error('mq')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- services --}}
        <div class="form-group mt-5">
          <label>Servizi dell'appartamento</label>
          <div class="row justify-content-between">
            @foreach ($services as $service)
              <div class="col-4">
                <label>
                  <input type="checkbox" name="services[]"
                  value="{{ $service->id }}"{{ in_array($service->id, old("services") ?: []) ? "checked": ""}}>
                  {{ $service->name }}
                </label>
              </div>
            @endforeach
          </div>
          @error('services')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- main_img --}}
        <div class="form-group">
         <label for="main_img">Inserisci una foto dell'appartamento</label>
         <input type="file" name="main_img" class="form-control-file">
         @error('main_img')
             <div class="alert alert-danger">{{ $message }}</div>
         @enderror
       </div>

       {{-- price_per_night --}}
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
          @error('price_per_night')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">
      </form>
    </div>
  </div>
@endsection
