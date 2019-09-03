@extends('layouts.form')

@section('content')
  <div class="container-fluid d-flex">
    <div class="col-md-7 mt-5">
      <form class="w-50 ml-auto" action="{{ route('upr.apartments.create-step2') }}" method="post">
        @csrf
        <h3>Quante persone può ospitare il tuo alloggio?</h3>
        <div class="form-group mt-5">
          <label for="n_rooms">Stanze</label>
          <input type="number" class="form-control" id="n_rooms" name="n_rooms" value="{{ old('n_rooms') }}" >
        </div>
        <div class="form-group mt-5">
          <label for="n_single_beds">Letti Singoli</label>
          <input type="number" class="form-control" id="n_single_beds" name="n_single_beds" value="{{ old('n_single_beds') }}" >
        </div>
        <div class="form-group">
          <label for="n_double_beds">Letti Matrimoniali</label>
          <input type="number" class="form-control" id="n_double_beds" name="n_double_beds" value="{{ old('n_double_beds') }}" >
        </div>
        <div class="form-group">
          <label for="n_baths">Numero di Bagni</label>
          <input type="number" class="form-control" id="n_baths" name="n_baths" value="{{ old('n_baths') }}" >
        </div>
        <div class="form-group">
          <label for="mq">Metri quadrati</label>
          <input type="number" class="form-control" id="mq" name="mq" value="{{ old('mq') }}" >
        </div>

        <a href="{{ route('upr.apartments.create-step1') }}" class="btn btn-danger">Indietro</a>
        <input type="submit" value="Avanti" class="btn btn-success">

        @if ($errors->any())
          <div class="alert alert-danger mt-4">
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
          </div>
        @endif


      </form>
    </div>
  </div>
@endsection
