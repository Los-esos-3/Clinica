<?php

use App\Http\Controllers\ClinicaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ClinicaController::class, 'index'])->name('dashboard');

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes/create', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');

Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes');

Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');

Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');

Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('pacientes.edit');

Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('pacientes.destroy');

Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');














Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
