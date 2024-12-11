<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;
use App\Models\Doctores;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExpedientesController extends Controller
{
    public function index()
    {
        // Cargar expedientes con la relación de paciente y doctor
        $expedientes = Expediente::with(['paciente', 'doctor'])->get();
        return view('Expedientes.ExpedientesIndex', compact('expedientes'));
    }

    public function admin()
    {
        $expedientes = Expediente::with(['paciente', 'doctor'])->get();
        return view('Expedientes.ExpedienteIndexAdmin', compact('expedientes'));
    }

    public function create(Request $request)
    {
        if (!$request->has('paciente_id')) {
            return redirect()->back()->with('error', 'Es necesario seleccionar un paciente primero.');
        }

        $paciente = Paciente::find($request->paciente_id); // Busca al paciente por su ID

        if (!$paciente) {
            return redirect()->back()->with('error', 'El paciente seleccionado no existe.');
        }
        $doctores = Doctores::all();
        $especialidad = null;

        if ($request->has('doctor_id')) {
            $doctor = Doctores::find($request->doctor_id);
            if ($doctor) {
                $especialidad = $doctor->especialidad_medica;
            }
        }

        return view('Expedientes.Create', compact('paciente', 'doctores'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar_a_cargo' => 'nullable|string',
            'numero_familiar' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
            'hora_proxima_cita' => 'nullable|date_format:H:i',
            'fecha_registro' => 'required|date',
        ]);

        $validatedData['fecha_registro'] = Carbon::parse($validatedData['fecha_registro'])->format('Y-m-d');

        // Asegúrate de que el paciente_id se esté pasando
        $validatedData['paciente_id'] = $request->paciente_id; // Asegúrate de que este campo esté presente

        Expediente::create($validatedData);

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Expediente creado con éxito.');
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
            'doctor_id' => 'required|exists:doctores,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar_a_cargo' => 'nullable|string|max:255',
            'numero_familiar' => 'nullable|string|max:20',
            'proxima_cita' => 'nullable|date',
            'hora_proxima_cita' => 'nullable|date_format:H:i',
        ]);

        $expediente = Expediente::findOrFail($id);

        $expediente->update($validatedData);

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Expediente actualizado con éxito.');
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);
        $expediente->delete();

        return redirect()->route('Expedientes.index')->with('success', 'Expediente eliminado con éxito.');
    }

    public function getCitas()
    {
        $citas = Expediente::with(['paciente', 'doctor'])
            ->whereNotNull('proxima_cita')
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
