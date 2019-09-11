@extends('layouts.app')
@section('content')
  <div class="container">
    <h2 class="mt-4 mb-4 titolo-messaggi">I miei messaggi</h2>
    @foreach ($messages as $message)

    <div class="card message-card">
      <div class="card-header">
        <div class="row justify-content-between">
          <p class="preview-message">Da: {{ $message->name }} - {{ $message->subject }} - {{ $message->message }}</p> <a class="btn btn-outline-info pull-right visualizza-messaggio" data-toggle="modal" data-target="#modal{{ $message->id }}"> Leggi</a>

		 </div>
      </div>
    </div>

    @endforeach
  </div>

  @foreach ($messages as $message)
    <!-- Modal -->
    <div class="modal fade" id="modal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
  @endforeach
@endsection
