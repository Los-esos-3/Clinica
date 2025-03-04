<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registro de Empresa') }}
            </h2>
            <ul class="flex">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-4 ml-8 border-b-2 rounded-t-lg no-underline text-zinc-950 hover:text-indigo-600 transition-colors duration-200">
                        INICIO
                    </a>
                </li>
            </ul>
        </div>
    </x-slot>

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

                            <form method="POST" action="{{ route('empresas.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="logo" class="form-label font-semibold">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo" accept="image/*" Esto permite solo imágenes -->
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
                                        id="telefono" name="telefono" value="{{ old('telefono') }}" pattern="[0-9]{10}"
                                        maxlength="10" placeholder="Ejemplo: 1234567890"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" required>

                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label font-semibold">Email</label>
                                    <input type="email"
                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>

                                </div>



                                <div class="mb-3">
                                    <label for="pais" class="form-label font-semibold">País</label>
                                    <select id="pais" name="pais"
                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('pais') is-invalid @enderror"
                                        required>
                                        <option value="">Seleccione un país</option>
                                        <option value="México">México</option>
                                        <option value="España">España</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Chile">Chile</option>
                                        <option value="Perú">Perú</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Panamá">Panamá</option>
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="ciudad" class="form-label font-semibold">Ciudad</label>
                                    <select id="ciudad" name="ciudad"
                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('ciudad') is-invalid @enderror"
                                        required>
                                        <option value="">Seleccione primero un país</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label font-semibold">Dirección</label>
                                    <input type="text" id="direccion" name="direccion"
                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('direccion') is-invalid @enderror"
                                        placeholder="Comienza a escribir tu dirección..." value="{{ old('direccion') }}"
                                        required>

                                </div>
                                <div class="mb-3">
                                    <label for="horario" class="form-label font-semibold">Horario</label>
                                    <select
                                        class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('horario') is-invalid @enderror"
                                        id="horario" name="horario" required>
                                        <option value="">Seleccione un horario</option>
                                        <option value="Lunes a Viernes de 9:00 AM a 6:00 PM">Lunes a Viernes de 9:00 AM
                                            a 6:00 PM</option>
                                        <option value="Lunes a Sábado de 9:00 AM a 6:00 PM">Lunes a Sábado de 9:00 AM a
                                            6:00 PM</option>
                                        <option value="Lunes a Domingo de 9:00 AM a 6:00 PM">Lunes a Domingo de 9:00 AM
                                            a 6:00 PM</option>
                                        <option value="Lunes a Viernes de 8:00 AM a 5:00 PM">Lunes a Viernes de 8:00 AM
                                            a 5:00 PM</option>
                                        <option value="Lunes a Sábado de 8:00 AM a 5:00 PM">Lunes a Sábado de 8:00 AM a
                                            5:00 PM</option>
                                        <option value="Lunes a Domingo de 8:00 AM a 5:00 PM">Lunes a Domingo de 8:00 AM
                                            a 5:00 PM</option>
                                        <option value="Lunes a Viernes de 10:00 AM a 7:00 PM">Lunes a Viernes de 10:00
                                            AM a 7:00 PM</option>
                                        <option value="Lunes a Sábado de 10:00 AM a 7:00 PM">Lunes a Sábado de 10:00 AM
                                            a 7:00 PM</option>
                                        <option value="Lunes a Domingo de 10:00 AM a 7:00 PM">Lunes a Domingo de 10:00
                                            AM a 7:00 PM</option>
                                        <option value="24/7">Abierto las 24 horas, todos los días</option>
                                        <option value="custom">Horario Personalizado</option>
                                    </select>

                                    <div id="customHorario" class="mt-2 hidden">
                                        <input type="text"
                                            class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            name="horario_custom" placeholder="Especifique el horario">
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label font-semibold">Descripción</label>
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
                                    {{ $empresa->direccion }}, {{ $empresa->ciudad }}, {{ $empresa->pais }}
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
                            <form action="{{ route('empresas.destroy', $empresa) }}" method="POST" class="inline">
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
                                        <path d="M12 6L12 29" stroke="white" stroke-width="4" stroke-linecap="round">
                                        </path>
                                        <path d="M21 6V29" stroke="white" stroke-width="4" stroke-linecap="round">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
        document.getElementById('horario').addEventListener('change', function() {
            const customHorario = document.getElementById('customHorario');
            if (this.value === 'custom') {
                customHorario.classList.remove('hidden');
            } else {
                customHorario.classList.add('hidden');
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

        const ciudadesPorPais = {
            'México': ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'León', 'Juárez', 'Cancún',
                'Mérida', 'Querétaro'
            ],
            'España': ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Bilbao',
                'Alicante'
            ],
            'Colombia': ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena', 'Cúcuta', 'Bucaramanga', 'Pereira',
                'Santa Marta', 'Ibagué'
            ],
            'Argentina': ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'San Miguel de Tucumán',
                'Mar del Plata', 'Salta', 'Santa Fe', 'San Juan'
            ],
            'Chile': ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Antofagasta', 'Temuco', 'Rancagua', 'Talca',
                'Arica', 'Puerto Montt'
            ],
            'Perú': ['Lima', 'Arequipa', 'Trujillo', 'Chiclayo', 'Piura', 'Cusco', 'Huancayo', 'Tacna', 'Ica',
                'Pucallpa'
            ],
            'Ecuador': ['Quito', 'Guayaquil', 'Cuenca', 'Machala', 'Manta', 'Portoviejo', 'Ambato', 'Riobamba', 'Loja',
                'Ibarra'
            ],
            'Venezuela': ['Caracas', 'Maracaibo', 'Valencia', 'Barquisimeto', 'Maracay', 'Ciudad Guayana', 'Barcelona',
                'Maturín', 'Petare', 'Mérida'
            ],
            'Bolivia': ['La Paz', 'Santa Cruz de la Sierra', 'Cochabamba', 'Sucre', 'Oruro', 'Potosí', 'Tarija',
                'Trinidad', 'Cobija', 'Riberalta'
            ],
            'Paraguay': ['Asunción', 'Ciudad del Este', 'San Lorenzo', 'Luque', 'Capiatá', 'Lambaré',
                'Fernando de la Mora', 'Limpio', 'Ñemby', 'Encarnación'
            ],
            'Uruguay': ['Montevideo', 'Salto', 'Paysandú', 'Las Piedras', 'Rivera', 'Maldonado', 'Tacuarembó', 'Melo',
                'Mercedes', 'Artigas'
            ],
            'Costa Rica': ['San José', 'Alajuela', 'Cartago', 'Heredia', 'Liberia', 'Limón', 'Puntarenas', 'Quesada',
                'San Isidro', 'Turrialba'
            ],
            'Panamá': ['Ciudad de Panamá', 'San Miguelito', 'Tocumen', 'David', 'Arraiján', 'Colón', 'La Chorrera',
                'Santiago', 'Chitré', 'Penonomé'
            ]
        };

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

        document.getElementById('search_button').addEventListener('click', function() {
            const searchValue = document.getElementById('search_user').value;

            fetch(`/buscar-usuarios?nombre=${searchValue}`)
                .then(response => response.json())
                .then(data => {
                    const userResultsDiv = document.getElementById('user_results');
                    userResultsDiv.innerHTML = ''; // Limpiar resultados anteriores

                    if (data.length > 0) {
                        data.forEach(user => {
                            const userDiv = document.createElement('div');
                            userDiv.classList.add('flex', 'items-center', 'justify-between', 'border',
                                'p-2', 'my-1');
                            userDiv.innerHTML = `
                            <span>${user.name}</span>
                            <button type="button" class="ml-2 bg-green-500 text-white px-2 py-1 rounded" onclick="addUser(${user.id}, '${user.name}')">Agregar</button>
                        `;
                            userResultsDiv.appendChild(userDiv);
                        });
                    } else {
                        userResultsDiv.innerHTML = '<p>No se encontraron usuarios.</p>';
                    }
                });
        });

        function addUser(userId, userName) {
            // Verificar si el usuario ya está en la lista
            if (!selectedUsers.includes(userId)) {
                selectedUsers.push(userId); // Agregar el ID del usuario al array
                const userListDiv = document.getElementById('selected_users');
                const userItem = document.createElement('div');
                userItem.classList.add('flex', 'items-center', 'justify-between', 'border', 'p-2', 'my-1',
                'bg-green-100'); // Resaltar el usuario agregado
                userItem.innerHTML = `
                <span>${userName}</span>
                <button type="button" class="ml-2 text-red-500" onclick="removeUser(${userId}, this)">Eliminar</button>
            `;
                userListDiv.appendChild(userItem);

                // Mostrar mensaje de confirmación
                const confirmationMessage = document.createElement('div');
                confirmationMessage.classList.add('alert', 'alert-success', 'mt-2');
                confirmationMessage.innerText = `${userName} ha sido agregado.`;
                document.getElementById('user_results').appendChild(confirmationMessage);

                // Eliminar el mensaje después de 3 segundos
                setTimeout(() => {
                    confirmationMessage.remove();
                }, 3000);
            } else {
                alert('Este usuario ya ha sido agregado.');
            }
        }

        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000); // 5000ms = 5 segundos
    </script>
</x-app-layout>
