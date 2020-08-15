<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

 
Route::get('/product', 'ProductController@getProducts')->middleware('cors');

Route::post('/order', 'OrderController@create')->middleware('cors');

Route::get('/currency', 'CurrencyController@getAvailableCurrencies')->middleware('cors');

