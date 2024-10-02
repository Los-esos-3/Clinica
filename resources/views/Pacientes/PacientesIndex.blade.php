@role('Doctor')
<x-app-layout>
    <x-pacientes-doctor-component :pacientes="$pacientes"></x-pacientes-doctor-component>
</x-app-layout>
@endrole

@role('Secretaria')
<x-app-layout>
    <x-pacientes-secretaria-component :pacientes="$pacientes"></x-pacientes-secretaria-component>
</x-app-layout>
@endrole
