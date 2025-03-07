<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

Route::get('/', function () {
    return view('landing');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');



