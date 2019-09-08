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
