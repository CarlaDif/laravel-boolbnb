@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-8">
      <div class="card mt-4">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">ID Appartamento: {{ $apartment->id }}</li>

          <li class="list-group-item">Stato sponsorizzazione:
            @if ($apartment->is_sponsored)
              <b>Attivo</b>
              <span>Scade il:
                @foreach ($sponsors as $sponsor)
                  {{ $sponsor->sponsor_end_at }}
                @endforeach
              </span>
            @else
              <b>Inattivo</b>
            @endif
          </li>

          <li class="list-group-item">Stato pubblicazione:
            @if ($apartment->is_public)
              <b>Pubblico</b>
            @else
              <b>Privato</b>
            @endif
          </li>

          <li class="list-group-item">Totale costi sponsorizzazione per questo appartamento:

          </li>

          <li class="list-group-item">Numero visite: {{ Counter::showAndCount('apartmentdetail') }}</li>
        </ul>
      </div>
    </div>
  </div>
  {{-- {{ $sponsor }} --}}
@endsection
