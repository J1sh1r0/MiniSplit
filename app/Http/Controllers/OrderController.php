<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'verification_video' => 'nullable|file|mimes:mp4,avi,mov|max:20480',
            'products' => 'required|array',
            'total' => 'required|numeric|min:0'
        ]);

        // Guardar el video si se subió
        $videoPath = null;
        if ($request->hasFile('verification_video')) {
            $videoPath = $request->file('verification_video')->store('videos', 'public');
        }

        // Crear la orden con folio único
        $order = Order::create([
            'folio' => 'ORD-' . strtoupper(Str::random(8)), // Generar folio único
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'verification_video' => $videoPath,
            'total' => $request->total,
            'payment_status' => 'pending'
        ]);

        // Guardar productos en `order_items`
        foreach ($request->products as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $product['name'],
                'quantity' => $product['quantity'],
                'price' => $product['price']
            ]);
        }

        return response()->json([
            'message' => 'Orden creada con éxito',
            'order_id' => $order->id,
            'folio' => $order->folio
        ], 201);
    }
}
