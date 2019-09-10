@extends('layouts.app')
@section('content')
  <div class="container">
    <h2 class="mt-4 mb-4">I miei messaggi</h2>
    @foreach ($messages as $message)

    <div class="card">
      <div class="card-header">
        <div class="row justify-content-between">
          <p class="preview-message">Messaggio da: {{ $message->name }} - {{ $message->subject }} - {{ $message->message }}</p> <a class="btn btn-outline-info pull-right" data-toggle="modal" data-target="#exampleModalLong"> Visualizza Messaggio</a>
        </div>
      </div>
    </div>

    {{-- <div class="card">
      <div class="card-body">
        <p> Da: {{ $message->name }}</p>
        <small class="card-subtitle text-muted">email: {{ $message->email }} </small>
        <span class="card-text"> Oggetto: {{ $message->subject }} </span>
        <p> Testo: {{ $message->message }}</p>
      </div>
    </div> --}}

    @endforeach
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Messaggio da: {{ $message->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><small class="card-subtitle text-muted">[{{ $message->email }}]</small></p>
        <p class="card-text"> Oggetto: {{ $message->subject }} </p>
        <hr>
        <p> Testo: {{ $message->message }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>

@endsection
