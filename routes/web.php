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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/order', "HomeController@processOrder");
Route::get('/order/{item}/{option?}/{choice?}', "HomeController@addItemToOrder");
Route::get('/removeitem/{item}', "HomeController@removeItemFromOrder");

Route::get('/sendorder', "HomeController@sendOrder");
Route::get('/cancel/{order}', "HomeController@cancelOrder");

Route::get('/register', "RegisterController@index");
Route::post('/register', "RegisterController@register")->name('register');

Route::view('/notopen', 'notopen');

Route::get('/admin', 'AdminController@index')->name('admin');