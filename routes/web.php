<?php

use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\SecretariasDoctorController;
use App\Http\Controllers\TrabajadoresController;
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
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\VerificacionController;

//Rutas para usuarios
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contactenos', function () {
    return view('contactenos');
});
//Fin

Route::get('/plans', function () {
    return view('plans.index'); // Asegúrate de tener esta vista
})->name('plans');





Route::middleware(['auth', 'trial'])->group(function () {



    // Grupo de rutas autenticadas
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        // Redirección para usuarios sin rol
        Route::get('/check-role', function () {
            if (Auth::user()->hasRole('Root')) {
                return redirect()->route('dashboardAdmin');
            }
            // }elseif(Auth::user()->hasRole('Root'))
            // {
            //     return redirect()->route('roles');

            // }

            return redirect()->route('welcome');
        })->name('check-role');

        // Definición PRINCIPAL del dashboard
        Route::get('/dashboard', [CitaController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['auth', 'role:Root'])->group(function () {
        route::get('dashboardAdmin', [RoleController::class, 'index'])->name('dashboardAdmin');


        Route::group(['middleware' => ['auth', 'permission:ver roles']], function () {
            Route::resource('roles', RoleController::class);
            Route::get('/roles/assign/{user}', [RoleController::class, 'assignRole'])->name('roles.assign');
            Route::post('/roles/assign/{user}', [RoleController::class, 'storeAssignedRole'])
                ->name('users.assign.role');
        });
    });

    //Rutas para secretaria
    Route::middleware(['auth', 'role:Secretaria'])->group(function () {
        Route::get('/Expedientes', [ExpedientesController::class, 'admin'])->name('Expedientes.admin');
        Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.3');
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

        Route::post('/subscribe', [MercadoPagoController::class, 'createSubscription'])->name('subscribe');
        Route::get('/subscription/success', [MercadoPagoController::class, 'success'])->name('subscription.success');
        Route::get('/subscription/failure', [MercadoPagoController::class, 'failure'])->name('subscription.failure');
        Route::get('/subscription/pending', [MercadoPagoController::class, 'pending'])->name('subscription.pending');
        Route::post('/mercadopago/notification', [MercadoPagoController::class, 'handleNotification'])->name('mp.notification');

        Route::get('/Trabajadores', [TrabajadoresController::class, 'index'])->name("Trabajadores.index");
        Route::get('/Trabajadores/create', [TrabajadoresController::class, 'create'])->name('Trabajadores.create');
        Route::post('/Trabajadores/create', [TrabajadoresController::class, 'store'])->name('Trabajadores.store');
        Route::get('/Trabajadores/{id}/edit', [TrabajadoresController::class, 'edit'])->name('Trabajadores.edit');
        Route::delete('/Trabajadores/{id}', [TrabajadoresController::class, 'destroy'])->name('Trabajadores.destroy');
        Route::put('/Trabajadores/{id}', [TrabajadoresController::class, 'update'])->name('Trabajadores.update');
        Route::resource('ingresos', IngresoController::class);
        Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
        Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
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

    Route::middleware(["auth", 'permission:editar doctores'])->group(function () {
        Route::get('/doctores/{id}/edit', [DoctoresController::class, 'edit'])->name('doctores.edit');
        Route::put('/doctores/{id}', [DoctoresController::class, 'update'])->name('doctores.update');
        Route::delete('/doctores/{id}', [DoctoresController::class, 'destroy'])->name('doctores.destroy');
    });


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
        Route::get('/Pacientes', [ClinicaController::class, 'PacientesView'])->name('Pacientes.PacientesView');
        Route::get('/pacientes/create', [ClinicaController::class, 'create'])->name('Pacientes.create');
        Route::post('/pacientes/create', [ClinicaController::class, 'store'])->name('Pacientes.store');
        Route::get('/pacientes/{id}/edit', [ClinicaController::class, 'edit'])->name('Pacientes.edit');
        Route::delete('/pacientes/{id}', [ClinicaController::class, 'destroy'])->name('Pacientes.destroy');
        Route::put('/pacientes/{id}', [ClinicaController::class, 'update'])->name('Pacientes.update');
    });

    Route::group(['middleware' => ['auth', 'permission:ver dashboard']], function () {
        return view('dashboard');
    });

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
    });

    Route::group(['middleware' => ['auth', 'permission: ver doctores']], function () {
        Route::resource('doctores', DoctoresController::class);
    });


    Route::middleware(['auth', 'role:Doctor'])->group(function () {
        Route::get('/doctor/secretarias', [SecretariasDoctorController::class, 'index'])->name('Doctor.Secretaria');
        Route::post('/doctor/secretarias/asignar', [SecretariasDoctorController::class, 'asignarSecretaria'])->name('Doctor.Secretaria.Asignar');
        Route::delete('/doctor/secretarias/desasignar/{id}', [SecretariasDoctorController::class, 'desasignarSecretaria'])->name('Doctor.Secretaria.Desasignar');
    });

    Route::group(['middleware' => ['auth', 'permission:ver doctores']], function () {
        Route::resource('doctores', DoctoresController::class);
    });


    Route::get('/expedientes/citas', [ExpedientesController::class, 'getCitas']);

    Route::resource('secretarias', SecretariasController::class);


    Route::get('/secretaria/dashboard', [SecretariasController::class, 'dashboard']);

    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');


    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

    Route::get('/citas/{id}', [CitaController::class, 'show']);
});




Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register'])->name('register.submit');
Route::get('/verificar-email', [CustomRegisterController::class, 'verifyForm'])->name('verificar.email.view');
Route::post('/verificar-email', [CustomRegisterController::class, 'verifyCode'])->name('verificar.email');
Route::post('/refresh-captcha', [CustomRegisterController::class, 'refreshCaptcha'])->name('refresh.captcha');

Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/refresh-captcha', [CustomRegisterController::class, 'refreshCaptcha'])->name('refresh.captcha');

Route::post('/validate-captcha', [CustomRegisterController::class, 'validateCaptcha'])->name('validate.captcha');

Route::post('/quejas/enviar', [ComplaintController::class, 'submit'])->name('complaints.submit');
Route::get('/contactenos', function () {
    return view('contactenos');
})->name('contactenos.form');
