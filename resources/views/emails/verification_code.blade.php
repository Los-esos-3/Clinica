<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #2563eb; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">Verificación de Cuenta</h2>
        
        <p style="font-size: 16px;">Hola,</p>
        <p style="font-size: 16px;">Gracias por registrarte. Tu código de verificación es:</p>

        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; color: #111827;">{{ $verificationCode }}</span>
        </div>

        <p style="font-size: 14px;">Por favor, ingresa este código en la plataforma para completar tu registro.</p>
        <p style="font-size: 14px;">Si tú no solicitaste este código, puedes ignorar este mensaje.</p>

        <p style="font-size: 13px; color: #6b7280; margin-top: 40px;">Gracias,<br>El equipo de Soporte</p>
    </div>
</body>
</html>
