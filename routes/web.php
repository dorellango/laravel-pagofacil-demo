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

Route::get('/', 'WelcomeController');

Route::middleware(['auth'])->group(function () {
    Route::resource('orders', 'OrdersController');
    Route::get('place-order', 'PlaceOrderController')->name('place-order');
    Route::post('checkout/complete', 'CheckoutPaymentController@complete');
    Route::get('checkout/cancel', 'CheckoutPaymentController@cancel');
    Route::get('checkout/process/{order}', 'CheckoutProcessController')->name('checkout.process');
});

Route::post('checkout/callback', 'CheckoutPaymentController@callback');

Route::get('cart', 'CartController@show')->name('cart.show');
Route::get('cart/{product}/add/{quantity?}', 'AddToCartController')->name('cart.add');
Route::get('cart/{product}/remove', 'RemoveFromCartController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
