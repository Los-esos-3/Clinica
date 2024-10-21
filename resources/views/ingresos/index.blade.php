@role('Admin')
    @include('ingresos.ingresosSecretaria')
@endrole

@role('Doctor')
    @include('ingresos.ingresosDoctor')
@endrole

@role('Secretaria')
    @include('ingresos.ingresosSecretaria')
@endrole

