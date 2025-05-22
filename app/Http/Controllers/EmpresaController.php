<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EmpresaController
{
    public function index()
    {
        $user = Auth::user();
        $empresa = null;

        // Verifica si el usuario tiene una empresa asociada
        if ($user->empresa_id) {
            // Si tiene, obtiene la empresa
            $empresa = Empresa::find($user->empresa_id);
        }

        return view('empresas.index', compact('empresa'));
    }

    public function create()
    {
        return view('empresas.create');
    }



    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        // Obtener todos los usuarios para mostrarlos en el formulario
        $usuarios = User::all();

        return view('empresas.edit', compact('empresa', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:empresas',
            'direccion' => 'required',
            'pais' => 'required|string|max:255',
            'estado'=>'required|string|max:255',
            'ciudad' => 'required|string|max:255',   
            'horario' => 'required | String',
            'descripcion' => 'required',

        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['logo'] = $filename;
        }

        // Crear la empresa
        $empresa = Empresa::create($data);

        // Asociar al usuario que crea la empresa
        $empresa->users()->save(Auth::user());

        // Si hay usuarios relacionados, asignarles el empresa_id
        if ($request->has('usuarios')) {
            foreach ($request->usuarios as $usuarioId) {
                $user = User::find($usuarioId);
                $user->empresa_id = $empresa->id; // Asignar el empresa_id
                $user->save(); // Guardar el usuario
            }
        }

        return redirect()->route('empresas.index')
        ->with('empresa_guardada', true); // <- Esta clave la usaremos en la vista para mostrar el modal
    
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:empresas,email,' . $id,
            'direccion' => 'required',
            'pais' => 'required|string|max:255',
            'estado'=>'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'horario' => 'required',
            'descripcion' => 'required',
        ]);

        $empresa = Empresa::findOrFail($id);
        $data = $request->all();


        if ($request->hasFile('logo')) {
            if ($empresa->logo) {
                Storage::disk('public')->delete($empresa->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['logo'] = $filename;
        }

        // Actualizar la empresa
        $empresa->update($data);

        Log::info('Actualizo la empresa');

        // Procesar usuarios seleccionados
        if ($request->has('usuarios')) {
            // Desasociar usuarios que ya no están en la lista
            User::where('empresa_id', $empresa->id)
                ->whereNotIn('id', $request->usuarios)
                ->update(['empresa_id' => null]);

            // Asociar usuarios seleccionados
            foreach ($request->usuarios as $usuarioId) {
                $user = User::find($usuarioId);
                if ($user) {
                    $user->empresa_id = $empresa->id;
                    $user->save();
                }
            }
        }

        Log::info('Asocio el user con la empresa');

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada correctamente.');
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
