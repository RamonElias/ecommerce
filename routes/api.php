<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/products-list', 'Services\ProductsListController');

Route::post('/put-in-cart', 'Services\ManageCartController@fill')->middleware('auth:api');
Route::post('/charge-cart', 'Services\ManageCartController@charge')->middleware('auth:api');
Route::delete('/delete-cart-item', 'Services\ManageCartController@destroy')->middleware('auth:api');



