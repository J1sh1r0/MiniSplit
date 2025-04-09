<!-- resources/views/pdf/invoice.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px;">
    <h1>Factura de tu compra</h1>

    <!-- Datos principales de la factura -->
    <p><strong>Folio:</strong> {{ $user->folio }}</p>
    <p><strong>RFC:</strong> {{ $user->invoice_rfc }}</p>
    <p><strong>Razón Social:</strong> {{ $user->invoice_name }}</p>
    <p><strong>Régimen Fiscal:</strong> {{ $user->invoice_regimen }}</p>
    <p><strong>Uso de CFDI:</strong> {{ $user->invoice_cfdi_use }}</p>

    <hr>

    <!-- Dirección de facturación -->
    <h2>Información de facturación</h2>
    <p><strong>Calle (fact.):</strong> {{ $user->invoice_street }} {{ $user->invoice_number }}</p>
    @if($user->invoice_interior)
        <p><strong>Interior (fact.):</strong> {{ $user->invoice_interior }}</p>
    @endif
    <p><strong>Colonia (fact.):</strong> {{ $user->invoice_colonia }}</p>
    <p><strong>Ciudad (fact.):</strong> {{ $user->invoice_city }}, {{ $user->invoice_state }}</p>
    <p><strong>C.P. (fact.):</strong> {{ $user->invoice_zip }}</p>
    <p><strong>País (fact.):</strong> {{ $user->invoice_country }}</p>

    <hr>

    <!-- Dirección de envío -->
    <h2>Información de envío</h2>
    <p><strong>Calle (envío):</strong> {{ $user->address }} {{ $user->number }}</p>
    @if($user->no_interior)
        <p><strong>Interior (envío):</strong> {{ $user->no_interior }}</p>
    @endif
    <p><strong>Colonia (envío):</strong> {{ $user->colonia }}</p>
    <p><strong>Ciudad (envío):</strong> {{ $user->city }}, {{ $user->state }}</p>
    <p><strong>C.P. (envío):</strong> {{ $user->zip }}</p>

    <hr>

    <!-- Listado de productos -->
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
                    if($producto === 'Minisplit 1') $precio = 20;
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

    <h3 style="text-align: right;">Total: ${{ number_format($total, 2) }}</h3>
</body>
</html>
