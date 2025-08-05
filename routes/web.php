<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\HomeController;
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

    /**
     * Design
     */
    Route::resource('design', DesignController::class);

    /**
     * Client
     */

    Route::resource('client', ClientController::class);
    Route::post('client/getPriceTshirt', action: [ClientController::class, 'getPriceTshirt'])->name('client.getPriceTshirt');

    /**
     * Stock
     */
    Route::resource('stock', StockController::class);
    
    /**
     * Home page statistic
     */
    Route::post('api/getSalesData', [HomeController::class, 'getSalesData']);

    /**
     * Order
     */
    Route::get('/order/create-express', [OrderController::class, 'createExpress'])->name('order.createExpress');
    Route::resource('order', OrderController::class);
    Route::post('/order/set/discount', [OrderController::class, 'setDiscount'])->name('order.set.discount');
    Route::get('/order/{id}/generate-pdf/{type}', [OrderController::class, 'generatePDF'])->name('order.generatePDF');

    /**
     * OrderLine
     */
    Route::prefix('orderLine')->group(function () {
        Route::post('add', [OrderController::class, 'addOrderLine'])->name('orderLine.add');
        Route::put('update/{order_line_id}', [OrderController::class, 'updateOrderLine'])->name('orderLine.update');
        Route::delete('delete/{order_line_id}', [OrderController::class, 'deleteOrderLine'])->name('orderLine.delete');
    });

    /**
     * Invoice
     */
    
    Route::resource('invoice', InvoiceController::class);
    Route::get('invoice/pdf/download/{key}/{type?}', [InvoiceController::class, 'generateInvoicePdf'])->name('invoice.pdf.download');
    Route::post('invoice/multipleInvoiceStore', [InvoiceController::class, 'multipleInvoiceStore'])->name('invoice.sotre.multiple');
    Route::post('invoice/set/payment', [InvoiceController::class, 'setPayment'])->name('invoice.set.payment');


});

