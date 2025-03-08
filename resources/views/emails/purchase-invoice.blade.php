<!-- resources/views/emails/purchase-invoice.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tu factura y compra</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h1>¡Gracias por tu compra, {{ $user->name }}!</h1>
    <p>Hemos adjuntado tu factura en PDF a este correo.</p>
    <p>Cualquier duda, contáctanos. ¡Saludos!</p>
</body>
</html>
