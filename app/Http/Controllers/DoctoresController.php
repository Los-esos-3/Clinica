<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class DoctoresController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Obtener todos los doctores si no hay usuario autenticado
        $query = Doctores::query();
        
        // Si hay un usuario autenticado y tiene empresa_id, filtrar por esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresa_id = Auth::user()->empresa_id;
            $query->where('empresa_id', $empresa_id);
        }
        
        // Aplicar búsqueda si existe
        if ($search) {
            $query->where('nombre_completo', 'like', '%' . $search . '%');
        }
        
        $doctores = $query->get();
        
        return view('doctores.index', compact('doctores'));
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
        
        return view('doctores.create', compact('empresas'));
    }

    public function store(Request $request)
{
    //dd($request->all());
    $validated = $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|in:Masculino,Femenino,Otro',
        'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'telefono' => 'nullable|string|max:15',
        'email' => 'nullable|email|unique:doctores',
        'domicilio' => 'nullable|string',
        'nacionalidad' => 'required|string',
        'especialidad_medica' => 'required|string',
        'universidad' => 'nullable|string',
        'titulo' => 'nullable|string',
        'año_graduacion' => 'nullable|integer',
        'años_experiencia' => 'nullable|integer',
        'contacto_emergencia_nombre' => 'nullable|string',
        'contacto_emergencia_relacion' => 'nullable|string',
        'contacto_emergencia_telefono' => 'nullable|string',
        'area_departamento' => 'nullable|string',
        'empresa_id' => 'required|exists:empresas,id',
    ]);


    if ($request->hasFile('foto_perfil')) {
        $imagen = $request->file('foto_perfil');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('images'), $nombreImagen);
        $validated['foto_perfil'] = $nombreImagen; // Asegúrate de que esta línea esté aquí
    }

    Doctores::create($validated); // Usa la variable $validated aquí

    return redirect()->route('doctores.index')
        ->with('success', 'Doctor registrado exitosamente.');
}

    public function edit($id)
    {
        $doctor = Doctores::findOrFail($id);
        // Si el usuario está autenticado y tiene empresa_id, mostrar solo esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresas = Empresa::where('id', Auth::user()->empresa_id)->get();
        } else {
            // Si no, mostrar todas las empresas
            $empresas = Empresa::all();
        }
        return view('doctores.edit', compact('doctor', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctores::findOrFail($id);
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:doctores',
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'required|string',
            'especialidad_medica' => 'required|string',
            'universidad' => 'nullable|string',
            'titulo' => 'nullable|string',
            'año_graduacion' => 'nullable|integer',
            'años_experiencia' => 'nullable|integer',
            'contacto_emergencia_nombre' => 'nullable|string',
            'contacto_emergencia_relacion' => 'nullable|string',
            'contacto_emergencia_telefono' => 'nullable|string',
            'area_departamento' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
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

    public function destroy($id)
    {
        $doctor = Doctores::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado correctamente');
    }
}
