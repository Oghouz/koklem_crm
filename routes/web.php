<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /**
     *  Products
     */
    Route::resource('product', ProductController::class);
    Route::resource('design', DesignController::class);
    Route::resource('client', ClientController::class);
    Route::resource('order', OrderController::class);
    Route::resource('stock', StockController::class);
    Route::resource('invoice', InvoiceController::class);

});

