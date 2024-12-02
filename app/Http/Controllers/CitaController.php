<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Método para mostrar todas las citas
    public function index()
    {
        $citas = Cita::all(); // Obtiene todas las citas
        return response()->json($citas); // Devuelve las citas en formato JSON
    }

    // Método para crear una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        ]);

        $cita = Cita::create($request->all()); // Crea una nueva cita
        return response()->json($cita, 201); // Devuelve la cita creada
    }

    // Método para mostrar una cita específica
    public function show($id)
    {
        $cita = Cita::findOrFail($id); // Encuentra la cita por ID
        return response()->json($cita); // Devuelve la cita
    }

    // Método para actualizar una cita
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        ]);

        $cita = Cita::findOrFail($id); // Encuentra la cita por ID
        $cita->update($request->all()); // Actualiza la cita
        return response()->json($cita); // Devuelve la cita actualizada
    }

    // Método para eliminar una cita
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id); // Encuentra la cita por ID
        $cita->delete(); // Elimina la cita
        return response()->json(null, 204); // Devuelve un estado 204 No Content
    }
}