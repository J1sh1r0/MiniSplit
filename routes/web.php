<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CompraController;

Route::post('/compra', [CompraController::class, 'store']);


Route::get('/', function () {
    return view('landing');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');



