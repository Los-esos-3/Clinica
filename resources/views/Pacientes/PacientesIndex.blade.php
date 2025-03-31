<x-app-layout>
    @if (Auth::user()->hasAnyRole(['Root','Admin']))
        <div class="p-4 sm:p-6 md:p-8 min-h-screen bg-gray-100">
            <div class="max-w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-4 sm:p-6">
                        <x-slot name="header">
                            <div class="flex items-center justify-between">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Registro de Pacientes') }}
                                </h2>
                            </div>
                            <div class="flex justify-items-center justify-center">
                                <ul class="flex">
                                    <li>
                                        <a href="{{ route('welcome') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            BIENVENIDA
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            INICIO
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctores.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            DOCTORES
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('secretarias.index') }}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            SECRETARIAS
                                        </a>
                                    </li> 
                                    <li class="ml-1">
                                        <a href="{{route('Pacientes.PacientesView')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            PACIENTES
                                        </a>
                                    </li>
                                    @if (Auth::user()->hasAnyRole(['Root']))
                                    <li>
                                        <a href="{{route('roles.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            ROLES
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{route('empresas.index')}}" class="inline-block p-4 border-b-2 rounded-t-lg no-underline text-zinc-950">
                                            EMPRESA
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </x-slot>
                     
                        
                        <div x-data="{ activeTab: 'doctor' }">
                            <!-- Contenido de las pestañas -->
                            <div class="mt-4">
                                <div x-show="activeTab === 'doctor'" class="p-4 rounded-lg bg-gray-50" x-transition>
                                    <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(Auth::user()->hasRole('Doctor'))
            <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
        @endif

        @if(Auth::user()->hasRole('Secretaria'))
            <x-pacientes-secretaria-component :pacientes="$pacientes"></x-pacientes-secretaria-component>
        @endif
    @endif
</x-app-layout>
