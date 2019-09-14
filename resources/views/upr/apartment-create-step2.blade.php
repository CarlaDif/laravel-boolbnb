@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="ml-auto" action="{{ route('upr.apartments.create-step2') }}" method="post">
        @csrf
        <h3>Quante persone può ospitare il tuo alloggio?</h3>
        <div class="step-inserimento mb-4">
          <p>Passaggio 3 di 4</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
            </div>
          </div>
        </div>
        <div class="form-group mt-5">
          <label for="n_rooms">Stanze</label>
          <input type="number" class="form-control" id="n_rooms" name="n_rooms" value="{{ old('n_rooms') }}" >
          @error('n_rooms')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="n_single_beds">Letti Singoli</label>
          <input type="number" class="form-control" id="n_single_beds" name="n_single_beds" value="{{ old('n_single_beds') }}" >
          @error('n_single_beds')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="n_double_beds">Letti Matrimoniali</label>
          <input type="number" class="form-control" id="n_double_beds" name="n_double_beds" value="{{ old('n_double_beds') }}" >
          @error('n_double_beds')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="n_baths">Numero di Bagni</label>
          <input type="number" class="form-control" id="n_baths" name="n_baths" value="{{ old('n_baths') }}" >
          @error('n_baths')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="mq">Metri quadrati</label>
          <input type="number" class="form-control" id="mq" name="mq" value="{{ old('mq') }}" >
          @error('mq')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
        @endif

        <a href="{{ route('upr.apartments.create-step1') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Avanti" class="btn btn-success">

      </form>
    </div>
  </div>
@endsection
