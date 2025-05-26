<x-app-layout>
    <div class="min-h-screen flex">
        <aside>
            <x-sidebar :user="Auth::user()" />
        </aside>

        <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">
            <div class="flex items-center justify-between bg-gray-300 p-3 mb-6 border">

                <div class="flex items-center gap-16">
                    <button id="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <h2 class="text-xl pt-1.5 font-semibold leading-tight text-gray-800">
                        {{ __('Empresa') }}
                    </h2>
                </div>
            </div>

            <div class="container py-6">
                @if (!$empresa)
                    <!-- Mostrar formulario solo si no hay empresa registrada -->
                    <div class="row justify-content-center mb-8">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form method="POST" autocomplete="on" action="{{ route('empresas.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-6">
                                            <label for="logo"
                                                class="flex justify-center font-semibold text-gray-700">Logo de la
                                                Empresa</label>

                                            <!-- Contenedor de preview y upload -->
                                            <div class="flex justify-center items-center py-6 gap-6">
                                                <!-- Preview del logo (inicialmente oculto) -->
                                                <div id="logoPreviewContainer" class="hidden">
                                                    <div class="relative">
                                                        <img id="logoPreview"
                                                            class="w-32 h-32 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                                                        <button type="button" onclick="removeLogo()"
                                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="logo" class="form-label font-semibold">Logo</label>
                                            <input type="file"
                                                class="form-control @error('logo') is-invalid @enderror" id="logo"
                                                name="logo" accept="image/*"   onchange="previewLogo(this)">
                                            <div id="logoPreview" class="mt-2 hidden">
                                                <img id="preview" class="w-32 h-32 object-cover rounded-lg">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label font-semibold">Nombre</label>
                                            <input type="text"
                                                class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('nombre') is-invalid @enderror"
                                                id="nombre" name="nombre" value="{{ old('nombre') }}" required>

                                        </div>

                                        <div class="mb-3">
                                            <label for="telefono" class="form-label font-semibold">Teléfono</label>
                                            <input type="tel"
                                                class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('telefono') is-invalid @enderror"
                                                id="telefono" name="telefono" value="{{ old('telefono') }}"
                                                pattern="[0-9]{10}" maxlength="10" placeholder="Ejemplo: 1234567890"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                                required>

                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label font-semibold">Email</label>
                                            <input type="email"
                                                class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" required>

                                        </div>



                                        <div class="mb-3">
                                            <label for="pais" class="form-label font-semibold">País</label>
                                            <input type="text" id="pais" name="pais"
                                                class="form-control @error('pais') is-invalid @enderror"
                                                placeholder="Ejemplo: México" required>

                                        </div>

                                        <div class="mb-3">
                                            <label for="estado" class="form-label font-semibold">Estado</label>
                                            <input type="text" id="estado" name="estado"
                                                class="form-control @error('estado') is-invalid @enderror"
                                                placeholder="Ejemplo: Monterrey" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ciudad" class="form-label font-semibold">Ciudad</label>
                                            <input type="text" id="ciudad" name="ciudad"
                                                class="form-control @error('ciudad') is-invalid @enderror"
                                                placeholder="Ejemplo: Ciudad de México" required>

                                        </div>

                                        <div class="mb-3">
                                            <label for="direccion" class="form-label font-semibold">Dirección</label>
                                            <input type="text" id="direccion" name="direccion"
                                                class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('direccion') is-invalid @enderror"
                                                placeholder="Comienza a escribir tu dirección..."
                                                value="{{ old('direccion') }}" required>


                                            <div class="mb-3">
                                                <label for="horario" class="form-label font-semibold">Horario</label>
                                                <input type="text" id="horario" name="horario"
                                                    class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                    placeholder="Ejemplo: Lunes a Viernes de 9:00 AM a 6:00 PM"
                                                    title="Ingrese un horario válido, por ejemplo: 9:00 AM - 6:00 PM"
                                                    required>
                                                </input>


                                                <div class="mb-3">
                                                    <label for="descripcion"
                                                        class="form-label font-semibold">Descripción</label>
                                                    <textarea
                                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('descripcion') is-invalid @enderror"
                                                        id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn-submit">
                                                        Guardar Datos de la Empresa
                                                    </button>
                                                </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="max-w-2xl mx-auto p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                            <!-- Cabecera con gradiente y logo -->
                            <div class="p-8 text-center bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500">
                                <div class="relative inline-block">
                                    @if ($empresa->logo)
                                        <div class="w-36 h-36 mx-auto rounded-full bg-white p-2 shadow-xl">
                                            <img src="{{ asset('images/' . $empresa->logo) }}"
                                                alt="Logo {{ $empresa->nombre }}"
                                                class="w-full h-full object-cover rounded-full">
                                        </div>
                                    @endif
                                </div>
                                <h4 class="text-3xl font-bold text-white mt-4 mb-2">{{ $empresa->nombre }}</h4>
                                <div class="w-24 h-1 bg-white mx-auto rounded-full opacity-70"></div>
                            </div>

                            <!-- Información de la empresa -->
                            <div class="p-8 bg-gradient-to-b from-gray-50 to-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Teléfono -->
                                    <div
                                        class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <div class="bg-indigo-100 p-3 rounded-full">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">{{ $empresa->telefono }}</span>
                                    </div>

                                    <!-- Email -->
                                    <div
                                        class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <div class="bg-indigo-100 p-3 rounded-full flex-shrink-0">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium break-all">{{ $empresa->email }}</span>
                                    </div>
                                </div>

                                <!-- Dirección -->
                                <div class="mt-6">
                                    <div
                                        class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <div class="bg-indigo-100 p-3 rounded-full">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">
                                            {{ $empresa->direccion }}, {{ $empresa->ciudad }},{{ $empresa->estado }},
                                            {{ $empresa->pais }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Horario -->
                                <div class="mt-6">
                                    <div
                                        class="flex items-center space-x-4 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <div class="bg-indigo-100 p-3 rounded-full">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">{{ $empresa->horario }}</span>
                                    </div>
                                </div>

                                <!-- Descripción -->
                                <div class="mt-6">
                                    <div
                                        class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <h5 class="font-bold text-gray-800 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Descripción
                                        </h5>
                                        <p class="text-gray-600 leading-relaxed">{{ $empresa->descripcion }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
                                <div class="flex justify-center space-x-6">
                                    <a href="{{ route('empresas.edit', $empresa) }}"
                                        class="editBtn transform hover:scale-110 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.199z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('empresas.destroy', $empresa) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="group relative flex h-[50px] w-[55px] flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600">
                                            <svg viewBox="0 0 1.625 1.625"
                                                class="absolute -top-5 fill-white delay-100 group-hover:top-4 group-hover:animate-[spin_1.4s] group-hover:duration-1000"
                                                height="12" width="12">
                                                <path
                                                    d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195">
                                                </path>
                                                <path
                                                    d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033">
                                                </path>
                                                <path
                                                    d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016">
                                                </path>
                                            </svg>
                                            <svg width="14" fill="none" viewBox="0 0 39 7"
                                                class="origin-right duration-500 group-hover:rotate-90">
                                                <line stroke-width="4" stroke="white" y2="5" x2="39"
                                                    y1="5"></line>
                                                <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357"
                                                    y1="1.5" x1="12"></line>
                                            </svg>
                                            <svg width="14" fill="none" viewBox="0 0 33 39" class="mt-1">
                                                <mask fill="white" id="path-1-inside-1_8_19">
                                                    <path
                                                        d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                                    </path>
                                                </mask>
                                                <path mask="url(#path-1-inside-1_8_19)" fill="white"
                                                    d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                                </path>
                                                <path d="M12 6L12 29" stroke="white" stroke-width="4"
                                                    stroke-linecap="round">
                                                </path>
                                                <path d="M21 6V29" stroke="white" stroke-width="4"
                                                    stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if(session('empresa_guardada'))
                        <script>
                            window.onload = function () {
                                const modal = document.getElementById('felicitacionesModal');
                                modal.classList.remove('hidden');
                                modal.classList.add('flex');
                            };
                        </script>
                    @endif
                    
                    <!-- Modal de Felicitaciones -->
                    <div id="felicitacionesModal" class="fixed inset-0 bg-black bg-opacity-60 items-center justify-center z-50 hidden transition-opacity duration-300 ease-in-out">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center animate-fade-in-down relative">
                            <!-- Ícono de éxito -->
                            <div class="mb-4">
                                <svg class="mx-auto w-16 h-16 text-green-500 animate-bounce" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                                </svg>
                            </div>
                    
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">¡Registro de Empresa Exitoso!</h2>
                            <p class="text-gray-600 text-base mb-6 leading-relaxed">
                                La información de la empresa ha sido registrada correctamente. <br><br>
                                Ahora es tiempo de dirigirte al <strong>espacio de trabajadores</strong> para continuar configurando tu entorno de trabajo. <br><br>
                                Recuerda que mantener los datos actualizados ayuda a ofrecer una experiencia más profesional y eficiente.
                            </p>
                    
                            <button onclick="document.getElementById('felicitacionesModal').classList.add('hidden')"
                                    class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition duration-300 shadow-md">
                                Ir al Panel
                            </button>
                        </div>
                    </div>
                    
                    <style>
                        @keyframes fade-in-down {
                            from {
                                opacity: 0;
                                transform: translateY(-20px);
                            }
                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }
                    
                        .animate-fade-in-down {
                            animation: fade-in-down 0.5s ease-out both;
                        }
                    </style>
                    

                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .form-control {
            border: 1px solid #d1d5db !important;
            /* Gris más suave */
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2e75c7 !important;
            /* Indigo/azul */
            box-shadow: 0 0 0 2px rgba(86, 152, 223, 0.2) !important;
            /* Sombra suave azul */
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .btn-submit {
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-submit:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: all 0.5s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(79, 70, 229, 0.3);
            background-color: #4338ca;
        }

        .btn-submit:hover:before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(79, 70, 229, 0.2);
        }

        .bin-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background-color: rgb(255, 95, 95);
            cursor: pointer;
            border: 3px solid rgb(255, 201, 201);
            transition-duration: 0.3s;
        }

        .bin-bottom {
            width: 15px;
        }

        .bin-top {
            width: 17px;
            transform-origin: right;
            transition-duration: 0.3s;
        }

        .bin-button:hover .bin-top {
            transform: rotate(45deg);
        }

        .bin-button:hover {
            background-color: rgb(255, 0, 0);
        }

        .bin-button:active {
            transform: scale(0.9);
        }

        .editBtn {
            width: 55px;
            height: 50px;
            border-radius: 12px;/ border: none;
            background-color: rgb(34, 197, 94);
            /* Color verde */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.123);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }

        .editBtn::before {
            content: "";
            width: 200%;
            height: 200%;
            background-color: rgb(22, 163, 74);
            /* Verde más oscuro para el hover */
            position: absolute;
            z-index: 1;
            transform: scale(0);
            transition: all 0.3s;
            border-radius: 50%;
            filter: blur(10px);
        }

        .editBtn:hover::before {
            transform: scale(1);
        }

        .editBtn:hover {
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.336);
        }

        .editBtn svg {
            height: 17px;
            fill: white;
            z-index: 3;
            transition: all 0.2s;
            transform-origin: bottom;
        }

        .editBtn:hover svg {
            transform: rotate(-15deg) translateX(5px);
        }

        .editBtn::after {
            content: "";
            width: 25px;
            height: 1.5px;
            position: absolute;
            bottom: 19px;
            left: -5px;
            background-color: white;
            border-radius: 2px;
            z-index: 2;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease-out;
        }

        .editBtn:hover::after {
            transform: scaleX(1);
            left: 0px;
            transform-origin: right;
        }
    </style>

    <!-- Agregar este script para el horario personalizado -->
    <script>
        function previewLogo(input) {
            const previewContainer = document.getElementById('logoPreviewContainer');
            const preview = document.getElementById('logoPreview');
            const fileName = document.getElementById('logoFileName');

            if (input.files && input.files[0]) {
                // Validar tamaño del archivo (max 2MB)
                if (input.files[0].size > 2 * 1024 * 1024) {
                    alert('El archivo es demasiado grande. El tamaño máximo permitido es 2MB.');
                    input.value = '';
                    return;
                }

                // Validar tipo de archivo
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(input.files[0].type)) {
                    alert('Formato de archivo no válido. Por favor sube una imagen JPG, PNG o GIF.');
                    input.value = '';
                    return;
                }

                // Mostrar preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    fileName.textContent = input.files[0].name;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeLogo() {
            const input = document.getElementById('logo');
            const previewContainer = document.getElementById('logoPreviewContainer');
            const fileName = document.getElementById('logoFileName');

            input.value = '';
            previewContainer.classList.add('hidden');
            fileName.textContent = 'Ningún archivo seleccionado';
        }

        // Si hay un error de validación y ya había una imagen seleccionada
        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.getElementById('logo');
            if (logoInput.files.length > 0) {
                previewLogo(logoInput);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const paisInput = document.getElementById('pais');
            const estadoInput = document.getElementById('estado');
            const ciudadInput = document.getElementById('ciudad');

            // Verificar si los campos están vacíos
            if (!paisInput.value && !ciudadInput.value && !estadoInput.value) {
                async function obtenerUbicacion() {
                    try {
                        const response = await fetch('https://ipapi.co/json/');
                        const data = await response.json();

                        // Rellenar los campos solo si están vacíos
                        if (!paisInput.value) paisInput.value = data.country_name || '';
                        if (!ciudadInput.value) ciudadInput.value = data.city || '';
                        if (!estadoInput.value) estadoInput.value = data.region || '';
                    } catch (error) {
                        console.error('Error al obtener la ubicación:', error);
                        alert(
                            'No se pudo obtener la ubicación automáticamente. Por favor, ingrésela manualmente.'
                        );
                    }
                }

                // Llamar a la función al cargar la página
                obtenerUbicacion();
            }
        });

        // Validación del teléfono
        document.getElementById('telefono').addEventListener('input', function(e) {
            let value = e.target.value;
            // Eliminar cualquier carácter que no sea número
            value = value.replace(/[^0-9]/g, '');
            // Limitar a 10 dígitos
            value = value.slice(0, 10);
            e.target.value = value;
        });

        // Función para actualizar las ciudades según el país seleccionado
        document.getElementById('pais').addEventListener('change', function() {
            const ciudadSelect = document.getElementById('ciudad');
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

            const ciudades = ciudadesPorPais[this.value] || [];
            ciudades.forEach(ciudad => {
                const option = document.createElement('option');
                option.value = ciudad;
                option.textContent = ciudad;
                ciudadSelect.appendChild(option);
            });
        });

        // Mantener la ciudad seleccionada si hay un error de validación
        const oldPais = "{{ old('pais') }}";
        const oldCiudad = "{{ old('ciudad') }}";
        if (oldPais) {
            document.getElementById('pais').value = oldPais;
            document.getElementById('pais').dispatchEvent(new Event('change'));
            if (oldCiudad) {
                setTimeout(() => {
                    document.getElementById('ciudad').value = oldCiudad;
                }, 100);
            }
        }

        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('logoPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
  
</x-app-layout>
