<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\SecretariasController;
use App\Http\Controllers\Auth\CustomRegisterController;

//Redireccion para usuarios sin rol
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/check-role', function () {
        if (Auth::user()->roles->isNotEmpty()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('welcome');
    })->name('welcome');

    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pacientes', [ClinicaController::class, 'PacientesView'])
        ->name('clinica.pacientes')
        ->middleware('check.role');
});

//Rutas para usuarios
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contactenos', function () {
    return view('contactenos');
});
//Fin





//Rutas para secretaria
Route::middleware(['auth', 'role:Secretaria'])->group(function () {
    Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');
    Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
    Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');
    Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');
    Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('Pacientes.edit');
    Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('Pacientes.destroy');
    Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes');
    Route::get(uri: '/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes.index');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes.index');
    Route::get('/Expedientes/create', [ExpedientesController::class, 'create'])->name('Expedientes.create');
    Route::post('/Expedientes/create', [ExpedientesController::class, 'store'])->name('Expedientes.store');
    Route::get('/Expediente/{id}/edit', [ExpedientesController::class, 'edit'])->name('Expedientes.edit');
    Route::delete('/Expedientes/{id}', [ExpedientesController::class, 'destroy'])->name('Expedientes.destroy');
    Route::put('/Expedientes/{id}', [ExpedientesController::class, 'update'])->name('Expedientes.update');
});
//fin de las rutas de secretaria

//Rutas de Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('ingresos', IngresoController::class);
    Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
    Route::get('/Pacientes/create', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
    Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');
    Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');
    Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('Pacientes.edit');
    Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('Pacientes.destroy');
    Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');
    Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes');
    Route::get(uri: '/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes.index');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes.index');
    Route::get('/Expedientes/create', [ExpedientesController::class, 'create'])->name('Expedientes.create');
    Route::post('/Expedientes/create', [ExpedientesController::class, 'store'])->name('Expedientes.store');
    Route::get('/Expediente/{id}/edit', [ExpedientesController::class, 'edit'])->name('Expedientes.edit');
    Route::delete('/Expedientes/{id}', [ExpedientesController::class, 'destroy'])->name('Expedientes.destroy');
    Route::put('/Expedientes/{id}', [ExpedientesController::class, 'update'])->name('Expedientes.update');
    Route::get('/doctores/create', [DoctoresController::class, 'create'])->name('doctores.create');
    Route::post('/doctores', [DoctoresController::class, 'store'])->name('doctores.store');
    Route::get('/doctores/{id}/edit', [DoctoresController::class, 'edit'])->name('doctores.edit');
    Route::put('/doctores/{id}', [DoctoresController::class, 'update'])->name('doctores.update');
    Route::delete('/doctores/{id}', [DoctoresController::class, 'destroy'])->name('doctores.destroy');
});
//fin de las rutas de admin


//Rutas De Doctor
Route::middleware(['auth', 'role:Doctor'])->group(function () {
    Route::resource('ingresos', IngresoController::class);
    Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');
    Route::get('ingresos', [IngresoController::class, 'index'])->name('ingresos.index');
});
//fin de las rutas del doctor




//Middleware para permisos
Route::group(['middleware' => ['auth', 'permission:ver pacientes']], function () {
    Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');
    Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
    Route::get('/Pacientes/create', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
    Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');
    Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');
    Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('Pacientes.edit');
    Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('Pacientes.destroy');
    Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');
});

Route::group(['middleware' => ['auth', 'permission:ver dashboard']], function () {
    return view('dashboard');
});
Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');

Route::group(['middleware' => ['auth', 'permission:ver expedientes']], function () {
    Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes.index');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes');
    Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes.index');
    Route::get('/Expedientes/create', [ExpedientesController::class, 'create'])->name('Expedientes.create');
    Route::post('/Expedientes/create', [ExpedientesController::class, 'store'])->name('Expedientes.store');
    Route::get('/Expediente/{id}/edit', [ExpedientesController::class, 'edit'])->name('Expedientes.edit');
    Route::delete('/Expedientes/{id}', [ExpedientesController::class, 'destroy'])->name('Expedientes.destroy');
    Route::put('/Expedientes/{id}', [ExpedientesController::class, 'update'])->name('Expedientes.update');
});
Route::resource('consultas', ConsultaController::class);


Route::group(['middleware' => ['auth', 'permission:ver ingresos']], function () {
    Route::resource('ingresos', IngresoController::class);
});
Route::group(['middleware' => ['auth', 'permission:ver empresas']], function () {
    Route::resource('empresas', EmpresaController::class);
    Route::get('/buscar-usuarios', [EmpresaController::class, 'buscarUsuarios']);
});

Route::group(['middleware' => ['auth', 'permission: ver doctores']], function () {
    Route::resource('doctores', DoctoresController::class);
});

Route::group(['middleware' => ['auth', 'permission:ver roles']], function () {
    Route::resource('roles', RoleController::class);
    //Route::get('roles/assignate', [RoleController::class, 'assignRole'])->name('role.assignate');
    Route::get('/roles/assign/{user}', [RoleController::class, 'assignRole'])->name('roles.assign');
    Route::post('/roles/assign/{user}', [RoleController::class, 'storeAssignedRole'])
        ->name('users.assign.role');
});


Route::group(['middleware' => ['auth', 'permission:ver doctores']], function () {
    Route::resource('doctores', DoctoresController::class);
});


Route::get('/expedientes/citas', [ExpedientesController::class, 'getCitas']);

Route::resource('secretarias', SecretariasController::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/secretaria/dashboard', [SecretariasController::class, 'das hboard'])
        ->name('secretaria.dashboard');

    Route::get('/dashboard', [CitaController::class, 'index'])->name('dashboard');

    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
});
Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

Route::get('/citas/{id}', [CitaController::class, 'show']);
