@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="w-50 ml-auto" action="{{ route('upr.apartments.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Quanto costa?</h3>
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
        <div class="form-group">
         <label for="main_img">Inserisci una foto dell'appartamento</label>
         <input type="file" name="main_img" class="form-control-file">
       </div>
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
        </div>

        <a href="{{ route('upr.apartments.create-step2') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">

        @if ($errors->any())
          <div class="alert alert-danger mt-4">
            @error('price_per_night')
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
      </form>
    </div>
  </div>
@endsection