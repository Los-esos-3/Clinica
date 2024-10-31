<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DoctoresController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $doctores = Doctores::when($search, function ($query) use ($search) {
            return $query->where('nombre_completo', 'like', '%' . $search . '%');
        })->get();
    
        return view('doctores.index', compact('doctores'));
    }

    public function create()
    {
        return view('doctores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:doctores',
            'domicilio' => 'required|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'especialidad_medica' => 'required|string',
            'universidad' => 'required|string',
            'titulo' => 'required|string',
            'año_graduacion' => 'required|digits:4',
            'años_experiencia' => 'required|integer',
            'hospitales_previos' => 'nullable|string',
            'idiomas' => 'required|string',
            'contacto_emergencia_nombre' => 'required|string',
            'contacto_emergencia_relacion' => 'required|string',
            'contacto_emergencia_telefono' => 'required|string',
            'area_departamento' => 'required|string'
        ]);

        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validated['foto_perfil'] = $nombreImagen;
        }

        Doctores::create($validated);

        return redirect()->route('doctores.index')
            ->with('success', 'Doctor registrado exitosamente.');
    }

    public function edit(Doctores $doctor)
    {
        return view('doctores.edit', compact('doctor'));
    }

    public function update(Request $request, Doctores $doctor)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:doctores,email,' . $doctor->id,
            'domicilio' => 'required|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'especialidad_medica' => 'required|string',
            'universidad' => 'required|string',
            'titulo' => 'required|string',
            'año_graduacion' => 'required|digits:4',
            'años_experiencia' => 'required|integer',
            'hospitales_previos' => 'nullable|string',
            'idiomas' => 'required|string',
            'contacto_emergencia_nombre' => 'required|string',
            'contacto_emergencia_relacion' => 'required|string',
            'contacto_emergencia_telefono' => 'required|string',
            'area_departamento' => 'required|string'
        ]);

        if ($request->hasFile('foto_perfil')) {
            // Eliminar foto anterior si existe
            if ($doctor->foto_perfil) {
                Storage::disk('public')->delete($doctor->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('doctores', 'public');
            $validated['foto_perfil'] = $path;
        }

        $doctor->update($validated);

        return redirect()->route('doctores.index')
            ->with('success', 'Información del doctor actualizada exitosamente.');
    }

    public function destroy(Doctores $doctor)
    {
        try {
            // Primero verificamos que el doctor existe
            if (!$doctor) {
                return redirect()->route('doctores.index')
                    ->with('error', 'Doctor no encontrado.');
            }

            // Eliminamos la foto si existe
            if ($doctor->foto_perfil) {
                Storage::disk('public')->delete($doctor->foto_perfil);
            }
            
            // Eliminamos el doctor
            if ($doctor->delete()) {
                return redirect()->route('doctores.index')
                    ->with('success', 'Doctor eliminado exitosamente.');
            }
            
            return redirect()->route('doctores.index')
                ->with('error', 'No se pudo eliminar el doctor.');
                
        } catch (\Exception $e) {
            \Log::error('Error al eliminar doctor: ' . $e->getMessage());
            return redirect()->route('doctores.index')
                ->with('error', 'Error al eliminar el doctor: ' . $e->getMessage());
        }
    }
}