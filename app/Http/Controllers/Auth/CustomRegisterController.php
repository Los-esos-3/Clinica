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
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class CustomRegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

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

    protected function create(array $data)
    {
        // Generar código de 6 dígitos
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
            'comments' => $data['comments'] ?? null,
            'verification_code' => $verificationCode,
            'email_verified_at' => null, // Asegurar que no esté verificado
        ]);
    }

    public function register(Request $request)
    {
        // Asegúrate que los nombres de campos coincidan con el formulario
        $request->merge(['number' => $request->phone]);
    
        $validator = $this->validator($request->all());
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Crear usuario
        $user = $this->create($request->all());
    
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user->verification_code));
    
            return redirect()->route('verificar.email.form', ['email' => $user->email])
                            ->with([
                                'verification_sent' => true,
                                'registered_email' => $user->email,
                                'success' => 'Se ha enviado un código de verificación a tu correo.'
                            ]);
                            
        } catch (\Exception $e) {
            $user->delete();
            logger()->error('Error sending verification email: '.$e->getMessage());
            return back()->with('error', 'Error al enviar el correo. Intenta nuevamente.');
        }
    }
}