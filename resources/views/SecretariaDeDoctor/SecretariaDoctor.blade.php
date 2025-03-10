<!-- resources/views/doctor/secretarias.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Secretaria') }}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Formulario para agregar una secretaria -->
                    <form method="POST" action="{{ route('doctor.secretarias.asignarSecretaria') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="secretaria_id" class="block text-sm font-medium text-gray-700">Seleccionar
                                Secretaria</label>
                            <select name="secretaria_id" id="secretaria_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                Asociar Secretaria
                            </button>
                        </div>
                    </form>

                    <!-- Lista de secretarias asociadas -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Secretarias Asociadas</h3>
                        <ul>
                            @foreach ($secretarias as $secretaria)
                                <li class="flex items-center justify-between p-4 border-b">
                                    <span>{{ $secretaria->nombre_completo }}</span>
                                    <form method="POST"
                                        action="{{ route('doctor.secretarias.destroy', $secretaria->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            Desasignar
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
