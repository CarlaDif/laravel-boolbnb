<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Handlebars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                {{-- -------------------------------SEARCH BAR------------------------------}}
                 <div class="form-group has-search mt-auto mb-auto position-relative">
                   <span class="fa fa-search form-control-feedback"></span>
                   <input type="text" class="form-control" placeholder="Type for Search">
                   <div class="sub-menu position-absolute p-3">
                     <p class="">ESPLORA THE BOOLBNB</p>
                     <span class="close"><i class="far fa-times-circle"></i></span>
                     <div class="">
                       <a class="btn btn btn-outline-dark mr-2 mt-2" type="button" name="button">Tutto</a>
                       <a class="btn btn btn-outline-dark mr-2 mt-2" type="button" name="button">Soggiorni</a>
                       <a class="btn btn btn-outline-dark mr-2 mt-2" type="button" name="button">Esperienze</a>
                       <a class="btn btn btn-outline-dark mr-2 mt-2" type="button" name="button">Avventure</a>
                       <a class="btn btn btn-outline-dark mr-2 mt-2" type="button" data-menu-filter="Appartamenti" name="button">Appartamenti</a>
                       <div>
                         <small>*funziona solo appartamneti</small>
                       </div>
                     </div>
                   </div>
                 </div>
                 {{-- -------------------------------FINE SEARCH BAR------------------------------}}

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Diventa un Host</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  Diventa un Host
                              </a>


                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('upr.apartments.create-step1') }}">Pubblica il tuo annuncio</a>
                              </div>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="">Salvati</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="">Viaggi</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="">Messaggi</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="">Aiuto</a>
                          </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('upr.profile') }}">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

      {{-- --------------------------------------FIlter-MENU--------------------------- --}}
       <div class="container-fluid filter-menu my-3">
          <div class="links">
            <a href="#" class="btn btn-sm btn-outline-secondary" >Date</a>
            <a href="#" class="btn btn-sm btn-outline-secondary" >Ospiti</a>
            <a href="#" class="btn btn-sm btn-outline-secondary" >Viaggio Di Lavoro</a>
            <a href="#" class="btn btn-sm btn-outline-secondary" >Tipo Di Alloggio</a>
            <span class="position-relative price">
              <a href="#" class="btn btn-sm btn-outline-secondary" >Prezzo</a>
              <div class="price_menu position-absolute">
                <input
                type="range"
                min="10"
                max="1000"
                step="10"
                value="300"
                id="range_price">
              </div>
            </span>
            <a href="#" class="btn btn-sm btn-outline-secondary" >Prenotazione Immediata</a>
            <a href="#" class="btn btn-sm btn-outline-secondary" >Piu Filtri</a>
          </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script id="apartment_template" type="text/x-handlebars-template">
     <!-- <div>
       <a href="@{{address}}">
         <div class="card" style="width: 17rem;">
           <img src="#" class="card-img-top" alt="Anteprima Appartamento">
           <div class="card-body">
             <h5 class="card-title">@{{ title }}</h5>
           </div>
         </div>
       </a>
     </div> -->

     <a href=
     @guest
       "{{ route('ui.apartments.show', $apartment->id) }}"
     @else
       "{{ route('upr.apartments.show', $apartment->id) }}"
     @endguest
     >
     <div class="card mt-3" style="width: 16rem;">
       @if (!empty($apartment->main_img))
         <img src="{{{ asset( @{{ main_img }}) }}}" class="card-img-top" alt="Anteprima Appartamento">
       @else
         <img src="https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/6/3/5/235361-6-eng-GB/System-Logistics-Spa-SIC-Food-20142.jpg" class="card-img-top" alt="Anteprima non disponibile">
       @endif
         <div class="card-body">
           <h5 class="card-title">@{{ title }}</h5>
           <p>@{{ address }}</p>
         </div>
       </div>
     </a>

   </script>
  </body>
</html>
