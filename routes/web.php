<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/email/{apartment_id}', 'MessageController@storeMessage')->name('store-message');
Route::get('/thankyou', 'MessageController@thankyou')->name('thankyou');

Route::namespace('Ui')->name('ui.')->group(function(){
  Route::resource('/user/apartments', 'ApartmentController');
});

Route::middleware('auth')->namespace('Upr')->name('upr.')->group(function(){

  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::resource('/apartments', 'ApartmentController');

  Route::get('/apartment/create-step1', 'ApartmentController@createStep1')->name('apartments.create-step1');
  Route::post('/apartment/create-step1', 'ApartmentController@postCreateStep1')->name('apartments.create-step1');

  Route::get('/apartment/create-step2', 'ApartmentController@createStep2')->name('apartments.create-step2');
  Route::post('/apartment/create-step2', 'ApartmentController@postCreateStep2')->name('apartments.create-step2');

  Route::get('/apartment/create-step3', 'ApartmentController@createStep3')->name('apartments.create-step3');

  // Route::get('/mymessages', 'UserMessageController@myMessages')->name('mymessages');

  Route::get('messages', 'ProfileController@showMessage')->name('all-messages');
});

Route::get('search-apartments','SearchApartments@inputSearch')->name('searchApartments');
// Route::get('/apartments/{apartment}', 'ApartmentController@show')->name('apartments.show');
