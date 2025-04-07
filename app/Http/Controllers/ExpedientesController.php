<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;
use App\Models\Doctores;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExpedientesController 
{
    public function index()
    {
        // Cargar expedientes con la relación de paciente y doctor
        $expedientes = Expediente::with(['paciente', 'doctor'])->paginate(10);
        return view('Expedientes.ExpedientesIndex', compact('expedientes'));
    }

    public function admin()
    {
        $expedientes = Expediente::with(['paciente', 'doctor'])->get();
        return view('Expedientes.ExpedienteIndexAdmin', compact('expedientes'));
    }

    public function create(Request $request)
    {
        // Verifica si se ha pasado el ID del paciente
        if (!$request->has('paciente_id')) {
            return redirect()->back()->with('error', 'Es necesario seleccionar un paciente primero.');
        }
    
        // Busca al paciente por su ID
        $paciente = Paciente::find($request->paciente_id);
    
        // Verifica si el paciente existe
    
        // Busca al paciente por su ID
        $paciente = Paciente::find($request->paciente_id);
    
        // Verifica si el paciente existe
        if (!$paciente) {
            return redirect()->back()->with('error', 'El paciente seleccionado no existe.');
        }
    
        // Obtiene todos los doctores
        $doctores = Doctores::all();
    
        // Genera un número de expediente único
        $numero_expediente = $this->generateUniqueExpedienteNumber();
    
        // Pasa las variables a la vista
        return view('Expedientes.Create', compact('paciente', 'doctores', 'numero_expediente'));
    
        // Genera un número de expediente único
        $numero_expediente = $this->generateUniqueExpedienteNumber();
    
        // Pasa las variables a la vista
        return view('Expedientes.Create', compact('paciente', 'doctores', 'numero_expediente'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'estado' => 'required|string',
            'alergias' => 'nullable|string',
            'antecedentes_medicos' => 'nullable|string',
            'historial_quirurgico' => 'nullable|string',
            'historial_familiar' => 'nullable|string',
            'vacunas' => 'nullable|string',
            'medicamentos' => 'nullable|string',
            'estudios_previos' => 'nullable|string',
            'notas_medicas' => 'nullable|string',
            'fecha_registro' => 'required|date',
        ]);
    

        // Generar un número de expediente único
        $numero_expediente = $this->generateUniqueExpedienteNumber();

        // Crear el expediente
        Expediente::create(array_merge($validatedData, ['numero_expediente' => $numero_expediente]));

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta actualizada con éxito.');
    }

    private function generateUniqueExpedienteNumber()
    {
        do {
            $numero = strtoupper(uniqid()); // Generar un número único
        } while (Expediente::where('numero_expediente', $numero)->exists());

        return $numero;
    }
    public function show($id)
    {
        // Obtener el expediente específico junto con el doctor y el paciente
        $expediente = Expediente::with(['paciente', 'doctor'])->findOrFail($id);
        return view('Expedientes.Show', compact('expediente'));
    }

    public function edit($id)
    {
        $expediente = Expediente::findOrFail($id);
        $doctores = Doctores::all();
        return view('Expedientes.Edit', compact('expediente', 'doctores'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            
            'estado' => 'required|string',
            'alergias' => 'nullable|string',
            'antecedentes_medicos' => 'nullable|string',
            'historial_quirurgico' => 'nullable|string',
            'historial_familiar' => 'nullable|string',
            'vacunas' => 'nullable|string',
            'medicamentos' => 'nullable|string',
            'estudios_previos' => 'nullable|string',
            'notas_medicas' => 'nullable|string',
            'fecha_registro' => 'required|date',
        ]);

        $expediente = Expediente::findOrFail($id);

        $expediente->update($validatedData);

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Expediente actualizado con éxito.');
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);
        $expediente->delete();

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Expediente eliminado con éxito.');
    }

    public function getCitas()
    {
        $citas = Expediente::with(['paciente', 'doctor'])
            ->get();

        $formattedCitas = $citas->map(function ($cita) {
            $hora12 = \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora_proxima_cita)->format('h:i A');
            return [
                'title' => '', // El título se manejará en el frontend
                'start' => $cita->proxima_cita . 'T' . $cita->hora_proxima_cita,
                'extendedProps' => [
                    'paciente' => $cita->paciente->nombre,
                    'doctor' => $cita->doctor->nombre_completo,
                    'hora' => $hora12,
                ],
            ];
        });

        return response()->json($formattedCitas);
    }
}