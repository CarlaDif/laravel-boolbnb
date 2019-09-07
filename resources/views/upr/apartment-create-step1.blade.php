@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="w-50 ml-auto" action="{{ route('upr.apartments.create-step1') }}" method="post">
        @csrf
        <h3>Inserisci i primi dati del tuo appartamento!</h3>
        <div class="form-group mt-5">
          <label for="title">Nome dell'appartamento</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci un nome del tuo appartamento" value="{{ old('title') }}" >
          @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="address">Indirizzo</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Inserisci l'indirizzo del tuo appartamento" value="{{ old('address') }}" >
          @error('address')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" rows="8" placeholder="Inserisci una breve descrizione per il tuo appartamento">{{ old('description') }}</textarea>
          @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        @endif

        <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Avanti" class="btn btn-success">
      </form>
    </div>
  </div>
@endsection
