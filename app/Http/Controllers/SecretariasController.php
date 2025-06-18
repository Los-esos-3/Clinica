<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SecretariasController 
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtener todas las secretarias si no hay usuario autenticado
        $query = Secretarias::query();

        // Verificar si el usuario autenticado tiene una empresa asignada
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresaId = Auth::user()->empresa_id;

            // Filtrar doctores solo si el usuario tiene una empresa
            $query->whereHas('user', function ($q) use ($empresaId) {
                $q->where('empresa_id', $empresaId);
            });
        } else {
            // Si el usuario no tiene empresa, no mostrar ningún doctor
            $query->whereRaw('1 = 0'); // Esto asegura que no se devuelvan resultados
        }

        // Aplicar búsqueda si existe
        if ($search) {
            $query->where('nombre_completo', 'like', '%' . $search . '%');
        }

        $secretarias = $query->get();

        return view('secretarias.index', compact('secretarias'));
    }

    public function create()
    {
        // Si el usuario está autenticado y tiene empresa_id, mostrar solo esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresas = Empresa::where('id', Auth::user()->empresa_id)->get();
        } else {
            // Si no, mostrar todas las empresas
            $empresas = Empresa::all();
        }

        return view('secretarias.create', compact('empresas'));
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'departamento' => 'nullable|string',
            'experiencia_laboral' => 'nullable|string',
            'contacto_emergencia_nombre' => 'nullable|string',
            'contacto_emergencia_relacion' => 'nullable|string',
            'contacto_emergencia_telefono' => 'nullable|string',
            'idiomas' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
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
        $secretaria = Secretarias::findOrFail($id);
        // Si el usuario está autenticado y tiene empresa_id, mostrar solo esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresas = Empresa::where('id', Auth::user()->empresa_id)->get();
        } else {
            // Si no, mostrar todas las empresas
            $empresas = Empresa::all();
        }
        return view('secretarias.edit', compact('secretaria', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $secretaria = Secretarias::findOrFail($id);
        $validated = $request->validate([
             'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'required|string',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'departamento' => 'nullable|string',
            'experiencia_laboral' => 'nullable|string',
            'contacto_emergencia_nombre' => 'nullable|string',
            'contacto_emergencia_relacion' => 'nullable|string',
            'contacto_emergencia_telefono' => 'nullable|string',
            'idiomas' => 'nullable|string',
        ]);

         $validated['empresa_id'] = Auth::user()->empresa_id;

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

    public function dashboard()
    {
        try {
            $doctores = \App\Models\Doctores::all();
            $pacientes = \App\Models\Paciente::all();

            return view('Secretaria.Dashboard', [
                'doctores' => $doctores,
                'pacientes' => $pacientes
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error en dashboard: ' . $e->getMessage());
            return view('Secretaria.Dashboard', [
                'doctores' => collect([]),
                'pacientes' => collect([])
            ])->with('error', 'Error al cargar los datos');
        }
    }
}
