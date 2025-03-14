<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CarritoController;

Route::post('/compra', [CompraController::class, 'store']);


Route::get('/', function () {
    return view('landing');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
Route::post('/compra', [CarritoController::class, 'procesarCompra'])->name('compra');


