<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Http\Requests; // Asegúrate de importar las solicitudes necesarias
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importa el trait

class RoleController extends Controller
{
    use AuthorizesRequests; // Usa el trait

    public function index()
    {
         // Verifica el permiso
        $roles = Role::all();
        $users = User::all(); // Obtén todos los usuarios
        $permissions = Permission::all(); //Obtener los permisos
        return view('roles.index', compact('roles', 'users', 'permissions')); // Pasa ambas variables a la vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array' // Asegúrate de que los permisos sean un array
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions); // Asigna los permisos

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array'
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('roles.index')->with('success', 'Roles asignados exitosamente.');
    }

    public function create()
    {
        $permissions = Permission::all(); // Obtén todos los permisos
        return view('roles.create', compact('permissions')); // Pasa la variable a la vista
    }
}
