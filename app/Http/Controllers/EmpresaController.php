<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first(); // Cambiamos de all() a first()
        return view('empresas.index', compact('empresa'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:empresas',
            'direccion' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
            'horario' => 'required',
            'descripcion' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['logo'] = $filename;
        }

        Empresa::create($data);

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa registrada exitosamente.');
    }

    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'direccion' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
            'horario' => 'required',
            'descripcion' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($empresa->logo) {
                Storage::disk('public')->delete($empresa->logo);
            }
            
            $logo = $request->file('logo');
            $nombreLogo = time() . '_' . $logo->getClientOriginalName();
            $path = $logo->storeAs('logos', $nombreLogo, 'public');
            $empresa->logo = $path;
        }

        $empresa->update($request->except('logo'));

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Empresa $empresa)
    {
        if ($empresa->logo) {
            Storage::disk('public')->delete($empresa->logo);
        }
        
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa eliminada exitosamente.');
    }
}
