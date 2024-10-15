<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngresoController extends Controller
{
    // Mostrar todos los ingresos
    public function index()
    {
        // Obtenemos los ingresos por departamento
        $ingresos = Ingreso::select('departamento', 'paciente_id', DB::raw('SUM(total) as total'))
                            ->groupBy('departamento', 'paciente_id')
                            ->get();

        $pacientesPorDepartamento = Ingreso::select('departamento', DB::raw('COUNT(DISTINCT paciente_id) as numero_pacientes'))
            ->groupBy('departamento')
            ->get();

        // Convertimos los datos para la gráfica
        $departamentos = $ingresos->pluck('departamento');
        $totales = $ingresos->pluck('total');

        return view('ingresos.index', compact('departamentos', 'totales', 'ingresos', 'pacientesPorDepartamento'));
    }

    // Mostrar formulario para crear un nuevo ingreso
    public function create()
    {
        $pacientes = Paciente::all(); // Obtener todos los pacientes para la lista
        return view('ingresos.create', compact('pacientes'));
    }

    // Guardar un nuevo ingreso
    public function store(Request $request)
    {
        try {
            $request->validate([
                'departamento' => 'required|string|max:255',
                'paciente_id' => 'required|numeric',
                'total' => 'required|numeric|min:0',
            ]);

            Ingreso::create([
                'departamento' => $request->departamento,
                'paciente_id' => $request->paciente_id,
                'total' => $request->total,
            ]);

            // Redirigir a index con mensaje de éxito
            return redirect()->route('ingresos.index')->with('success', 'Ingreso creado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrió un error inesperado: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Ingreso $ingreso)
    {
        return view('ingresos.show', compact('ingreso'));
    }

    // Formulario para editar un ingreso
    public function edit(Ingreso $ingreso)
    {
        $pacientes = Paciente::all(); // Obtener todos los pacientes para la lista
        return view('ingresos.edit', compact('ingreso', 'pacientes'));
    }

    // Actualizar un ingreso
    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'departamento' => 'required|string|max:255',
            'paciente_id' => 'required|numeric',
            'total' => 'required|numeric|min:0',
        ]);

        $ingreso->update($request->all());

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado correctamente.');
    }

    // Eliminar un ingreso
    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();

        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado correctamente.');
    }

    // Método para obtener citas (si es necesario)
    public function getCitas()
    {
        // Aquí iría la lógica relacionada con las citas si es necesario
    }
}