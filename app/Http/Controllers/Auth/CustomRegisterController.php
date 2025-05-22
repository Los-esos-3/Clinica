<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CustomRegisterController
{
    public function showRegistrationForm()
    {
        $captchaCode = $this->generateCaptcha();
        Session::put('captcha_code', $captchaCode);

        return view('auth.register', ['captchaText' => $captchaCode]);
    }

    protected function generateCaptcha()
    {
        $characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $captchaCode = '';
        for ($i = 0; $i < 6; $i++) {
            $captchaCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $captchaCode;
    }

    public function register(Request $request)
    {
        Log::info('Entro al metodo');
        $UserCaptcha = $request->input('captcha');
        $InputCaptcha = $request->input('captchaText');

        try {
            // Validar los datos
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required', 'string', 'max:15'],
                'comments' => ['nullable', 'string', 'max:500'],
                'captcha' => ['required', 'string', function ($attribute, $value, $fail) {
                    if (strtoupper($value) !== strtoupper(Session::get('captcha_code'))) {
                        $fail('El código de verificación no es correcto.');
                    }
                }],
            ]);

            Log::info('Pidio y valido los datos');
            Log::info($request->all());
            if ($validator->fails()) {
                // Regenerar CAPTCHA para el nuevo intento
                $newCaptcha = $this->generateCaptcha();
                Session::put('captcha_code', $newCaptcha);

                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('captchaText', $newCaptcha);
            }
            Log::info('Comprobo el captcha y lo regenero');

            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'comments' => $request->comments,
                'trial_ends_at' => now()->addDays(30), // Fecha de fin de prueba
                'trial_ended' => false // Campo adicional para control
            ]);

            Log::info('creo el usuario');
            Log::info($user);

            $user->assignRole('Admin');

            Log::info('Asigno el rol de admin al usuario');

            // Autenticar al usuario
            Auth::login($user);
            Log::info('Autentico al usuario');

            // Limpiar el CAPTCHA de la sesión
            Session::forget('captcha_code');
            Log::info('Limpio el captcha de la sesion');

            return redirect()->route('welcome')
                ->with('success', '¡Listo! 🎉 Tu cuenta ha sido creada con éxito.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error en el registro: ' . $e->getMessage());

            // Regenerar CAPTCHA por si acaso
            $newCaptcha = $this->generateCaptcha();
            Session::put('captcha_code', $newCaptcha);

            return back()
                ->with('error', 'Hubo un error al procesar tu registro. Por favor, intenta nuevamente.')
                ->with('captchaText', $newCaptcha)
                ->withInput();
        }
    }

    public function refreshCaptcha()
    {
        $newCaptcha = $this->generateCaptcha();
        Session::put('captcha_code', $newCaptcha);

        return response()->json([
            'captcha' => $newCaptcha,
            'status' => 'success'
        ]);
    }

    public function validateCaptcha(Request $request)
    {
        $inputCaptcha = strtoupper($request->input('captcha'));
        $sessionCaptcha = strtoupper(Session::get('captcha_code'));

        return response()->json([
            'isValid' => $inputCaptcha === $sessionCaptcha
        ]);
    }
}
