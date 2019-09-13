@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="ml-auto" action="{{ route('upr.apartments.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Quanto costa?</h3>
        <div class="form-group mt-5">
          <label>Servizi dell'appartamento</label>
          <div class="row justify-content-between">
            @foreach ($services as $service)
              <div class="col-4">
                <label>
                  <input class="form-check-input" type="checkbox" name="services[]"
                  value="{{ $service->id }}"
                  {{ in_array($service->id, old("services") ?: []) ? "checked": ""}}>
                  {{ $service->name }}
                </label>
              </div>
            @endforeach
          </div>
          @error('services')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
         <label for="main_img">Inserisci la foto principale dell'appartamento</label>
         <input type="file" name="main_img" class="form-control-file">
         @error('main_img')
             <div class="alert alert-danger">{{ $message }}</div>
         @enderror
       </div>

       {{-- group images --}}
        <div class="form-group mt-5">
          <label for="paths">Aggiungi alcune foto per rendere il tuo annuncio più accattivante
            <small>Seleziona almeno 4 immagini</small>
          </label>
          <input type="file" class="form-control-file" name="paths[]" placeholder="address" multiple>
          @error('paths')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          {{-- messaggio errore img multiple - funziona non benissimo --}}
          {{-- <div class="alert alert-danger">{{ $errors->has('paths') ? $errors->first('paths') : '' }}</div> --}}


        </div>

        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
          @error('price_per_night')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- public --}}
        <div class="form-group mt-5">
          <label for="is_public">Pubblico</label>
          <input type="radio" class="" id="is_public" name="is_public" value="1">
          <label for="is_public">Privato</label>
          <input type="radio" class="" id="is_public" name="is_public" value="0">
          @error('is_public')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        @endif

        <a href="{{ route('upr.apartments.create-step2') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">

      </form>
    </div>
  </div>
@endsection
