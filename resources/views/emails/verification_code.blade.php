<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de Verificación</title>
</head>
<body>
    <h1>¡Hola, {{ $user->name }}!</h1>
    <p>Tu código de verificación es: <strong>{{ $verification_code }}</strong></p>
    <p>Ingresa este código en el sitio para verificar tu cuenta.</p>
</body>
</html>
