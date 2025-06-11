<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Kaizen Salud</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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

        .input-field {
            position: relative;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .input-field.valid input {
            background-color: #e6ffe6;
            border-color: #4CAF50;
        }

        .input-field .checkmark {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #4CAF50;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .input-field.valid .checkmark {
            opacity: 1;
        }

        .btn-animate {
            transition: all 0.3s ease-in-out;
        }

        .btn-animate:disabled {
            background-color: #b0b0b0;
        }

        .btn-animate.enabled {
            background-color: #4CAF50;
            color: white;
        }

        .btn-animate.enabled:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-100">
    <div class="w-full max-w-4xl bg-white login-card p-6 md:flex">
        <!-- Sección informativa -->
        <div class="hidden md:block md:w-1/2 bg-blue-500 p-8 text-white rounded-l-lg">
            <h2 class="text-3xl font-bold mb-4">Software Portal</h2>
            <p>Gestiona y accede a tus servicios médicos de forma fácil y segura.</p>
            <hr class="my-4 border-white">
            <p class="text-sm">Consulta nuestro <a href="#" class="underline">Aviso de Privacidad</a> para más información en caso de cualquier problema que tenga o nueste de acuerdo con el programa de gesttion de expedientes clinicos.</p>
        </div>

        <!-- Formulario de inicio de sesión -->
        <div class="md:w-1/2 p-8">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/KAIZEN.png') }}" alt="Logo Kaizen" class="w-24 h-24 header-logo">
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Iniciar Sesión</h2>

            <form method="POST" action="{{ route('login') }}" id="login-form" autocomplete="on">
                @csrf
                <div class="mb-4 input-field" id="email-field">
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
                    <span class="checkmark">✔</span>
                </div>
                <div class="mb-4 input-field relative" id="password-field">
                    <input type="password" name="password" id="password" placeholder="Contraseña" required maxlength="18"
                        class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-md">
                    
                    <span onclick="togglePassword('password', this)"
                        class="absolute right-3 top-2/4 transform -translate-y-1/2 cursor-pointer text-gray-500">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                
                <div class="flex justify-between items-center mb-6">
                    <label for="remember_me" class="text-sm">
                        <input type="checkbox" name="remember" id="remember_me" class="mr-2"> Recordarme
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="flex flex-col space-y-4">
                    <button type="submit" id="submit-btn" class="w-full py-3 bg-gray-500 text-white rounded hover:bg-blue-600 btn-animate" disabled>
                        Iniciar Sesión
                    </button>
                    <a href="{{ route('register') }}" class="w-full py-3 bg-green-500 text-white text-center rounded hover:bg-green-600 btn-animate">
                        Registrarse
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(id, iconElement) {
            const input = document.getElementById(id);
            const icon = iconElement.querySelector('i');
        
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        </script>
        
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submit-btn');

        const emailField = document.getElementById('email-field');
        const passwordField = document.getElementById('password-field');

        function validateFields() {
            let isEmailValid = emailInput.value.trim() !== '';
            let isPasswordValid = passwordInput.value.trim() !== '';

            if (isEmailValid) {
                emailField.classList.add('valid');
            } else {
                emailField.classList.remove('valid');
            }

            if (isPasswordValid) {
                passwordField.classList.add('valid');
            } else {
                passwordField.classList.remove('valid');
            }

            if (isEmailValid && isPasswordValid) {
                submitButton.disabled = false;
                submitButton.classList.add('enabled');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('enabled');
            }
        }

        emailInput.addEventListener('input', validateFields);
        passwordInput.addEventListener('input', validateFields);
    </script>
</body>
</html>
