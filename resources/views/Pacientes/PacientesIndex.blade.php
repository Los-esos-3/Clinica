<x-app-layout>
    @if(Auth::user()->hasRole('Admin'))
        <div class="p-4 sm:p-6 md:p-8 min-h-screen bg-gray-100">
            <div class="max-w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-2xl font-semibold mb-4">Gestión de Pacientes</h2>
                        
                        <div x-data="{ activeTab: 'doctor' }">
                            <!-- Pestañas -->
                            <div class="mb-4 border-b border-gray-200">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="mr-2">
                                        <button 
                                            @click="activeTab = 'doctor'" 
                                            :class="{'border-blue-500': activeTab === 'doctor', 'border-transparent': activeTab !== 'doctor'}"
                                            class="inline-block p-4 border-b-2 rounded-t-lg">
                                            Vista Doctor
                                        </button>
                                    </li>
                                    <li class="mr-2">
                                        <button 
                                            @click="activeTab = 'secretaria'" 
                                            :class="{'border-blue-500': activeTab === 'secretaria', 'border-transparent': activeTab !== 'secretaria'}"
                                            class="inline-block p-4 border-b-2 rounded-t-lg">
                                            Vista Secretaria
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Contenido de las pestañas -->
                            <div class="mt-4">
                                <div x-show="activeTab === 'doctor'" class="p-4 rounded-lg bg-gray-50" x-transition>
                                    <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
                                </div>
                                <div x-show="activeTab === 'secretaria'" class="p-4 rounded-lg bg-gray-50" x-transition>
                                    <x-pacientes-secretaria-component :pacientes="$pacientes"></x-pacientes-secretaria-component>
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
