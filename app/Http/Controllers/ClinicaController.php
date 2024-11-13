<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Paciente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicaController extends Controller  
{
    use HasRoles;
    use AuthorizesRequests;
    public function PacientesView(Request $request)
    {
        $query = $request->input('search');
        
        if ($query) {
            $pacientes = Paciente::where('nombre', 'LIKE', "%{$query}%")->with('expediente')->get();
        } else {
            $pacientes = Paciente::with('expediente')->get();
        }

        // Verificar si no se encontraron pacientes
        $noResultsMessage = $pacientes->isEmpty() ? "No se encontró ningún paciente con ese nombre." : null;

            return view('Pacientes.PacientesIndex', compact('pacientes', 'noResultsMessage'));
        }

    public function index()
    {
        $pacientes = Paciente::with('expediente')->get();
        return view('Pacientes.PacientesIndex', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create'); // Retornar la vista para crear un nuevo paciente
    }

    public function store(Request $request)
    {
        $this->authorize('crear pacientes');
        
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
    
        // Crear el paciente solo si no se ha registrado antes
        $pacienteData = $request->all();
    
        // Comprobar si 'fecha_registro' y 'hora_registro' ya están definidas
        if (empty($pacienteData['fecha_registro']) && empty($pacienteData['hora_registro'])) {
            $pacienteData['fecha_registro'] = now()->format('Y-m-d'); // Establecer 'fecha_registro' al valor actual
            $pacienteData['hora_registro'] = now()->format('H:i:s');
        }
    
        Paciente::create($pacienteData); // Crear el paciente
    
        return redirect()->route('Pacientes');
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

        return redirect()->route('Pacientes');
    }
}
