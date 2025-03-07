<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Exitoso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-green-100">
    <div class="text-center bg-white rounded-lg shadow-lg p-10">
        <h1 class="text-3xl font-bold text-green-600 mb-4">¡Pago exitoso!</h1>
        <p class="mb-4">Tu compra ha sido registrada correctamente.</p>
        <a href="{{ route('register.customer') }}" class="underline text-blue-500">Ir a mi panel</a>
    </div>
</body>
</html>
