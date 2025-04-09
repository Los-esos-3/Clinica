<x-app-layout>
    @if (Auth::user()->hasAnyRole(['Root', 'Admin']))

        <div>
            <div x-data="{ activeTab: 'doctor' }">
                <!-- Contenido de las pestañas -->
                <div>
                    <div x-show="activeTab === 'doctor'">
                        <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if (Auth::user()->hasRole('Doctor'))
            <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
        @endif

        @if (Auth::user()->hasRole('Secretaria'))
            <x-pacientes-secretaria-component :pacientes="$pacientes"></x-pacientes-secretaria-component>
        @endif
    @endif
</x-app-layout>
