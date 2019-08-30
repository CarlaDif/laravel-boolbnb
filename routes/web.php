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
  // Route::get('/', 'HomeController@index')->name('home_upr');
  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::resource('users', 'ApartmentController');
});
