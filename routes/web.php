<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ProductController@index');

//Route::get('cart', 'ProductController@cart');
Route::get('add-to-cart/{id}', 'ProductController@addToCart');

//order-cart routes
Route::get('add-to-order-cart/{id}', 'OrderCartController@addToOrderCart')->name('orderCart.store');
Route::get('order-cart', 'OrderCartController@orderCart')->name('orderCart.index');
Route::patch('update-order-cart', 'OrderCartController@update')->name('orderCart.update');
Route::delete('remove-from-order-cart', 'OrderCartController@remove')->name('orderCart.delete');
Route::get('clear-order-cart','OrderCartController@clear')->name('orderCart.clear');

// wishlist-cart routes
Route::get('add-to-wish-list-cart/{id}', 'WishListCartController@addToWishListCart')->name('wishListCart.store');
Route::get('wish-list-cart', 'WishListCartController@wishListCart')->name('wishListCart.index');
Route::patch('update-wish-list-cart', 'WishListCartController@update')->name('wishListCart.update');
Route::delete('remove-from-wish-list-cart', 'WishListCartController@remove')->name('wishListCart.delete');
Route::get('clear-wish-list-cart','WishListCartController@clear')->name('wishListCart.clear');

