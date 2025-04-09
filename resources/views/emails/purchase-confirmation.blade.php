<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compra Exitosa</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="padding: 20px; background-color: #f5f5f5;">
        <h1 style="color: #072BF2;">¡Gracias por tu compra, {{ $user->name }}!</h1>
        <p>Folio de tu pedido: <strong>{{ $user->folio }}</strong></p>
        <p>Enviaremos tu pedido a:</p>
        <ul>
            <li><strong>Calle:</strong> {{ $user->address }} {{ $user->number }}</li>
            @if($user->no_interior)
                <li><strong>Interior:</strong> {{ $user->no_interior }}</li>
            @endif
            <li><strong>Colonia:</strong> {{ $user->colonia }}</li>
            <li><strong>Ciudad:</strong> {{ $user->city }}, {{ $user->state }}</li>
            <li><strong>C.P.:</strong> {{ $user->zip }}</li>
        </ul>
    </div>

    <div style="padding: 20px;">
        <h2 style="color: #072BF2;">Detalles de tu compra</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #ddd;">
                    <th style="padding: 8px; border: 1px solid #ccc;">Producto</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Cantidad</th>
                    <th style="padding: 8px; border: 1px solid #ccc;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($items as $producto => $cantidad)
                    @php
                        // Opcional: puedes asignar un precio según la clave
                        $precio = 0;
                        if ($producto === 'Minisplit 1') {
                            $precio = 20;
                        } elseif ($producto === 'Minisplit 2') {
                            $precio = 14900;
                        }
                        $subtotal = $precio * $cantidad;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $producto }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $cantidad }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">${{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 style="text-align: right; margin-top: 20px;">
            Total: ${{ number_format($total, 2) }} MXN
        </h3>
    </div>

    <div style="padding: 20px; background-color: #f5f5f5;">
        <p>¡Gracias nuevamente por tu compra! Si tienes alguna duda, contáctanos.</p>
    </div>
</body>
</html>
