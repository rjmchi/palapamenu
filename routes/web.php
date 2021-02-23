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

//Route::get('/admin', 'AdminController@index')->name('admin');

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('/', 'AdminController@menus')->name('menulist');
    Route::get('/menu/edit/{menu}', 'MenuController@edit')->name('menuedit');
    Route::post('/menu/', 'MenuController@store')->name('menustore')->middleware('auth');
    Route::put('/menu/{menu}', 'MenuController@update')->name('menuupdate');
    Route::delete('/menu/delete/{menu}', 'MenuController@destroy')->name('menudelete');

    Route::get('/category', 'AdminController@categories')->name('cateogrylist');
    Route::get('/category/edit/{category}', 'CategoryController@edit')->name('categoryedit');
    Route::post('/category', 'CategoryController@store')->name('categorystore');
    Route::put('category/{category}', 'CategoryController@update')->name('categoryupdate');
    Route::delete('category/delete/{category}', 'CategoryController@destroy')->name('categorydelete');

    Route::get('/item', 'AdminController@items')->name('cateogrylist');
    Route::get('/item/edit/{item}', 'ItemController@edit')->name('itemedit');
    Route::post('/item', 'ItemController@store')->name('itemstore');
    Route::put('item/{item}', 'ItemController@update')->name('itemupdate');
    Route::delete('item/delete/{item}', 'ItemController@destroy')->name('itemdelete');

    Route::get('/option', 'AdminController@options')->name('optionlist');
    Route::get('/option/edit/{option}', 'OptionController@edit')->name('optionedit');
    Route::post('/option', 'OptionController@store')->name('optionstore');
    Route::put('option/{option}', 'OptionController@update')->name('optionupdate');
    Route::delete('option/delete/{option}', 'OptionController@destroy')->name('optiondelete');

    Route::get('/choice', 'AdminController@choices')->name('choicelist');
    Route::get('/choice/edit/{choice}', 'ChoiceController@edit')->name('choiceedit');
    Route::post('/choice', 'ChoiceController@store')->name('choicestore');
    Route::put('choice/{choice}', 'ChoiceController@update')->name('choiceupdate');
    Route::delete('choice/delete/{choice}', 'ChoiceController@destroy')->name('choicedelete');
});
