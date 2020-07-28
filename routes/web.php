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
//Route::get('add-to-cart/{id}', 'ProductController@addToCart');

//order-cart routes
//Route::get('add-to-order-cart/{id}', 'OrderCartController@addToOrderCart')->name('orderCart.store');
Route::get('add-to-order-cart/{id}', 'OrderCartController@addToCart')->name('orderCart.store');
Route::get('order-cart', 'OrderCartController@index')->name('orderCart.index');
Route::patch('update-order-cart', 'OrderCartController@updateCart')->name('orderCart.update');
Route::delete('remove-from-order-cart', 'OrderCartController@removeCartItem')->name('orderCart.delete');
Route::get('clear-order-cart','OrderCartController@clearCart')->name('orderCart.clear');

// wishlist-cart routes
Route::get('add-to-wish-list-cart/{id}', 'WishListCartController@addToCart')->name('wishListCart.store');
Route::get('wish-list-cart', 'WishListCartController@index')->name('wishListCart.index');
Route::patch('update-wish-list-cart', 'WishListCartController@updateCart')->name('wishListCart.update');
Route::delete('remove-from-wish-list-cart', 'WishListCartController@removeCartItem')->name('wishListCart.delete');
Route::get('clear-wish-list-cart','WishListCartController@clearCart')->name('wishListCart.clear');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
