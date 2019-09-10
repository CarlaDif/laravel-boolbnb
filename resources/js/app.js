

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
      $(this).find('.sub_filter').show();
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
      $(this).closest('.sub_filter').hide();
      $(this).closest('.search_filter').find('.ux_filter_result').text('ok').css('font-weight', 'bold');
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
      console.log(input);
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
      var lat_place = $('.list_results option:selected').attr('data-lat');
      var city = $('.list_results option:selected').attr('data-city');
      var regione = $('.list_results option:selected').attr('data-countrySubdivision');
      var cap = $('.list_results option:selected').attr('data-postalCode');
      var paese = $('.list_results option:selected').attr('data-country');
      var civico = $('.list_results option:selected').attr('data-street-number');
      $('input[type=hidden][name=latitude]').val(lat_place_int);
      $('input[type=hidden][name=longitude]').val(lng_int);
      $('input[type=text][name=place]').val(via + ' ' + civico + ', ' + city + '-' + paese);
      $('input[type=text][name=city]').val(city);
      $('input[type=text][name=regione]').val(regione);
      $('input[type=text][name=cap]').val(cap);
      $('input[type=hidden][name=address]').val(via + ' ' + civico + ', ' + city + '-' + paese);
      $('.tendina').hide();
    //fine click
    });

    $('.bt_cerca').click(function(){
      var via = $('.list_results option:selected').attr('data-address');
      var city = $('.list_results option:selected').attr('data-city');
      var country = $('.list_results option:selected').attr('data-country');
      var lng_place = $('.list_results').val();
      var lng_int = parseFloat(lng_place);
      var lat_place = $('.list_results option:selected').attr('data-lat');
      var lat_place_int = parseFloat(lat_place);
      var city = $('.list_results option:selected').attr('data-city');
      $('input[type=text][name=city]').val(city);
      $("input[type=hidden][name=latitude]").val(lat_place_int);
      $("input[type=hidden][name=longitude]").val(lng_int);
      $("input[type=hidden][name=address]").val();
   }); //fine click


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
