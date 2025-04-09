<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Configurar Stripe con la clave secreta desde el .env
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Crear una sesión de pago con Stripe
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mxn', // Ajusta según la moneda que uses
                    'product_data' => [
                        'name' => 'Pedido en Minisplit', // Nombre del producto
                    ],
                    'unit_amount' => intval($request->total * 100), // Convertir a centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'), // URL de éxito después del pago
            'cancel_url' => url('/cancel'), // URL si el usuario cancela el pago
        ]);

        return response()->json(['url' => $checkout_session->url]);
    }

    public function success()
    {
        return view('payment.success'); // Asegurar que Laravel busque la vista en la carpeta correcta
    }

    public function cancel()
    {
        return view('payment.cancel'); // Crear una vista de cancelación
    }
}
