@extends('layouts.app')

@section('content')
  <div class="container">
    QUESTA é la home da loggati!!!!!!!!
    <h1>Ciao {{ $user->name }} </h1>
  </div>
@foreach ($apartments as $apartment)
  <div class="">
    {{ $apartment->address }}
  </div>
@endforeach
@endsection
