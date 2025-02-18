<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-5xl bg-white shadow-md rounded-lg p-8 flex">
            <!-- Sección izquierda -->
            <div class="w-1/2 p-6">
                <h2 class="text-2xl font-bold mb-4">Estás a un paso de modernizar tu consultorio.</h2>
                <p class="text-gray-600 mb-6">
                    KAISEN te ayuda a automatizar todos los aspectos de tu negocio.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/expediente-icon.png') }}" class="w-6 h-6" alt="Expediente">
                        <span>Expediente Clínico</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/agenda-icon.png') }}" class="w-6 h-6" alt="Agenda">
                        <span>Agenda</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/sitio-web-icon.png') }}" class="w-6 h-6" alt="Sitio Web">
                        <span>Sitio Web</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/portal-paciente-icon.png') }}" class="w-6 h-6" alt="Portal">
                        <span>Portal Paciente</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/facturacion-icon.png') }}" class="w-6 h-6" alt="Facturación">
                        <span>Facturación</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/seguridad-icon.png') }}" class="w-6 h-6" alt="Seguridad">
                        <span>Seguridad de tu información</span>
                    </div>
                </div>
            </div>

            <!-- Sección derecha (Formulario) -->
            <div class="w-1/2 p-6">
                <h2 class="text-2xl font-bold mb-6">Regístrate Gratis</h2>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Nombre completo</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                               value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Correo Electrónico</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                               value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Contraseña</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Confirmar Contraseña</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2">Celular</label>
                        <input type="tel" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                               value="{{ old('phone') }}" required>
                    </div>

                    <button type="submit" class="w-full bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600">
                        CREAR CUENTA
                    </button>

                    <p class="text-sm text-gray-600 text-center mt-4">
                        Al dar clic en "Registrarme" estás aceptando nuestros 
                        <a href="#" class="text-blue-500 underline">términos y condiciones de uso</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
