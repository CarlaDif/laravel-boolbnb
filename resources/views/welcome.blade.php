@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>QUESTA é HOME VISIBILE DA TUTTI!!!!!!!!</h1>
    @foreach ($apartments as $apartment)
      <div class="">
        {{ $apartment->address }}
      </div>
    @endforeach
  </div>
@endsection
