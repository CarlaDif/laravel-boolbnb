@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="w-50 ml-auto" action="{{ route('upr.apartments.store') }}" method="post">
        @csrf
        <h3>Quanto costa?</h3>
        <div class="form-group mt-5">
          <label>Servizi dell'appartamento</label>
          @foreach ($services as $service)
            <br>
            <label><input type="checkbox" name="services[]" value="{{ $service->id }}">{{ $service->name }}</label>
          @endforeach
        </div>
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
        </div>

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">

        {{-- <a href="{{ route('upr.apartments.bed') }}" class="btn btn-success">Avanti</a> --}}

        @if ($errors->any())
          <div class="alert alert-danger mt-4">
            @error('price_per_night')
                <li>Inserire il prezzo a notte</li>
            @enderror
          </div>
        @endif
      </form>
    </div>
  </div>
@endsection
