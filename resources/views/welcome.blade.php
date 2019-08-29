@extends('layouts.app')

@section('content')
  <div class="container">
    QUESTA é HOME VISIBILE DA TUTTI!!!!!!!!
  </div>
@foreach ($apartments as $apartment)
  <div class="">
    {{ $apartment->address }}
  </div>
@endforeach
@endsection
