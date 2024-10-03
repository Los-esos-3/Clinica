<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Paciente;

class ClinicaController extends Controller  
{
    use HasRoles;
    public function PacientesView(){
        
        $pacientes = Paciente::all();
        return view('Pacientes.PacientesIndex', compact('pacientes'));

    }
    public function create()
    {
        return view('pacientes.create'); // Retornar la vista para crear un nuevo paciente
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:10',
            'estado_civil' => 'nullable|string|max:20',
            'tipo_sangre' => 'nullable|string|max:10',
            'ocupacion' => 'nullable|string|max:100',
        ]);

        Paciente::create(array_merge($request->all(), [
            'fecha_registro' => now(), // Establecer 'fecha_registro' al valor actual
            'hora_registro' => now()->format('H:i:s'), // Establecer 'hora_registro'
        ]));

        return redirect()->route('Pacientes.PacientesView'); // Redirigir a la lista de pacientes
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id); // Obtener el paciente por ID
        return view('pacientes.edit', compact('paciente')); // Retornar la vista para editar el paciente
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:10',
            'estado_civil' => 'nullable|string|max:20',
            'tipo_sangre' => 'nullable|string|max:10',
            'ocupacion' => 'nullable|string|max:100',
        ]);

        $paciente = Paciente::findOrFail($id); 
        $paciente->update($request->all());

        return redirect()->route('Pacientes.PacientesView');
    }

    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('Pacientes.PacientesView');
    }
}
