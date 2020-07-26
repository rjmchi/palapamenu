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

Route::get('/sendorder', "HomeController@sendOrder");
Route::get('/cancel/{id}', "HomeController@cancelOrder");

Route::get('/register', "RegisterController@index");
Route::post('/register', "RegisterController@register")->name('register');