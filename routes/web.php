<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register/customer', [AuthController::class, 'registerCustomer'])->name('register.customer');
Route::post('/register/technician', [AuthController::class, 'registerTechnician'])->name('register.technician');
Route::post('/pago-exitoso', [AuthController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/', function () {
    return view('landing');
});

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');



