@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-8 mt-5">
      <form class="ml-auto" action="{{ route('upr.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
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
        
        {{-- indirizzo --}}
        <div class="form-group">
          <div class="tt-search-box-search-icon form-group has-search mt-auto mb-auto position-relative">
            <div class="form-group">
              <label>Paese</label>
              <input type="text" name="country" value="{{ old('country', $apartment->country) }}" class="tt-search-box-input country form-control" placeholder="Paese">
            </div>

            <div class="form-group">
              <label>Via</label>
              <input type="text" name="place" value="{{ old('address', $apartment->address) }}" class="tt-search-box-input form-control input-address" placeholder="Indirizzo">
            </div>

            <div class="bootstrap-select-wrapper position-absolute w-100">
              <div class="tendina">
                {{-- select che restituisce il codice della nazione --}}
                <select class="list_results custom-select" name="" multiple></select>
              </div>
            </div>

            <div class="form-group">
              <label>Città</label>
              <input type="text" name="city" value="" class="form-control" placeholder="Città">
            </div>

            <div class="form-group">
              <label>Regione</label>
              <input type="text" name="regione" value="" class="form-control" placeholder="Regione">
            </div>

            <div class="form-group">
              <label>CAP</label>
              <input type="text" name="cap" value="" class="form-control" placeholder="CAP">
            </div>

            {{-- input hidden --}}
            <input type="hidden" value="" name="address">
            <input type="hidden" value="{{ old('latitude', $apartment->latitude) }}" id="latitude_hidden" name="latitude">
            <input type="hidden" value="{{ old('longitude', $apartment->longitude) }}" id="longitude_hidden" name="longitude">
          </div>
          @error('address')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- description --}}
        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" rows="9" placeholder="Inserisci una breve descrizione per il tuo appartamento">{{ old('description', $apartment->description) }}</textarea>
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
        <div class="form-group">
          <label>Servizi dell'appartamento</label>
          <div class="row justify-content-between">
            @foreach ($services as $service)
              <div class="col-4">
                <label>
                  <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}"
                    @foreach ($apartment_services as $apartment_service)
                      @if ($apartment_service->service_id == $service->id)
                        checked
                      @endif
                    @endforeach
                  >
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

       {{-- group images --}}
        <div class="form-group mt-5">
          <label>Seleziona alcune foto per rendere il tuo annuncio più accattivante</label>
          <input required type="file" class="form-control-file" name="paths[]" placeholder="address" multiple>
          @error('paths')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

       {{-- price_per_night --}}
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $apartment->price_per_night) }}">
          @error('price_per_night')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- public --}}

        <div class="form-group mt-5">
          <label for="is_public">Pubblico</label>
          <input type="radio" class="" id="is_public" name="is_public" value="1" {{ ($apartment->is_public == 1) ? 'checked' : ''}} >
          <label for="is_public">Privato</label>
          <input type="radio" class="" id="is_public" name="is_public" value="0" {{ ($apartment->is_public == 0) ? 'checked' : ''}}>
          @error('is_public')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">
      </form>
    </div>
  </div>
@endsection
