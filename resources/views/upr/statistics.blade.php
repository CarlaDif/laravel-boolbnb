@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card mt-4">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5>{{ $apartment->title }}</h5></li>

            <li class="list-group-item">Stato sponsorizzazione: <b>Attivo</b>
              @if ($apartment->is_sponsored)
                <div class="row justify-content-between">
                  <div class="col-6">
                    <small class="text-right ml-auto">
                      Scade il: {{ $end }}
                      alle: {{ $orario_end }}
                    </small>
                  </div>
                </div>
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

            <li class="list-group-item">Numero visite: {{ Counter::showAndCount('apartmentdetail') }}</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <table class="table table-success mt-4"  style="border-radius:5px;">
          <thead>
            <tr>
              <th colspan="4" class="text-center">Storico delle sponsorizzazioni</th>
            </tr>
            <tr>
              <th>#</th>
              <th>Tipologia sponsorizzazione</th>
              <th>Data attivazione</th>
              <th>Costo</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sponsors as $key => $sponsor)
              <tr>
                <th>{{ $key+1 }}</th>
                <td>
                  @if ($sponsor->sponsor_type_id == '1')
                    {{ $tipo = 'Sponsozizzazione per 1 giorno' }}
                  @elseif ($sponsor->sponsor_type_id == '2')
                    {{ $tipo = 'Sponsozizzazione per 3 giorni' }}
                  @else
                    {{ $tipo = 'Sponsozizzazione per 6 giorni' }}
                  @endif
                </td>
                <td>{{ $sponsor->created_at->format('d-m-Y') }}</td>
                <td>
                  @if ($sponsor->sponsor_type_id == '1')
                    {{ $costo = '2.99 €' }}
                  @elseif ($sponsor->sponsor_type_id == '2')
                    {{ $costo = '5.99 €'}}
                  @else
                    {{ $costo = '9.99 €'}}
                  @endif
                </td>
              </tr>
            @endforeach
            <tr>
              <th><b>Totale:</b></th>
              <td></td>
              <td></td>
              <td><b>{{ $somma }} €</b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  {{-- {{ $sponsor }} --}}
@endsection
