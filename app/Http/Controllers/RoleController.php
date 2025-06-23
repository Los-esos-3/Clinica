<?php

namespace App\Http\Controllers;

use App\Mail\RecordatorioDeDias;
use App\Models\Pago;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Doctores;
use Illuminate\Support\Facades\Auth;
use App\Models\Secretarias;
use Illuminate\Support\Facades\DB;

class RoleController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('ver roles');
        $empresas = Empresa::all();


        $users = User::where('registration_source', 'web')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Admin');
            })
            ->with('pagos')
            ->paginate(10);



        $totalPagos = Pago::whereIn('user_id', $users->pluck('id'))
            ->sum('precio');

        return view('roles.index', compact('users', 'empresas', 'totalPagos'));
    }

    public function RecordatorioCorreo($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);


        $expirationDate = $user->plan_expires_at;


        $now = now();
        $totalSeconds = 0;

        \Carbon\Carbon::setLocale('es');

        if ($user->trial_ends_at) {
            $totalSeconds += $now->diffInSeconds($user->trial_ends_at, false);
        }

        if ($user->plan_expires_at) {
            $totalSeconds += $now->diffInSeconds($user->plan_expires_at, false);
        }

        $totalTime = CarbonInterval::seconds(abs($totalSeconds))
            ->cascade()
            ->forHumans(['parts' => 4]);

        // Nombre del plan (puedes obtenerlo según tu lógica)
        $planName = $user->selected_plan ?? 'Plan Básico';

        $pricePlan = $user->plan_price;

        // Datos para el correo
        $data = [
            'user' => $user,
            'planName' => $planName,
            'price_plan' => $pricePlan,
            'expirationDate' => $expirationDate,
            'remainingDays' => $totalTime,
        ];

        // Enviar el correo
        Mail::to($user->email)->send(new RecordatorioDeDias($data));

        return redirect()->route('dashboardRoot')->with('success', 'Se a enviado correctamente el correo.');
    }

    public function confirmarPago($userId)
    {
        // Obtener el usuario desde la base de datos
        $user = User::find($userId);

        // Verificar si el usuario existe
        if (!$user) {
            Log::warning('No se encontró ningún usuario con el ID: ' . $userId);
            return redirect()->back()->with('error', 'El usuario no existe.');
        }

        // Buscar el último pago pendiente del usuario
        $pago = Pago::where('user_id', $user->id)
            ->where('estado', 'espera') // Asegúrate de que el pago esté pendiente
            ->latest() // Obtener el pago más reciente
            ->first();

        // Verificar si existe un pago pendiente
        if (!$pago) {
            Log::warning('No se encontró ningún pago pendiente para el usuario ID: ' . $user->id);
            return redirect()->back()->with('error', 'No se encontró ningún pago pendiente.');
        }

        try {
            // Determinar los días del plan seleccionado
            $planDays = 0;

            if ($user->selected_plan === 'basico') {
                $planDays = 30;
            } elseif ($user->selected_plan === 'popular') {
                $planDays = 183;
            } elseif ($user->selected_plan === 'premium') {
                $planDays = 365;
            }

            // Verificar si el plan seleccionado es válido
            if ($planDays === 0) {
                return redirect()->back()->with('error', 'El plan seleccionado no es válido.');
            }

            // Actualizar el estado del pago a "pagada"
            $pago->update(['estado' => 'pagada']);
            Log::info('Estado del pago actualizado a "pagada"');

            // Calcular la nueva fecha de expiración del plan
            $nuevaFechaExpiracion = now()->addDays($planDays);

            // Actualizar la fecha de expiración del plan del usuario
            $user->update([
                'plan_expires_at' => $nuevaFechaExpiracion,
            ]);

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'Pago confirmado exitosamente. El plan ha sido activado.');
        } catch (\Exception $e) {
            Log::error('Error al procesar el pago: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al procesar el pago.');
        }
    }

    public function RolesIndex()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('roles.roles', compact('roles', 'permissions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('name', $request->permissions)->pluck('id')->toArray();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function assignRole(Request $request, User $user)
    {
        $roles = Role::all();
        $empresas = Empresa::all();
        return view('roles.assign', compact('roles', 'empresas', 'user'));
    }

    public function storeAssignedRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findById($request->role_id); // Busca el rol con Spatie

        if (!$role) {
            return redirect()->back()->with('error', 'Rol no encontrado.');
        }

        // Asignar el nuevo rol, eliminando los anteriores
        $user->syncRoles([$role->name]);

        // Si el rol asignado es "Doctor", crear el registro en la tabla doctores
        if ($role->name === 'Doctor') {
            $this->asignarRolDoctor($userId);
        }

        if ($role->name == 'Secretaria') {
            $this->asignarRolSecretaria($userId);
        }

        return redirect()->route('roles.index')->with('success', 'Rol asignado correctamente.');
    }

    protected function asignarRolDoctor($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener el empresa_id del usuario autenticado (admin que asigna el rol)
        $empresaId = Auth::user()->empresa_id;

        // Verificar si ya existe un registro en la tabla doctores para este usuario
        $doctorExistente = Doctores::where('user_id', $user->id)->first();

        if (!$doctorExistente) {
            // Crear un registro en la tabla doctores
            Doctores::create([
                'user_id' => $user->id,
                'nombre_completo' => $user->name,
                'email' => $user->email,
                'empresa_id' => $empresaId, // Asignar el empresa_id del admin
            ]);
        }
    }
    protected function asignarRolSecretaria($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener el empresa_id del usuario autenticado (admin que asigna el rol)
        $empresaId = Auth::user()->empresa_id;

        // Verificar si ya existe un registro en la tabla doctores para este usuario
        $secretariaExistente = Secretarias::where('user_id', $user->id)->first();

        if (!$secretariaExistente) {
            // Crear un registro en la tabla doctores
            Secretarias::create(attributes: [
                'user_id' => $user->id,
                'nombre_completo' => $user->name,
                'email' => $user->email,
                'empresa_id' => $empresaId,
            ]);
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $empresas = Empresa::all();
        return view('roles.edit', compact('permissions', 'empresas', 'role'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $empresas = Empresa::all();
        return view('roles.create', compact('permissions', 'empresas'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.show', compact('role', 'permissions'));
    }
}
