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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/check-role', function () {
        if (Auth::user()->roles->isNotEmpty()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('welcome');
    })->name('check.role');

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

Route::get('/Farmacia', function () {
    return view('Farmacia');
})->name('Farmacia');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**  */

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes/create', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes');

Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');

Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');

Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('Pacientes.edit');

Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('Pacientes.destroy');

Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');


 
Route::resource('Expedientes', controller: IngresoController::class);

Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes');

Route::get(uri: '/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes.index');

Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes');

Route::get('/Expedientes', action: [ExpedientesController::class, 'index'])->name('Expedientes.index');


    


Route::get('/Expedientes/create', [ExpedientesController::class, 'create'])->name('Expedientes.create');

Route::post('/Expedientes/create', [ExpedientesController::class, 'store'])->name('Expedientes.store');

Route::get('/Expediente/{id}/edit', [ExpedientesController::class, 'edit'])->name('Expedientes.edit');

Route::delete('/Expedientes/{id}', [ExpedientesController::class, 'destroy'])->name('Expedientes.destroy');

Route::put('/Expedientes/{id}', [ExpedientesController::class, 'update'])->name('Expedientes.update');



Route::get('/ExpedientesAdmin',action: [ExpedientesController::class,'admin'])->name('Expedientes.admin');


Route::get('/get-citas', [ExpedientesController::class, 'getCitas']);

Route::get('/contactenos', function () {
    return view('contactenos'); 
});


Route::resource('ingresos', IngresoController::class);
Route::get('ingresos', [IngresoController::class , 'index'])->name('ingresos.index');




Route::get('/roles', [RoleController::class, 'index'])->middleware(['auth', 'role:Admin']);

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
});

Route::put('/users/{user}/assign-role', [RoleController::class, 'assignRole'])->name('users.assign.role');

Route::resource('users', UserController::class);
