<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
//Rutas HomeController

Auth::routes([
    'verify' => true,   
    ]);
    
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas MainController

Route::get('/', [MainController::class, 'index'])->name('welcome.index');

Route::get('profile', 'ProfileController@edit')->name('profile.edit');
Route::put('profile', 'ProfileController@update')->name('profile.update');

// Ruta de ProductController
Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy']);

// Ruta CartController

Route::resource('carts', 'CartController')->only(['index']);

// Ruta OrderController

Route::resource('orders', 'OrderController')
        ->only(['create', 'store'])
        ->middleware(['verified']);
Route::resource('orders.payments', 'OrderPaymentController')
        ->only(['create', 'store'])
        ->middleware(['verified']);

