<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ClosingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NotOpenController;
use App\Http\Controllers\OptionController;
use App\Models\Menu;
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
Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/order', [HomeController::class, 'processOrder']);
Route::get('/order/{item}/{option?}/{choice?}', [HomeController::class,'addItemToOrder']);
Route::get('/removeitem/{item}', [HomeController::class, 'removeItemFromOrder']);

Route::get('/sendorder', [HomeController::class, 'sendOrder']);
Route::get('/cancel/{order}', [HomeController::class, 'cancelOrder']);
Route::get('/notopen', [NotOpenController::class, 'index'])->name('notopen');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::resource('menu', MenuController::class);
Route::resource('category', CategoryController::class);
Route::resource('item', ItemController::class);
Route::resource('choice', ChoiceController::class);
Route::resource('option', OptionController::class);


Route::get('/closing', [ClosingController::class, 'index'])->name('closing.index');
Route::post('/closing',[ClosingController::class, 'store'])->name('closing.store');
Route::delete('/closing/{closing}',[ClosingController::class, 'destroy'])->name('closing.delete');

