<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes - Expedmed</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f7fafc;
        }

        .plan-card {
            transition: all 0.3s ease;
            border-top: 4px solid;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #a7d3e0, #003366);
        }

        .feature-list li {
            position: relative;
            padding-left: 1.75rem;
        }

        .feature-list li:before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <div class="flex items-center justify-between bg-gray-300 p-3 mb-6 border">

        <div class="flex items-center gap-16">
            <button id="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <h2 class="text-xl pt-1.5 font-semibold leading-tight text-gray-800">
                {{ __('Planes') }}
            </h2>
        </div>

        <div class="flex items-center ml-4">
            <div class="relative flex">
                <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-blue-800 px-3 py-2">Inicio</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-800 px-3 py-2">Agenda</a>

                    <form method="POST" class="text-gray-600 hover:text-blue-800 px-3 py-2" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-800 px-3 py-2">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Trial Expired Message -->
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
                <p class="font-bold">¡Período de prueba finalizado!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Elige el plan perfecto para tu consultorio</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Optimiza la gestión de tus expedientes médicos con
                nuestras soluciones diseñadas para profesionales de la salud.</p>
        </div>

        <!-- Toggle Annual/Monthly -->
        <div class="flex justify-center mb-12">
            <div class="inline-flex bg-white rounded-lg shadow p-1">
                <button
                    class="px-6 py-2 rounded-lg font-medium focus:outline-none bg-blue-100 text-blue-800">Mensual</button>
                <button class="px-6 py-2 rounded-lg font-medium focus:outline-none">Anual (20% descuento)</button>
            </div>
        </div>

        <!-- Plans Grid -->
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Plan Básico -->
            <div class="plan-card bg-white rounded-lg shadow-md overflow-hidden border-t-blue-400">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Básico</h3>
                    <p class="text-gray-600 mb-6">Ideal para consultorios pequeños</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-800">$299</span>
                        <span class="text-gray-600">/mes</span>
                    </div>
                    <ul class="feature-list space-y-3 mb-8">
                        <li>Hasta 100 pacientes</li>
                        <li>5 GB de almacenamiento</li>
                        <li>Soporte básico por correo</li>
                        <li>Acceso a expedientes</li>
                        <li class="text-gray-400 line-through">Historial completo</li>
                        <li class="text-gray-400 line-through">Análisis estadísticos</li>
                    </ul>
                    <button
                        class="w-full py-3 px-6 rounded-lg font-medium bg-white border border-blue-500 text-blue-500 hover:bg-blue-50 transition duration-300">
                        Seleccionar Plan
                    </button>
                </div>
            </div>

            <!-- Plan Profesional (Destacado) -->
            <div
                class="plan-card bg-white rounded-lg shadow-lg overflow-hidden border-t-green-500 transform scale-105 z-10">
                <div class="relative">
                    <div
                        class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                        RECOMENDADO
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Profesional</h3>
                    <p class="text-gray-600 mb-6">Perfecto para clínicas medianas</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-800">$599</span>
                        <span class="text-gray-600">/mes</span>
                    </div>
                    <ul class="feature-list space-y-3 mb-8">
                        <li>Hasta 500 pacientes</li>
                        <li>20 GB de almacenamiento</li>
                        <li>Soporte prioritario</li>
                        <li>Acceso a expedientes</li>
                        <li>Historial completo</li>
                        <li class="text-gray-400 line-through">Análisis estadísticos</li>
                    </ul>
                    <button
                        class="w-full py-3 px-6 rounded-lg font-medium btn-primary text-white hover:opacity-90 transition duration-300">
                        Seleccionar Plan
                    </button>
                </div>
            </div>

            <!-- Plan Empresarial -->
            <div class="plan-card bg-white rounded-lg shadow-md overflow-hidden border-t-purple-500">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Empresarial</h3>
                    <p class="text-gray-600 mb-6">Para hospitales y grandes clínicas</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-800">$999</span>
                        <span class="text-gray-600">/mes</span>
                    </div>
                    <ul class="feature-list space-y-3 mb-8">
                        <li>Pacientes ilimitados</li>
                        <li>100 GB de almacenamiento</li>
                        <li>Soporte 24/7</li>
                        <li>Acceso a expedientes</li>
                        <li>Historial completo</li>
                        <li>Análisis estadísticos</li>
                    </ul>
                    <button
                        class="w-full py-3 px-6 rounded-lg font-medium bg-white border border-purple-500 text-purple-500 hover:bg-purple-50 transition duration-300">
                        Seleccionar Plan
                    </button>
                </div>
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="mt-20 bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-lg font-medium text-gray-900">Características</th>
                        <th class="px-6 py-4 text-center text-lg font-medium text-gray-900">Básico</th>
                        <th class="px-6 py-4 text-center text-lg font-medium text-gray-900">Profesional</th>
                        <th class="px-6 py-4 text-center text-lg font-medium text-gray-900">Empresarial</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Pacientes</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">100</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">500</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold">Ilimitados</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Almacenamiento</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">5 GB</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">20 GB</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold">100 GB</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Soporte</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">Correo electrónico</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">Prioritario</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold">24/7</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Historial completo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-red-500">✗</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-green-500">✓</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-green-500">✓</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Análisis estadísticos</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-red-500">✗</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-red-500">✗</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-green-500">✓</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- FAQ Section -->
        <div class="mt-20">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Preguntas frecuentes</h2>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">¿Puedo cambiar de plan más tarde?</h3>
                    <p class="text-gray-600">Sí, puedes cambiar entre planes en cualquier momento desde tu panel de
                        configuración.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">¿Hay un contrato de permanencia?</h3>
                    <p class="text-gray-600">No, todos nuestros planes son mensuales sin compromiso de permanencia.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">¿Qué métodos de pago aceptan?</h3>
                    <p class="text-gray-600">Aceptamos tarjetas de crédito/débito y transferencias bancarias.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">¿Ofrecen descuentos para organizaciones sin
                        fines de lucro?</h3>
                    <p class="text-gray-600">Sí, contáctanos para informarte sobre nuestros descuentos especiales.</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-20 bg-blue-800 rounded-lg p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">¿Tienes dudas sobre qué plan elegir?</h2>
            <p class="text-xl mb-6">Nuestro equipo está listo para ayudarte a encontrar la mejor solución para tu
                consultorio.</p>
            <a href="{{ url('/contactenos') }}"
                class="bg-white text-blue-800 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-300">
                Contáctanos
            </a>
        </div>
    </main>
</body>

</html>
