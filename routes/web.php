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

Route::pattern('id', '[0-9]+');

Route::get('/', 'OrderController@index')->name('orders.all');

Route::get('weather', 'WeatherController')->name('weather');
Route::get('products', 'ProductController@index')->name('products');

Route::put('products/{id}', 'ProductController@update')->name('products.update');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], static function () {
    Route::get('{id}/edit', 'OrderController@edit')->name('edit');
    Route::put('{id}', 'OrderController@update')->name('update');
});
