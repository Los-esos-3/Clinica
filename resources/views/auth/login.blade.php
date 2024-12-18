
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Kaizen Salud</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #e6f7ff, #ffffff);
            font-family: 'Roboto', sans-serif;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .header-logo {
            border-radius: 50%;
            background-color: #3572af;
            padding: 5px;
            border: 2px solid #003366;
        }

        /* Estilos para el botón */
        .btn-animate {
            transition: all 0.3s ease-in-out;
        }

        .btn-animate:disabled {
            background-color: #b0b0b0;
        }

        .confetti {
            pointer-events: none;
        }

        .green-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-align: center;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .green-btn:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-4xl bg-white login-card p-6 md:flex">
        <!-- Sección informativa -->
        <div class="hidden md:block md:w-1/2 bg-blue-500 p-8 text-white rounded-l-lg">
            <h2 class="text-3xl font-bold mb-4">Hospital Portal</h2>
            <p>Gestiona y accede a tus servicios médicos de forma fácil y segura.</p>
            <hr class="my-4 border-white">
            <p class="text-sm">Consulta nuestro <a href="#" class="underline">Aviso de Privacidad</a> para más información.</p>
        </div>

        <!-- Formulario de inicio de sesión -->
        <div class="md:w-1/2 p-8">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/KAIZEN.png') }}" alt="Logo Kaizen" class="w-24 h-24 header-logo">
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Iniciar Sesión</h2>

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" class="w-full p-3 border rounded bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="w-full p-3 border rounded bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" required maxlength="18">
                </div>
                <div class="flex justify-between items-center mb-6">
                    <label for="remember_me" class="text-sm">
                        <input type="checkbox" name="remember" id="remember_me" class="mr-2"> Recordarme
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('register') }}" class="green-btn">Regístrate</a>
                    <button type="submit" id="submit-btn" class="w-full py-3 bg-gray-500 text-white rounded hover:bg-blue-600 btn-animate" disabled>Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submit-btn');

        let confettiTriggered = false;  // Controla si el confeti ya fue disparado

        // Función para habilitar el botón de enviar cuando los campos estén llenos
        function toggleSubmitButton() {
            // Verificar que la contraseña tenga entre 16 y 18 caracteres y el correo esté lleno
            if (emailInput.value && passwordInput.value.length >= 2 && passwordInput.value.length <= 12) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-500');
                submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
                
                // Disparar confeti solo una vez cuando los campos estén completos
                if (!confettiTriggered) {
                    triggerConfetti();
                    confettiTriggered = true;  // Marcar que el confeti ya fue disparado
                }
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                submitButton.classList.add('bg-gray-500');
                confettiTriggered = false;  // Restablecer el estado de confetti cuando los campos no cumplen la condición
            }
        }

        // Función para disparar confeti con colores variados
        function triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#ff0', '#ff6', '#ff33', '#ff69b4', '#00ff00', '#ff6347', '#7b68ee', '#ffff00']
            });
        }

        // Detectar cambios en los inputs
        emailInput.addEventListener('input', toggleSubmitButton);
        passwordInput.addEventListener('input', toggleSubmitButton);
    </script>
</body>
</html>
