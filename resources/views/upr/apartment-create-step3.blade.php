@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="w-50 ml-auto" action="{{ route('upr.apartments.store') }}" method="post">
        @csrf
        <h3>Quanto costa?</h3>
        <div class="form-group mt-5">
          <label for="price_per_night">Prezzo a persona per una notte</label>
          <input type="number" class="form-control" id="price_per_night" name="price_per_night">
        </div>

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Salva" class="btn btn-success">

        {{-- <a href="{{ route('upr.apartments.bed') }}" class="btn btn-success">Avanti</a> --}}
      </form>
    </div>
  </div>
@endsection
