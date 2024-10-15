<x-guest-layout>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        <div class="container px-4 py-8 mx-auto">
            <div class="flex flex-col items-center justify-center md:flex-row">
                <div class="w-full px-4 py-8 bg-white rounded-lg shadow-md md:w-2/3">
                    <div class="flex">
                        <!-- Left Panel -->
                        <div class="w-1/2 p-4 bg-blue-500 rounded-l-lg">
                            <h2 class="mb-4 text-2xl font-bold text-center text-white">¡Cuidamos tu salud desde la comodidad de tu hogar!</h2>
                            <p class="text-white">En nuestra clínica, tu bienestar es nuestra prioridad. Accede a consultas médicas desde la seguridad y comodidad de tu casa, sin largas esperas ni traslados innecesarios.</p>
                            <hr class="my-2 border-white">
                            <p class="font-bold text-white">Consulta a nuestros especialistas por videollamada y obtén orientación médica personalizada, ¡totalmente gratuita!</p>
                            <hr class="my-2 border-white">
                            <p class="text-white">¿Necesitas una segunda opinión? Solo regístrate nuevamente para acceder a nuestras consultas médicas cuando lo necesites.</p>
                            <hr class="my-2 border-white">
                            <p class="text-white">Consulta nuestro <a href="#" class="text-white underline">Aviso de Privacidad</a> para saber más sobre cómo protegemos tu información.</p>
                        </div>

                        <!-- Right Panel -->
                        <div class="w-1/2 p-4 bg-white rounded-r-lg">
                            <h2 class="mb-4 text-2xl font-bold text-center">Registro</h2>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-4">
                                    <x-label for="name" value="Nombre" />
                                    <x-input id="name" class="block w-full mt-1" type="text" name="name" placeholder="Nombre" :value="old('name')" required autofocus />
                                </div>
                                <div class="mb-4">
                                    <x-label for="email" value="Correo electrónico" />
                                    <x-input id="email" class="block w-full mt-1" type="email" name="email" placeholder="Correo electrónico" :value="old('email')" required />
                                </div>
                                <div class="mb-4">
                                    <x-label for="password" value="Contraseña" />
                                    <x-input id="password" class="block w-full mt-1" type="password" name="password" placeholder="Contraseña" required autocomplete="new-password" />
                                </div>
                                <div class="mb-4">
                                    <x-label for="password_confirmation" value="Confirmar contraseña" />
                                    <x-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required />
                                </div>
                                <div class="mb-4">
                                    <x-label for="phone" value="Teléfono" />
                                    <x-input id="phone" class="block w-full mt-1" type="tel" name="phone" placeholder="Teléfono" required />
                                </div>
                                <div class="mb-4">
                                    <x-label for="birthdate" value="Fecha de nacimiento" />
                                    <x-input id="birthdate" class="block w-full mt-1" type="date" name="birthdate" required />
                                </div>
                                <div class="mb-4">
                                    <x-label for="gender" value="Género" />
                                    <select id="gender" name="gender" class="block w-full mt-1 border rounded-md">
                                        <option value="" disabled selected>Seleccione su género</option>
                                        <option value="male">Masculino</option>
                                        <option value="female">Femenino</option>
                                        <option value="other">Otro</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-center">
                                    <x-button class="bg-blue-500 hover:bg-blue-700">
                                        Registrar
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div
</x-guest-layout>