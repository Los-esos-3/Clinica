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
                        {{ __('Asignar Secretaria') }}
                    </h2>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- Formulario para asignar una secretaria -->
                            <form method="POST" autocomplete="on" action="{{ route('Doctor.Secretaria.Asignar') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="secretaria_id" class="block text-sm font-medium text-gray-700">
                                        Seleccionar Secretaria
                                    </label>
                                    <select name="secretaria_id" id="secretaria_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                        Asignar Secretaria
                                    </button>
                                </div>
                            </form>

                            <!-- Lista de secretarias asignadas -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-4">Secretarias Asignadas</h3>
                                <ul>
                                    @foreach ($secretariasAsignadas as $secretaria)
                                        <li class="flex items-center justify-between p-4 border-b">
                                            <span>{{ $secretaria->user->name }}</span>
                                            <form method="POST" autocomplete="on"
                                                action="{{ route('Doctor.Secretaria.Desasignar', $secretaria->id) }}">
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
        </div>
    </div>
</x-app-layout>
