<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Empresa') }}
            </h2>
        </div>
    </x-slot>

    <div class="containerDelForm">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Cabecera con logo actual -->
            <div class="p-8 text-center bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500">
                <div class="relative inline-block">
                    @if ($empresa->logo)
                        <div class="w-36 h-36 mx-auto rounded-full bg-white p-2 shadow-xl">
                            <img src="{{ asset('images/' . $empresa->logo) }}" alt="Logo actual"
                                class="w-full h-full object-cover rounded-full">
                        </div>
                    @endif
                </div>
                <h4 class="text-3xl font-bold text-white mt-4 mb-2">{{ $empresa->nombre }}</h4>
                <div class="w-24 h-1 bg-white mx-auto rounded-full opacity-70"></div>
            </div>

            <!-- Formulario de edición -->
            <div class="p-8">
                <form method="POST" autocomplete="on" action="{{ route('empresas.update', $empresa->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Logo -->
                    <div class="mb-6">
                        <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">Nuevo Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ old('nombre', $empresa->nombre) }}" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono"
                            value="{{ old('telefono', $empresa->telefono) }}" pattern="[0-9]{10}" maxlength="10"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $empresa->email) }}" required>
                    </div>

                    <!-- País -->
                    <div class="mb-3">
                        <label for="pais" class="form-label font-semibold">País</label>
                        <input type="text" id="pais" name="pais"
                            class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('pais') is-invalid @enderror"
                            value="{{ old('pais', $empresa->pais) }}" required>
                    </div>

                    {{-- Estado --}}
                    <div class="mb-3">
                        <label for="estado" class="form-label font-semibold">Estado</label>
                        <input type="text" id="estado" name="estado"
                            value="{{ old('estado', $empresa->estado) }}"
                            class="form-control @error('estado') is-invalid @enderror" placeholder="Ejemplo: Monterrey"
                            required>
                    </div>

                    <!-- Ciudad -->
                    <div class="mb-3">
                        <label for="ciudad" class="form-label font-semibold">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad"
                            class="form-control border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('ciudad') is-invalid @enderror"
                            value="{{ old('ciudad', $empresa->ciudad) }}" required>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-6">
                        <label for="direccion" class="block text-sm font-semibold text-gray-700 mb-2">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                            value="{{ old('direccion', $empresa->direccion) }}" required>
                    </div>

                    <!-- Horario -->
                    <div class="mb-6">
                        <label for="horario" class="block text-sm font-semibold text-gray-700 mb-2">Horario</label>
                        <input value="{{ old('horario', $empresa->horario) }}" type="text"
                            placeholder="Escribe tu horario" class="form-control" id="horario" name="horario"></input>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-6">
                        <label for="descripcion"
                            class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $empresa->descripcion) }}</textarea>
                    </div>
                    <!-- Botón de guardar -->
                    <div class="text-center space-x-4">
                        <button type="submit" class="button-update">
                            Actualizar Empresa
                        </button>
                        <a href="{{ route('empresas.index') }}" class="button-cancel">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .containerDelForm {
            width: 100%;
            padding-right: var(--bs-gutter-x, .75rem);
            padding-left: var(--bs-gutter-x, .75rem);
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 640px) {
            .containerDelForm {
                max-width: 640px;
            }
        }

        @media (min-width: 768px) {
            .containerDelForm {
                max-width: 768px;
            }
        }

        @media (min-width: 1024px) {
            .containerDelForm {
                max-width: 768px;
            }
        }

        @media (min-width: 1280px) {
            .containerDelForm {
               max-width: 768px;
            }
        }

        @media (min-width: 1536px) {
            .containerDelForm {
                max-width: 768px;
            }
        }

        .form-control {
            @apply w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm;
        }

        .button-update {
            padding: 0.8em 1.8em;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            background: #2563eb;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .button-update:hover {
            background: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.4);
        }

        .button-update:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(37, 99, 235, 0.3);
        }

        .button-cancel {
            padding: 0.8em 1.8em;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            background: #dc2626;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .button-cancel:hover {
            background: #b91c1c;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(220, 38, 38, 0.4);
            color: white !important;
        }

        .button-cancel:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(220, 38, 38, 0.3);
            color: white;
        }

        .button-cancel:link,
        .button-cancel:visited,
        .button-cancel:focus {
            color: white;
            text-decoration: none;
        }

        .form-control.is-invalid {
            @apply border-red-500;
        }

        .invalid-feedback {
            @apply text-red-500 text-sm mt-1;
        }
    </style>

    <script>
        // Función para actualizar las ciudades
        function actualizarCiudades() {
            const paisSelect = document.getElementById('pais');
            const ciudadSelect = document.getElementById('ciudad');
            const ciudadActual = '{{ old('ciudad', $empresa->ciudad) }}';

            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

            if (paisSelect.value) {
                const ciudades = ciudadesPorPais[paisSelect.value] || [];
                ciudades.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad;
                    option.textContent = ciudad;
                    option.selected = ciudad === ciudadActual;
                    ciudadSelect.appendChild(option);
                });
            }
        }

        // Event listeners
        document.getElementById('pais').addEventListener('change', actualizarCiudades);
        document.getElementById('horario').addEventListener('change', function() {
            const customHorario = document.getElementById('customHorario');
            customHorario.classList.toggle('hidden', this.value !== 'custom');
        });

        // Inicializar ciudades al cargar la página
        window.addEventListener('load', actualizarCiudades);
    </script>
</x-app-layout>
