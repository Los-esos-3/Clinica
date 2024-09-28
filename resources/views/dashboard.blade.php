<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@role('Doctor')
<x-app-layout>
    <x-dashboard-doctor-component></x-dashboard-doctor-component>
</x-app-layout>
@endrole

@role('Secretaria')
<x-app-layout>
    <x-dashboard-secretaria-component></x-dashboard-secretaria-component>
</x-app-layout>
@endrole
</body>
</html>