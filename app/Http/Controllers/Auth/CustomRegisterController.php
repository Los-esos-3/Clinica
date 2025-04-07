<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomRegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'number' => ['required', 'integer', 'numeric', 'digits:10', 'unique:users'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            function ($attribute, $value, $fail) {
                if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $value)) {
                    $fail('El correo electrónico debe ser una cuenta de Gmail.');
                }
            },
        ],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'comments' => ['nullable', 'string', 'max:500'], 
    ]);
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
            'comments' => $data['comments'] ?? null, 
        ]);
    }
    

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);

        return redirect($this->redirectTo)->with('success', 'Tu cuenta se ha creado con éxito. Actualmente cuentas con el rol de usuario, espera a que un administrador te dé otro rol para interactuar con nuestras herramientas.');
    }
}