

require('./bootstrap');

window.Vue = require('vue');


$(document).ready(function(){

    Vue.component('example-component', require('./components/ExampleComponent.vue').default);
    const app = new Vue({
        el: '#app',
    });

    var $ = require('jquery');
    // --------------------------------------SEARCH FILTER-------------------------------------
    //------------------------------------------------------------------------------------------
    $('.search_filter').click(function(){
      $('.search_filter').siblings('.sub_filter').hide();
      $(this).next('.sub_filter').show();
    });
    //---controller add filter beds..
    $('.fa-plus-circle').click(function(){
      count = $(this).prev('.count').val();
      add = parseInt(count) + 1;
      $(this).prev('.count').val(add);
      $(this).prev('.count').attr('value', add);
    });
    $('.fa-minus-circle').click(function(){
      count = $(this).next('.count').val();
      if(count!=0){
        less = parseInt(count) - 1;
        $(this).next('.count').val(less);
        $(this).next('.count').attr('value', less);
      }
   });
   $('.save_filter').click(function(){
      $('.search_filter').next('.sub_filter').hide();
      $(this).closest('.search_filter').find('.ux_filter_result').css('font-weight', 'bold');

      count = $(this).closest('.count').val();
      // console.log(count);
      if(count == 0){
        $(this).closest('.sub_filter').siblings('.search_filter').removeClass('btn-secondary').addClass('btn-outline-secondary');
      } else {
        $(this).closest('.sub_filter').siblings('.search_filter').addClass('btn-secondary').removeClass('btn-outline-secondary');
      }
   })


    // --------------------------------------ENDSEARCH FILTER-------------------------------------
    // ------------------------------------------------------------------------.----------------

    var template_html_select_one = $('#entry-template_select_one').html();
    var template_function_select_one = Handlebars.compile(template_html_select_one);
    // var template_html_select_two = $('#entry-template_select_two').html();
    // var template_function_select_two = Handlebars.compile(template_html_select_two);
    $('.tendina').hide();

    $('.input-address').on('keyup', function(){
      $('.tendina').show();
    }).off('click', function(){
      $('.tendina').hide();
    });

    $('.tt-search-box-input').keyup(function() {
      $('.tendina .list_results').empty();
      var input = this.value;
      var country = $('.country').val();
      // console.log(input);
      tt.services.fuzzySearch({
        key: '0N3hABOJffswv4qPJ9Y5GjKfzDhRQrLA',
        countrySet: country,
        //la query sarà una variabile ricevuta dall'input
        query: input,
        typeahead: true,
      })
      .go()
      .then(function(response) {
        for (var i = 0; i < 5; i++) {
          var variabile_hldbar_one = {
            'country': response.results[i].address.country,
            'city': response.results[i].address.municipality,
            'streetName': response.results[i].address.streetName,
            'streetNumber': response.results[i].address.streetNumber,
            'countrySubdivision': response.results[i].address.countrySubdivision,
            'postalCode': response.results[i].address.postalCode,
            'lng': response.results[i].position.lng,
            'lat': response.results[i].position.lat,
            'position': response.results[i].position,
          };
          var html_finale_select_one = template_function_select_one(variabile_hldbar_one);
          // var html_finale_select_two = template_function_select_two(variabile_hldbar_one);
          $('.list_results').append(html_finale_select_one);
          // $('.country_results').append(html_finale_select_two);
        }   //fine for
      }); //fine then
    }); //fine funzione keyup

   $('.list_results').click(function(){
      var via = $('.list_results option:selected').attr('data-address');
      var lng_place = $('.list_results').val();
      var lng_int = parseFloat(lng_place);
      var lat_place = $('.list_results option:selected').attr('data-lat');
      var lat_place_int = parseFloat(lat_place);
      var city = $('.list_results option:selected').attr('data-city');
      var regione = $('.list_results option:selected').attr('data-countrySubdivision');
      var cap = $('.list_results option:selected').attr('data-postalCode');
      var paese = $('.list_results option:selected').attr('data-country');
      var civico = $('.list_results option:selected').attr('data-streetNumber');
      $('input[type=hidden][name=latitude]').val(lat_place_int);
      $('input[type=hidden][name=longitude]').val(lng_int);
      $('input[type=text][name=place]').val(via + ' ' + civico + ', ' + city + ' - ' + paese);
      $('input[type=text][name=city]').val(city);
      $('input[type=text][name=regione]').val(regione);
      $('input[type=text][name=cap]').val(cap);
      $('input[type=hidden][name=address]').val(via + ' ' + civico + ', ' + city + ' - ' + paese);
      $('.tendina').hide();
    //fine click
    });

    $('.bt_cerca').click(function(){
      var via = $('.list_results option:selected').attr('data-address');
      var city = $('.list_results option:selected').attr('data-city');
      // var country = $('.list_results option:selected').attr('data-country');
      var paese = $('.list_results option:selected').attr('data-country');
      var lng_place = $('.list_results').val();
      var lng_int = parseFloat(lng_place);
      var lat_place = $('.list_results option:selected').attr('data-lat');
      var lat_place_int = parseFloat(lat_place);
      $('input[type=text][name=city]').val(city);
      $("input[type=hidden][name=latitude]").val(lat_place_int);
      $("input[type=hidden][name=longitude]").val(lng_int);
      $("input[type=hidden][name=address]").val(via + ' ' + civico + ', ' + city + ' - ' + paese);

      if (!city || !lng_int || !lat_place_int) {
        //option non selected
        var prima_option = $('.list_results option:first').attr('selected', 'selected');
        var prima_option_via = prima_option.attr('data-address');
        var prima_option_city = prima_option.attr('data-city');
        var prima_option_country = prima_option.attr('data-country');
        var prima_option_lng_place = $('.list_results').val();
        var prima_option_lng_int = parseFloat(prima_option_lng_place);
        var prima_option_lat_place = prima_option.attr('data-lat');
        var prima_option_lat_int = parseFloat(prima_option_lat_place);
        $('input[type=text][name=city]').val(prima_option_city);
        $("input[type=hidden][name=latitude]").val(prima_option_lat_int);
        $("input[type=hidden][name=longitude]").val(prima_option_lng_int);
        $("input[type=hidden][name=address]").val(prima_option_via);
      }

   }); //fine click

    //avanzamento valori slider raggio
    $('#id_raggio').click(function(){
      var slider_raggio = (document.getElementById('id_raggio'));
      var output_raggio = document.getElementById('km');
      output_raggio.innerHTML = slider_raggio.value;
      slider_raggio.oninput = function() {
        output_raggio.innerHTML = this.value;
      }
    });

    // avanzamento valori slider prezzo
    $('#id_prezzo').click(function(){
      var slider_prezzo = (document.getElementById('id_prezzo'));
      var output_prezzo = document.getElementById('prezzo');
      output_prezzo.innerHTML = slider_prezzo.value;
      slider_prezzo.oninput = function() {
        output_prezzo.innerHTML = this.value;
      }
    });

   //SEZIONE DETTAGLI APPARTAMENTO
   //recupero valore lat e long ecuperati dall'input hidden del file
   //blade a cui ho mandato dati dal database
   var latitude_details = $('.latitude_details').val();
   // var latitude_details_int = parseFloat(latitude_details);
   // console.log(latitude_details_int);
   var longitude_details = $('.longitude_details').val();
   // var longitude_details_int = parseFloat(longitude_details);
   // console.log(longitude_details_int);
   //e inserisco lat e long nella funzione tomtom
   tt.setProductInfo('com.company-name.product-name', '4.47.6');
   var map = tt.map({
      key: '0N3hABOJffswv4qPJ9Y5GjKfzDhRQrLA',
      container: 'map',
      style: 'tomtom://vector/1/basic-main',
      //prima longitudine poi latitudine indirizzo boolean
      center: [longitude_details, latitude_details],
      //regolare lo zoom sul punto trovato
      zoom: 12,
   });

   var marker = new tt.Marker().setLngLat([longitude_details, latitude_details]).addTo(map);

  /*-------------------------------------NAV SEARCH----------------------------------*/

  $('.has-search input').click(function(){
    $('.has-search').find('.sub-menu').toggle();
  });

  // ----------------------CLose panel Sub-menu
  $('.has-search .close').click(function(){
    $('.has-search').find('.sub-menu').toggle();
  });

  //------------------------Visualizzazione Filtro Appartamento
  $('a[data-menu-filter="Appartamenti"]').click(function(){
    $('.has-search').find('.sub-menu').toggle();
    $('.filter-menu').toggle();
  });

  $('.price').click(function(){
    $(this).find('.price_menu').show();
  });

  // ----------------------------------ATTIVATIONE SEARCH LIVE--------------

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.has-search input').keyup(function(){
    var query = $(this).val();
    console.log(query);
    $.ajax({
      url:"search-apartments",
      method: 'GET',
      data:{
        'apartment_name': query,
      },
      success: function(response){
        console.log(query);
        $('#apartments').empty();
        n = response['search'].length;
        for (var i = 0; i < n; i++) {
          var apartment_template = $('#apartment_template').html();
          var print_apartment_template = Handlebars.compile(apartment_template);
          title = response['search'][i]['title'];
          id = response['search'][i]['id'];
          main_img = response['search'][i]['main_img'];

          var apartments_property = {
            'title':title,
            'address': 'user/apartments/'+id,
            'main_img': '/storage/' + main_img
          }
          $('#apartments').append(print_apartment_template(apartments_property));
        }//for
      }//Success
    });// AJAX
  });// keyup


});//READY DOCUMENT
