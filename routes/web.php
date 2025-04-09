<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;

Route::post('/compra', [CompraController::class, 'store']);

Route::get('/', function () {
    return view('landing');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
//Route::post('/compra', [CarritoController::class, 'procesarCompra'])->name('compra');

Route::post('/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
// Route::get('/success', [PaymentController::class, 'success'])->name('success');
Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
