<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\ExpedienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**  */
Route::get('/dashboard', [ClinicaController::class, 'index'])->name('dashboard');

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes/create', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes');

Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');

Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');

Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('pacientes.edit');

Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('pacientes.destroy');

Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');






Route::get(uri: '/Expedientes', action: [ExpedientesController::class, 'index'])->name(name: 'Expedientes.index');

Route::get('/Expedientes', [ExpedientesController::class, 'index'])->name('Expedientes');

Route::get('/Expedientes', [ExpedientesController::class, 'index'])->name('Expedientes.index');

Route::get('/Expedientes', [ExpedientesController::class, 'index'])->name('Expedientes');



Route::get('/Expedientes/create', [ExpedientesController::class, 'create'])->name('Expedientes.create');

Route::post('/Expedientes/create', [ExpedientesController::class, 'store'])->name('Expedientes.store');

Route::get('/Expediente/{id}/edit', [ExpedientesController::class, 'edit'])->name('Expedientes.edit');

Route::delete('/Expedientes/{id}', [ExpedientesController::class, 'destroy'])->name('Expedientes.destroy');

Route::put('/Expedientes/{id}', [ExpedientesController::class, 'update'])->name('Expedientes.update');






Route::get('/get-citas', [ExpedientesController::class, 'getCitas']);


Route::get('/contactenos', function () {
    return view('contactenos'); 
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
