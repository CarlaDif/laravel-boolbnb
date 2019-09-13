<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='viewport'content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Script Tom Tom -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.27.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.27.0/services/services-web.min.js"></script>
    <script src="{{ asset('sdk/web-sdk-services/dist/services-web.min.js') }}"></script>
    <script src="{{ asset('sdk/tomtom.min.js') }}"></script>

    <!-- Handlebars -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('storage/logo/b-logo.png') }}">

    <!-- Styles -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.27.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href="{{ asset('sdk/map.css') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img style="height: 35px;" src="{{ asset('storage/logo/b-logo.png') }}" alt="">
                    {{-- {{ config('app.name', 'BoolBnB') }} --}}
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
  <script id="entry-template_select_one" type="text/x-handlebars-template">
    <option value="@{{ lng }}" data-lat="@{{ lat }}" data-city="@{{ city }}" data-streetNumber="@{{ streetNumber }}" data-countrySubdivision="@{{ countrySubdivision }}" data-postalCode="@{{ postalCode }}" data-country="@{{ country }}" data-address="@{{ streetName }}" class="scelto">@{{ streetName }} @{{ streetNumber }} @{{ city }}</option>
  </script>
  {{-- script braintree --}}
  <script src="https://js.braintreegateway.com/web/dropin/1.20.1/js/dropin.min.js"></script>
  <script>
      var form = document.querySelector('#payment-form');
      var client_token = '{{ $token }}';

      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
          flow: 'vault'
        }
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          return;
        }
        form.addEventListener('submit', function (event) {
          event.preventDefault();

          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.log('Request Payment Method Error', err);
              return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
          });
        });
      });
  </script>
  {{-- <script id="entry-template_select_two" type="text/x-handlebars-template">
    <option value="@{{ lng }}" data-lat="@{{ lat }}" data-city="@{{ city }}" class="">@{{ country }}</option>
  </script> --}}
</body>
</html>
