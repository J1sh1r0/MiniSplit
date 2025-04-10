@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #4facfe, #00f2fe);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }
    .success-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        max-width: 450px;
        text-align: center;
    }
    .success-icon {
        font-size: 50px;
        color: #28a745;
    }
    .success-message {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
    }
    .success-text {
        font-size: 16px;
        color: #666;
        margin-top: 10px;
    }
    .btn-back {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        transition: background 0.3s ease-in-out;
    }
    .btn-back:hover {
        background: #0056b3;
    }
</style>

<div class="success-container">
    <div class="success-icon">✅</div>
    <div class="success-message">¡Pago Exitoso!</div>
    <p class="success-text">Payment Gracias por tu compra. Hemos recibido tu pago correctamente.</p>
    <a href="{{ url('/') }}" class="btn-back">Volver al Inicio</a>
</div>

@endsection
