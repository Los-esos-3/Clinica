@php
    $nombreEmpresa = 'Expemed'; // Valor por defecto

    // Verifica si el usuario está autenticado y tiene una empresa asociada
    if (Auth::check() && Auth::user()->empresa_id) {
        $empresa = \App\Models\Empresa::find(Auth::user()->empresa_id);
        $nombreEmpresa = $empresa ? $empresa->nombre : $nombreEmpresa; // Asigna el nombre de la empresa si existe
    }
@endphp

<style>
   a {
        text-decoration: none;
        color: inherit;
    }

    .header-title {
        font-family: 'Arial', sans-serif;
        text-align: left;
        padding: 25px 25px;
        border-radius: 8px;
      
    }
    .kaiser {
        font-size: 18px;
        font-weight: 700;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 2);
    }


</style>

<a class="no-underline" href="{{ route('welcome') }}">
    <div class="header-title"> 
        <span class="kaiser">{{ $nombreEmpresa }}</span> 
    </div> 
</a>