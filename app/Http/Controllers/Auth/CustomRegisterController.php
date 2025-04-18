<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mews\Captcha\Facades\Captcha;

class CustomRegisterController
{
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showRegistrationForm()
{
        return view('auth.register');
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
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\\.com$/', $value)) {
                        $fail('El correo electrónico debe ser una cuenta de Gmail.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'comments' => ['nullable', 'string', 'max:500'],
            // 'captcha' => ['required', 'string', function ($attribute, $value, $fail) {
            //     $sessionCaptcha = session('captcha_code');
            //     logger()->info('Captcha ingresado: ' . $value);
            //     logger()->info('Captcha en sesión: ' . $sessionCaptcha);

            //     if ((string)$value !== (string)$sessionCaptcha) {
            //         $fail('El código de verificación no es correcto.');
            //     }
            // }],
        ]);
    }

    protected function create(array $data)
    {
        // Generar un código de verificación de 6 dígitos
        $verificationCode = sprintf('%06d', mt_rand(1, 999999));

        logger()->info('Generated verification code: ' . $verificationCode);

        // Crear el usuario con el código de verificación
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
            'comments' => $data['comments'] ?? null,
            // 'verification_code' => $verificationCode,
            // 'email_verified_at' => null,
        ]);

        // Guardar el código en la sesión para referencia
        Session::put('verification_code', $verificationCode);

        return $user;
    }

    public function generateCaptcha()
    {
        $captchaText = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        session(['captcha' => $captchaText]); // Guardar el CAPTCHA en la sesión
        return response()->json(['captcha' => $captchaText]);
    }


    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'captcha' => 'required|captcha',
            'number' => 'required|numeric',
            'comments' => "nullable",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Procesar el formulario de registro
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Cuenta creada exitosamente.');
    }

    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:users',
    //     'password' => 'required|string|min:8',
    //     'captcha' => 'required|string',
    //     'number' => 'required|string',
    //     'comments' => $data['comments'] ?? null,
    // ]);

    // if ($request->input('captcha') !== session('captcha')) {
    //     return back()->withErrors(['captcha' => 'El CAPTCHA ingresado no es válido.']);
    // } else {
    //     $user = $this->create($request->all());
    //     return redirect('/');
    // }


    // if ($validator->fails()) {
    //     return back()->withErrors($validator)->withInput();
    // }

    // try {


    //     logger()->info('Sending verification email to: ' . $user->email);
    //     logger()->info('With code: ' . $user->verification_code);

    //     Mail::to($user->email)->send(new VerificationCodeMail($user->verification_code));

    //     Session::put('registered_email', $user->email);
    //     Session::put('verification_sent', true);

    //     // Generar nuevo código CAPTCHA después del registro exitoso
    //     Session::forget('captcha_code');

    //     return redirect()->route('verificar.email.view', ['email' => $user->email])
    //                    ->with('success', 'Código enviado al correo.');

    // } catch (\Exception $e) {
    //     logger()->error('Error in registration process: ' . $e->getMessage());
    //     if (isset($user)) {
    //         $user->delete();
    //     }
    //     return back()->with('error', 'Error al enviar el correo. Intenta nuevamente.');
    // }
}

    // public function verifyForm(Request $request)
    // {
    //     $email = $request->query('email');
    //     if (!$email) {
    //         return redirect()->route('register');
    //     }
    //     return view('auth.verify', compact('email'));
    // }

    // public function verifyCode(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'code' => 'required|digits:6',
    //     ]);

    //     $user = User::where('email', $request->email)
    //                 ->where('verification_code', $request->code)
    //                 ->first();

    //     if (!$user) {
    //         return back()->withErrors(['code' => 'Código inválido o correo incorrecto.'])->withInput();
    //     }

    //     $user->email_verified_at = now();
    //     $user->verification_code = null;
    //     $user->save();

    //     Auth::login($user);

    //     return redirect($this->redirectTo)->with('success', 'Registro verificado y completado.');
    // }

    // public function refreshCaptcha()
    // {
    //     $newCaptcha = random_int(100000, 999999);
    //     session(['captcha_code' => $newCaptcha]);

    //     return response()->json([
    //         'captcha_code' => $newCaptcha,
    //         'status' => 'success'
    //     ]);
    // }
