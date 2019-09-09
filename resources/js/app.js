/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

$(document).ready(function(){

  Vue.component('example-component', require('./components/ExampleComponent.vue').default);

  /**
   * Next, we will create a fresh Vue application instance and attach it to
   * the page. Then, you may begin adding components to this application
   * or customize the JavaScript scaffolding to fit your unique needs.
   */

  const app = new Vue({
      el: '#app',
  });

  var $ = require('jquery');

  var template_html_select_one = $('#entry-template_select_one').html();
  var template_function_select_one = Handlebars.compile(template_html_select_one);

  $('.tt-search-box-input').keyup(function() {
    $('.tendina .list_results').empty();
    var input = this.value;
    // $('#output').val(input);
    // $('.tendina').toggleClass('d-none');
    console.log(input);
    tt.services.fuzzySearch({
      key: 'hnv7SvjzVtjVwSfr7a4r73AfxNk04jgL',
      //la query sarà una variabile ricevuta dall'input
      query: input,
      typeahead: true,
    })
    .go()
    .then(function(response) {
      for (var i = 0; i < 5; i++) {
        //new tt.Marker().setLngLat(response.results[0].position).addTo(map);
        console.log(response.results[i]);
        //console.log(response.results[i].address.municipality);
        var variabile_hldbar_one = {
          //'places': '<a class="">' + response.results[i].address.municipality + '</a>',
          'places': response.results[i].address.municipality,
          'streetName': response.results[i].address.streetName,
          'lng': response.results[i].position.lng,
          'lat': response.results[i].position.lat,
          'position': response.results[i].position,
          'country': response.results[i].address.country
        };
        //console.log(variabile_hldbar_one);
        var html_finale_select_one = template_function_select_one(variabile_hldbar_one);
        $('.list_results').append(html_finale_select_one);
        //var latitude = response.results[0].position.lat;
        //console.log(latitude);
        //fine for
      }
      //fine then
    });
  //fine funzione keyup
  });

  $('.bt_cerca').click(function(){
    var via = $('.scelto').attr('data-via');
    console.log(via);
    var lng_place = $('.list_results').val();
    var lng_int = parseFloat(lng_place);
    var lat_place = $('.scelto').attr('data-lat');
    var lat_place_int = parseFloat(lat_place);
    console.log(lng_int);
    console.log(lat_place_int);
    $("input[type=hidden][name=latitude]").val(lat_place_int);
    $("input[type=hidden][name=longitude]").val(lng_int);
    $("input[type=hidden][name=address]").val(via);
  //fine click
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
    key: 'hnv7SvjzVtjVwSfr7a4r73AfxNk04jgL',
    container: 'map',
    style: 'tomtom://vector/1/basic-main',
    //prima longitudine poi latitudine indirizzo boolean
    center: [longitude_details, latitude_details],
    //regolare lo zoom sul punto trovato
    zoom: 12,
 });

 var marker = new tt.Marker().setLngLat([longitude_details, latitude_details]).addTo(map);

});

/*-------------------------------------NAV SEARCH----------------------------------*/

$('.has-search input').click(function(){
  $('.has-search').find('.sub-menu').toggle();
})

// ----------------------CLose panel Sub-menu
$('.has-search .close').click(function(){
  $('.has-search').find('.sub-menu').toggle();
})

//------------------------Visualizzazione Filtro Appartamento
$('a[data-menu-filter="Appartamenti"]').click(function(){
  $('.has-search').find('.sub-menu').toggle();
  $('.filter-menu').toggle();
})

$('.price').click(function(){
  $(this).find('.price_menu').show();
})

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
