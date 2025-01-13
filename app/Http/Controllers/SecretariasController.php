<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecretariasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $secretarias = Secretarias::when($search, function ($query) use ($search) {
            return $query->where('nombre_completo', 'like', '%' . $search . '%');
        })->get();
    
        return view('secretarias.index', compact('secretarias'));
    }

    public function create()
    {
        return view('secretarias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:secretarias',
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'año_contratacion' => 'nullable|digits:4',
            'años_experiencia' => 'nullable|integer',
            'departamento' => 'nullable|string'
        ]);

        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validated['foto_perfil'] = $nombreImagen;
        }

        Secretarias::create($validated);

        return redirect()->route('secretarias.index')
            ->with('success', 'Secretaria registrada exitosamente.');
    }

    public function edit($id)
    {
        $secretaria = Secretarias::find($id);
        if (!$secretaria) {
            return redirect()->route('secretarias.index')->with('error', 'Secretaria no encontrada.');
        }
        return view('secretarias.edit', compact('secretaria'));
    }

    public function update(Request $request, $id)
    {
        $secretaria = Secretarias::findOrFail($id);
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:secretarias,email,' . $secretaria->id,
            'domicilio' => 'required|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'año_contratacion' => 'required|digits:4',
            'años_experiencia' => 'required|integer',
            'departamento' => 'nullable|string'
        ]);

        if ($request->hasFile('foto_perfil')) {
            // Eliminar foto anterior si existe
            if ($secretaria->foto_perfil) {
                Storage::disk('public')->delete($secretaria->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('secretarias', 'public');
            $validated['foto_perfil'] = $path;
        }

        $secretaria->update($validated);

        return redirect()->route('secretarias.index')
            ->with('success', 'Información de la secretaria actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $secretaria = Secretarias::findOrFail($id);
        $secretaria->delete();
    
        return redirect()->route('secretarias.index')->with('success', 'Secretaria eliminada correctamente.');
    }
}
