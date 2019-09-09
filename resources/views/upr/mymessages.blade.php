@extends('layouts.app');
@section('content')
  <div class="container">
    <h2>pagina dei messaggi utente</h2>
    @foreach ($messages as $message)

    <div class="card">
      <div class="card-body">
        <p> Da: {{ $message->name }}</p>
        <small class="card-subtitle text-muted">email: {{ $message->email }} </small>
        <span class="card-text"> Oggetto: {{ $message->subject }} </span>
        <p> Testo: {{ $message->message }}</p>
      </div>
    </div>

    @endforeach
  </div>
@endsection