<!-- resources/views/pdf/invoice.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px;">
    <h1>Factura de tu compra</h1>
    <p><strong>Folio:</strong> {{ $user->folio }}</p>
    <p><strong>RFC:</strong> {{ $user->invoice_rfc }}</p>
    <p><strong>Razón Social:</strong> {{ $user->invoice_name }}</p>
    <p><strong>Régimen Fiscal:</strong> {{ $user->invoice_regimen }}</p>
    <p><strong>Uso de CFDI:</strong> {{ $user->invoice_cfdi_use }}</p>
    <hr>
    <h2>Información de envío:</h2>
    <p><strong>Calle:</strong> {{ $user->address }} {{ $user->number }}</p>
    @if($user->no_interior)
        <p><strong>Interior:</strong> {{ $user->no_interior }}</p>
    @endif
    <p><strong>Colonia:</strong> {{ $user->colonia }}</p>
    <p><strong>Ciudad:</strong> {{ $user->city }}, {{ $user->state }}</p>
    <p><strong>C.P.:</strong> {{ $user->zip }}</p>
    <hr>
    <h3>Productos:</h3>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($items as $producto => $cantidad)
                @php
                    $precio = 0;
                    if($producto === 'Minisplit 1') $precio = 7599;
                    if($producto === 'Minisplit 2') $precio = 14900;
                    $subtotal = $precio * $cantidad;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $producto }}</td>
                    <td>{{ $cantidad }}</td>
                    <td>${{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3 style="text-align: right">Total: ${{ number_format($total, 2) }}</h3>
</body>
</html>
