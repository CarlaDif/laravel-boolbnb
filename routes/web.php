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

Route::middleware('auth')->namespace('upr')->name('upr.')->group(function(){

  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::resource('apartments', 'ApartmentController');

  Route::get('/apartment/create-step1', 'ApartmentController@createStep1')->name('apartments.create-step1');
  Route::post('/apartment/create-step1', 'ApartmentController@postCreateStep1')->name('apartments.create-step1');

  Route::get('/apartment/create-step2', 'ApartmentController@createStep2')->name('apartments.create-step2');
  Route::post('/apartment/create-step2', 'ApartmentController@postCreateStep2')->name('apartments.create-step2');

  Route::get('/apartment/create-step3', 'ApartmentController@createStep3')->name('apartments.create-step3');

});
