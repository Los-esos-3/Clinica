<x-guest-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="flex justify-center items-center min-h-screen bg-gray-100 px-4 py-6">
        <div class="w-full max-w-5xl bg-white shadow-md rounded-lg p-4 md:p-8 flex flex-col lg:flex-row">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

            <!-- Sección izquierda -->
            <div class="w-full lg:w-1/2 p-4 md:p-6 order-2 lg:order-1">
                <h2 class="text-xl md:text-2xl font-bold mb-4 text-center lg:text-left">Estás a un paso de modernizar tu consultorio.</h2>
                <p class="text-gray-600 mb-6 text-sm md:text-base text-center lg:text-left">
                    Optimiza la gestión de expedientes clínicos con nuestro software seguro, intuitivo y accesible.
                    Mantén toda la información de tus pacientes organizada y disponible en todo momento.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 mb-6">
                    <div class="flex items-center space-x-2 text-sm md:text-base">
                        <img src="{{ asset('images/expediente-icon.png') }}" class="w-5 h-5 md:w-6 md:h-6" alt="Expediente"
                            loading="lazy">
                        <span>Expediente Clínico</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm md:text-base">
                        <img src="{{ asset('images/agenda-icon.png') }}" class="w-5 h-5 md:w-6 md:h-6" alt="Agenda" loading="lazy">
                        <span>Agenda</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm md:text-base">
                        <img src="{{ asset('images/sitio-web-icon.png') }}" class="w-5 h-5 md:w-6 md:h-6" alt="Sitio Web"
                            loading="lazy">
                        <span>Sitio Web</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm md:text-base">
                        <img src="{{ asset('images/portal-paciente-icon.png') }}" class="w-5 h-5 md:w-6 md:h-6" alt="Portal"
                            loading="lazy">
                        <span>Portal Paciente</span>
                    </div>

                    <div class="flex items-center space-x-2 text-sm md:text-base sm:col-span-2">
                        <img src="{{ asset('images/seguridad-icon.png') }}" class="w-5 h-5 md:w-6 md:h-6" alt="Seguridad"
                            loading="lazy">
                        <span>Seguridad de tu información</span>
                    </div>
                </div>

                <!-- Nueva sección de planes -->
                <div class="mt-6">
                    <h3 class="text-lg md:text-xl font-bold text-center mb-4 md:mb-6 text-gray-800">Seleccione un plan:</h3>
                    <div class="flex flex-col space-y-3 md:space-y-4 max-w-xl mx-auto">
                        <!-- Plan Básico -->
                        <div class="relative group w-full">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-blue-300 to-blue-500 rounded-lg blur opacity-0 group-hover:opacity-75 transition duration-500">
                            </div>
                            <div class="relative bg-white border-2 border-gray-200 rounded-lg p-3 md:p-4 transition-all duration-500 transform hover:-translate-x-2 hover:border-blue-400 hover:shadow-lg active:scale-95 cursor-pointer plan-option"
                                data-plan="basico" data-days="30" data-price="150">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 bg-blue-100 rounded-full flex items-center justify-center group-hover:animate-pulse mr-3 md:mr-4">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h4
                                            class="text-base md:text-lg font-bold text-gray-800 group-hover:text-blue-500 transition-colors duration-300">
                                            Plan Básico</h4>
                                        <div class="text-xs md:text-sm text-gray-600">Acceso mensual con funciones esenciales</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg md:text-2xl font-bold text-gray-900">$150</div>
                                        <div class="text-xs md:text-sm text-gray-600">/mes</div>
                                    </div>
                                </div>
                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs md:text-sm">
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Acceso solo por 30 días</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Hasta 20 expedientes activos</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Solo 1 médico registrado</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Sin acceso a herramientas avanzadas</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Plan Popular -->
                        <div class="relative group w-full">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-purple-300 to-purple-500 rounded-lg blur opacity-0 group-hover:opacity-75 transition duration-500">
                            </div>
                            <div class="relative bg-white border-2 border-purple-500 rounded-lg p-3 md:p-4 transition-all duration-500 transform hover:-translate-x-2 hover:shadow-lg active:scale-95 cursor-pointer plan-option"
                                data-plan="popular" data-days="180" data-price="699">
                                <div class="absolute -top-2 md:-top-3 right-2 md:right-4">
                                    <span
                                        class="bg-gradient-to-r from-purple-400 to-purple-600 text-white text-xs md:text-sm px-2 md:px-4 py-1 rounded-full uppercase tracking-wider font-semibold shadow-lg">Más
                                        Popular</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 bg-purple-100 rounded-full flex items-center justify-center group-hover:animate-pulse mr-3 md:mr-4">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h4
                                            class="text-base md:text-lg font-bold text-gray-800 group-hover:text-purple-500 transition-colors duration-300">
                                            Plan Popular</h4>
                                        <div class="text-xs md:text-sm text-gray-600">Mayor accesibilidad y más herramientas</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg md:text-2xl font-bold text-purple-500">$699</div>
                                        <div class="text-xs md:text-sm text-gray-600">/6 meses</div>
                                    </div>
                                </div>
                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs md:text-sm">
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Acceso por 6 meses</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Hasta 150 expedientes activos</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Hasta 2 médicos registrados</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Acceso parcial a herramientas avanzadas</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2 sm:col-span-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Opción de añadir 1 secretaria</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Plan Premium -->
                        <div class="relative group w-full">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-pink-300 via-yellow-300 to-pink-500 rounded-lg blur opacity-0 group-hover:opacity-75 transition duration-500">
                            </div>
                            <div class="relative bg-white border-2 border-gray-200 rounded-lg p-3 md:p-4 transition-all duration-500 transform hover:-translate-x-2 hover:border-pink-400 hover:shadow-lg active:scale-95 cursor-pointer plan-option"
                                data-plan="premium" data-days="365" data-price="1200">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 bg-gradient-to-r from-pink-100 to-yellow-100 rounded-full flex items-center justify-center group-hover:animate-pulse mr-3 md:mr-4">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h4
                                            class="text-base md:text-lg font-bold text-gray-800 group-hover:text-pink-500 transition-colors duration-300">
                                            Plan Premium</h4>
                                        <div class="text-xs md:text-sm text-gray-600">La mejor opción para clínicas y hospitales
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg md:text-2xl font-bold text-gray-900">$1,200</div>
                                        <div class="text-xs md:text-sm text-gray-600">/año</div>
                                    </div>
                                </div>
                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs md:text-sm">
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>  <span>Acceso por 12 meses</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Expedientes ilimitados</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Hasta 4 médicos y 2 secretarias</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Acceso completo a herramientas avanzadas</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 space-x-2 sm:col-span-2">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Prioridad en soporte técnico</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <!-- Sección derecha (Formulario) -->
            <div class="w-full lg:w-1/2 p-4 md:p-6 order-1 lg:order-2">
                <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center lg:text-left">Regístrate Gratis por 30 días</h2>
                @if ($errors->any())
                    <div class="text-red-500 text-xs md:text-sm mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="text-red-500 text-xs md:text-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('register.submit') }}" autocomplete="on" class="space-y-3 md:space-y-4">
                    @csrf

                    <!-- Campo oculto para el plan seleccionado -->
                    <input type="hidden" name="selected_plan" id="selected_plan" value="">
                    <input type="hidden" name="plan_days" id="plan_days" value="">
                    <input type="hidden" name="plan_price" id="plan_price" value="">


                    <div>
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Tu Nombre completo</label>
                        <input type="text" name="name"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md" value="{{ old('name') }}"
                            required>
                    </div>

                    <div>
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Correo Electrónico</label>
                        <input type="email" name="email"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md" value="{{ old('email') }}"
                            required>
                    </div>

                    <div class="relative">
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md pr-10" required>
                        <span onclick="togglePassword('password', this)"
                            class="absolute right-3 top-8 md:top-9 cursor-pointer text-gray-500">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <!-- Campo: Confirmar Contraseña -->
                    <div class="relative mt-3 md:mt-4">
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md pr-10" required>
                        <span onclick="togglePassword('password_confirmation', this)"
                            class="absolute right-3 top-8 md:top-9 cursor-pointer text-gray-500">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <div>
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Celular</label>
                        <input type="tel" name="phone"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md text-gray-500"
                            value="{{ old('phone') }}" required>
                    </div>

                    <!-- Campo de Comentarios -->
                    <div>
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Comentarios</label>
                        <textarea name="comments"
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md 
                @error('comments') border-red-500 @enderror"
                            rows="3 md:rows-4" placeholder="Cuéntenos sobre su negocio">{{ old('comments') }}</textarea>
                        @error('comments')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CAPTCHA Section -->
                    <div class="mt-3 md:mt-4">
                        <label class="block text-xs md:text-sm text-gray-700 mb-1 md:mb-2">Código de verificación:</label>
                        <div class="flex items-center mb-2">
                            <div name="captchaText"
                                class="border border-gray-300 rounded-md p-2 bg-gray-100 font-mono text-sm md:text-lg select-none"
                                id="captchaText"
                                style="user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;">
                                {{ $captchaText ?? '' }}
                            </div>
                            <button type="button" onclick="refreshCaptcha()" class="ml-2 text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <input type="text" name="captcha" required
                            class="w-full px-3 py-2 text-sm md:text-base border border-gray-300 rounded-md @error('captcha') border-red-500 @enderror"
                            id="captchaInput" placeholder="Ingrese el código mostrado"
                            onkeyup="validateCaptcha(this.value)">

                        <div id="captchaStatus" class="mt-1 text-xs md:text-sm"></div>

                        @error('captcha')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-gray-500 text-white py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-gray-600">
                        CREAR CUENTA
                    </button>




                    <p class="text-xs md:text-sm text-gray-600 text-center mt-3 md:mt-4">
                        Al dar clic en "Registrarme" estás aceptando nuestros
                        <a href="#" class="text-blue-500 underline">términos y condiciones de uso</a>.
                    </p>
                    <!-- Mensaje de plan seleccionado -->
                    <div id="plan_message"
                        class="mt-3 md:mt-4 p-3 md:p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded hidden">
                        <p class="text-center font-semibold text-xs md:text-sm"></p>
                    </div>
                </form>
            </div>
        </div>
        <script>
            let captchaValid = false;

            function refreshCaptcha() {
                const captchaText = document.getElementById('captchaText');
                const refreshButton = document.querySelector('button[onclick="refreshCaptcha()"]');

                // Mostrar indicador de carga
                refreshButton.style.pointerEvents = 'none';
                refreshButton.style.opacity = '0.5';

                fetch('/refresh-captcha', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.captcha) {
                            captchaText.textContent = data.captcha;
                            document.getElementById('captchaInput').value = '';
                            document.getElementById('captchaInput').classList.remove('border-green-500', 'border-red-500');
                            document.getElementById('captchaStatus').textContent = '';
                            captchaValid = false;
                            updateSubmitButton();
                        }
                    })
                    .catch(error => {
                        console.error('Error al refrescar el CAPTCHA:', error);
                        alert('Error al recargar el CAPTCHA. Por favor, intente nuevamente.');
                    })
                    .finally(() => {
                        // Restaurar el botón
                        refreshButton.style.pointerEvents = 'auto';
                        refreshButton.style.opacity = '1';
                    });
            }

            function validateCaptcha(value) {
                if (value.length === 0) {
                    document.getElementById('captchaInput').classList.remove('border-green-500', 'border-red-500');
                    document.getElementById('captchaStatus').textContent = '';
                    captchaValid = false;
                    updateSubmitButton();
                    return;
                }

                fetch('/validate-captcha', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            captcha: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const input = document.getElementById('captchaInput');
                        const status = document.getElementById('captchaStatus');

                        if (data.isValid) {
                            input.classList.remove('border-red-500');
                            input.classList.add('border-green-500');
                            status.textContent = '✓ Código correcto';
                            status.classList.remove('text-red-500');
                            status.classList.add('text-green-500');
                            captchaValid = true;
                        } else {
                            input.classList.remove('border-green-500');
                            input.classList.add('border-red-500');
                            status.textContent = '✗ Código incorrecto';
                            status.classList.remove('text-green-500');
                            status.classList.add('text-red-500');
                            captchaValid = false;
                        }
                        updateSubmitButton();
                    });
            }

            function updateSubmitButton() {
                const submitButton = document.querySelector('button[type="submit"]');
                if (captchaValid) {
                    submitButton.disabled = false;
                    submitButton.classList.remove('bg-gray-500');
                    submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    submitButton.classList.add('bg-gray-500');
                }
            }

            // Inicializar el botón al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                updateSubmitButton();
            });

            // Validar el formulario antes de enviar
            document.querySelector('form').addEventListener('submit', function(e) {
                if (!captchaValid) {
                    e.preventDefault();
                    document.getElementById('captchaStatus').textContent = 'Por favor ingrese un código CAPTCHA válido';
                    document.getElementById('captchaStatus').classList.add('text-red-500');
                }
            });
        </script>
        <script>
            function togglePassword(id, el) {
                const input = document.getElementById(id);
                const icon = el.querySelector('i');

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>


        <script>
            let selectedPlan = null;
            const planOptions = document.querySelectorAll('.plan-option');
            const planMessage = document.getElementById('plan_message');
            const planMessageText = planMessage.querySelector('p');
            const submitButton = document.querySelector('button[type="submit"]');

            planOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remover selección previa
                    planOptions.forEach(opt => {
                        opt.classList.remove('border-blue-500', 'border-purple-500', 'border-pink-500');
                        opt.classList.add('border-gray-200');
                    });

                    // Marcar como seleccionado
                    this.classList.remove('border-gray-200');
                    if (this.dataset.plan === 'basico') {
                        this.classList.add('border-blue-500');
                    } else if (this.dataset.plan === 'popular') {
                        this.classList.add('border-purple-500');
                    } else {
                        this.classList.add('border-pink-500');
                    }

                    // Actualizar valores
                    selectedPlan = this.dataset.plan;
                    document.getElementById('selected_plan').value = selectedPlan;
                    document.getElementById('plan_days').value = this.dataset.days;
                    document.getElementById('plan_price').value = this.dataset.price;

                    // Mostrar mensaje
                    planMessage.classList.remove('hidden');
                    const days = parseInt(this.dataset.days);
                    const months = Math.floor(days / 30);
                    const years = Math.floor(days / 365);

                    let message = '';
                    if (years > 0) {
                        message =
                            `Has seleccionado el Plan Premium. Tu suscripción será válida por ${years} año${years > 1 ? 's' : ''}.`;
                    } else if (months > 0) {
                        message =
                            `Has seleccionado el Plan ${months === 6 ? 'Popular' : 'Básico'}. Tu suscripción será válida por ${months} mes${months > 1 ? 'es' : ''}.`;
                    } else {
                        message =
                            `Has seleccionado el Plan Básico. Tu suscripción será válida por ${days} días.`;
                    }
                    planMessageText.textContent = message;

                    // Habilitar botón de envío
                    submitButton.disabled = false;
                    submitButton.classList.remove('bg-gray-500');
                    submitButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
                });
            });

            // Validar el formulario antes de enviar
            document.querySelector('form').addEventListener('submit', function(e) {
                if (!selectedPlan) {
                    e.preventDefault();
                    alert('Por favor, selecciona un plan antes de continuar.');
                    return;
                }
            });
        </script>
    </div>
</x-guest-layout>
