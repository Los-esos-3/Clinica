<x-guest-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>

    <div class="container px-4 py-28 mx-auto">
        <div class="flex flex-col items-center justify-center md:flex-row">
            <!-- Left Panel -->
            <div class="w-full md:w-1/2 p-8 bg-white relative shadow-lg rounded-lg">               
                
                <h2 class="mb-4 text-4xl font-bold text-left text-gray-800">Estás a un paso de modernizar tu consultorio.</h2>
                <p class="mb-6 text-lg text-gray-600">KAISEN te ayuda a automatizar todos los aspectos de tu negocio.</p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center">
                        <img src="/images/expediente-icon.png" alt="Expediente Clínico" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Expediente Clínico</p>
                    </div>
                    <div class="flex items-center">
                        <img src="/images/agenda-icon.png" alt="Agenda" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Agenda</p>
                    </div>
                    <div class="flex items-center">
                        <img src="/images/sitio-web-icon.png" alt="Sitio Web" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Sitio Web</p>
                    </div>
                    <div class="flex items-center">
                        <img src="/images/portal-paciente-icon.png" alt="Portal Paciente" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Portal Paciente</p>
                    </div>
                    <div class="flex items-center">
                        <img src="/images/facturacion-icon.png" alt="Facturación" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Facturación</p>
                    </div>
                    <div class="flex items-center">
                        <img src="/images/Seguridad-icon.png" alt="Seguridad de tu información" class="w-8 h-8 mr-2">
                        <p class="text-gray-700">Seguridad de tu información</p>
                    </div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="w-full md:w-1/2 p-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold text-center">Regístrate Gratis</h2>
                
                <div class="flex items-center mb-4">
                    <div class="flex-grow h-px bg-gray-300"></div>
                    <div class="flex-grow h-px bg-gray-300"></div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <x-label for="name" value="Nombre completo" />
                        <x-input id="name" class="block w-full mt-1" type="text" name="name" placeholder="Nombre completo" required />
                    </div>
                    <div class="mb-4">
                        <x-label for="email" value="Correo Electrónico" />
                        <x-input id="email" class="block w-full mt-1" type="email" name="email" placeholder="Correo Electrónico" required />
                    </div>
                    <div class="mb-4">
                        <x-label for="password" value="Contraseña" />
                        <x-input id="password" class="block w-full mt-1" type="password" name="password" placeholder="Contraseña" required maxlength="18" />
                    </div>
                    <div class="mb-4">
                        <x-label for="phone" value="Celular" />
                        <x-input id="phone" class="block w-full mt-1" type="tel" name="phone" placeholder="Número de teléfono" required />
                    </div>
                    <div class="flex items-center justify-center">
                        <x-button id="submit-btn" class="w-full py-2 bg-blue-500 hover:bg-blue-700" disabled>
                            Crear cuenta
                        </x-button>
                    </div>
                </form>
                <p class="mt-4 text-sm text-gray-500 text-center">
                    Al dar clic en "Registrarme" estás aceptando nuestros 
                    <a href="#" class="text-blue-600 underline">términos y condiciones de uso</a>.
                </p>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submit-btn');

        // Función para habilitar el botón "Crear cuenta" cuando la contraseña tiene entre 16 y 18 caracteres
        function toggleSubmitButton() {
            // Verificar que la contraseña tenga entre 16 y 18 caracteres
            if (passwordInput.value.length >= 5 && passwordInput.value.length <= 25) {  
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-500');
                submitButton.classList.add('bg-blue-500', 'hover:bg-blue-700');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                submitButton.classList.add('bg-gray-500');
            }
        }

        // Detectar cambios en el campo de contraseña
        passwordInput.addEventListener('input', toggleSubmitButton);
    </script>
</x-guest-layout>
