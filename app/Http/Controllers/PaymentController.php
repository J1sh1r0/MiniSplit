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

        session(['order_data' => $request->all()]);
        return response()->json(['url' => $checkout_session->url]);
    }

    public function success()
    {
        // Obtener los datos de la sesión
        $orderData = session('order_data');
        $videoTempPath = session('verification_video_path'); // Ruta temporal del video si existe

        if ($orderData) {
            $compraRequest = new \Illuminate\Http\Request();

            // Si el usuario era técnico y subió video, lo agregamos como UploadedFile
            if ($videoTempPath && file_exists(storage_path('app/' . $videoTempPath))) {
                $compraRequest->files->set('verification_video', new \Illuminate\Http\UploadedFile(
                    storage_path('app/' . $videoTempPath),
                    basename($videoTempPath),
                    null,
                    null,
                    true // <-- Esto lo marca como un archivo ya movido (safe)
                ));
            }

            // Inyectar los demás datos del formulario
            $compraRequest->replace($orderData);

            // Llamar al controlador de compra
            $compraController = new \App\Http\Controllers\CompraController();
            $compraController->store($compraRequest);

            // Limpiar sesión
            session()->forget(['order_data', 'verification_video_path']);
        }

        return view('payment.success');
    }


    public function cancel()
    {
        return view('payment.cancel'); // Crear una vista de cancelación
    }
}
