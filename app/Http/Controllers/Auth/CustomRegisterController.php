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
        $characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $captchaCode = '';
        for ($i = 0; $i < 6; $i++) {
            $captchaCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $captchaCode;
    }

    public function register(Request $request)
    {
        try {
            // Validar los datos
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'regex:/^[0-9+\-\s()]{7,15}$/'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'comments' => ['nullable', 'string', 'max:500'],
                'selected_plan' => ['required', 'string', 'in:basico,popular,premium'],
                'plan_days' => ['required', 'integer', 'min:1'],
                'plan_price' => ['required', 'numeric', 'min:0'],
                'captcha' => ['required', 'string', function ($attribute, $value, $fail) {
                    if ($value !== Session::get('captcha_code')) {
                        $fail('El código de verificación no es correcto.');
                    }
                }],
            ]);

            if ($validator->fails()) {
                $newCaptcha = $this->generateCaptcha();
                Session::put('captcha_code', $newCaptcha);

                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('captchaText', $newCaptcha);
            }
            // Guardar los datos del formulario temporalmente en sesión
            Session::put('registration_data', $request->all());


            return redirect()->route('verificacion.enviar', ['email' => $request->email]);
            $planExpiresAt = now()->addDays($request->plan_days);

            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'registration_source' => 'web',
                'password' => Hash::make($request->password),
                'comments' => $request->comments,
                'trial_ends_at' => now()->addDays(30), // Fecha de fin de prueba
                'trial_ended' => false, // Campo adicional para control
                'selected_plan' => $request->selected_plan,
                'plan_expires_at' => $planExpiresAt,
            ]);


            $user->syncRoles('Admin');

            // Autenticar al usuario
            Auth::login($user);

            // Limpiar el CAPTCHA de la sesión
            Session::forget('captcha_code');

            return redirect()->route('dashboard')
                ->with('success', '¡Registro exitoso! Tu plan ' . ucfirst($request->selected_plan) . ' está activo hasta ' . $planExpiresAt->format('d/m/Y'));
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
        $inputCaptcha = $request->input('captcha');
        $sessionCaptcha = Session::get('captcha_code');

        return response()->json([
            'isValid' => $inputCaptcha === $sessionCaptcha
        ]);
    }
}
