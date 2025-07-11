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
                'selected_plan' => ['required', 'string', 'in:basico,popular,premium'],
                'plan_days' => ['required', 'string'],
                'plan_price' => ['required', 'numeric', 'min:0'],
                'captcha' => ['required', 'string', function ($attribute, $value, $fail) {
                    if ($value !== Session::get('captcha_code')) {
                        $fail('El código de verificación no es correcto.');
                    }
                }],
            ]);

            if ($validator->fails()) {
                // Regenerar CAPTCHA para el nuevo intento
                $newCaptcha = $this->generateCaptcha();
                Session::put('captcha_code', $newCaptcha);

                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('captchaText', $newCaptcha);
            }

            Session::put('registration_data', $request->all());

            return redirect()->route('verificacion', ['email' => $request->email]);
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
