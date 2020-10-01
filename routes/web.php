<?php

// secretpassw

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{product}', 'ProductController@show')->middleware('auth');

Route::get('/checkout', 'CartController@index')->middleware('auth');
