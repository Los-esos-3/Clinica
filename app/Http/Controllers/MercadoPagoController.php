<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController 
{
    public function __construct()
    {
        // Configurar credenciales
        $accessToken = config('services.mercadopago.access_token');

        if (empty($accessToken)) {
            throw new \Exception("Falta el token de acceso de MercadoPago");
        }

        MercadoPagoConfig::setAccessToken($accessToken);
    }

    public function createSubscription(Request $request)
    {
        $planId = $request->input('plan_id');
        $user = auth()->user();

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                "items" => [
                    [
                        "title" => 'Plan ' . $planId,
                        "quantity" => 1,
                        "unit_price" => $this->getPlanPrice($planId),
                        "currency_id" => "MXN"
                    ]
                ],
                "back_urls" => [
                    "success" => route('subscription.success'),
                    "failure" => route('subscription.failure'),
                    "pending" => route('subscription.pending')
                ],
                "auto_return" => "approved",
                "binary_mode" => true,
                "external_reference" => $user->id
            ]);

            return view('subscription.checkout', [
                'preference_id' => $preference->id,
                'public_key' => config('services.mercadopago.public_key') // Clave pública para el frontend
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error al crear preferencia: ' . $e->getMessage());
            return back()->with('error', 'Error al crear la preferencia: ' . $e->getMessage());
        }
    }

    protected function getPlanPrice($planId)
    {
        $plans = [
            'basic' => 299.00,
            'premium' => 599.00,
            'enterprise' => 999.00
        ];

        return $plans[$planId] ?? 0;
    }

    public function handleNotification(Request $request)
    {
        $paymentId = $request->input('data.id');
        $paymentClient = new PaymentClient();

        try {
            $payment = $paymentClient->get($paymentId);
            $this->updateSubscriptionStatus($payment);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error en notificación MP: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    protected function updateSubscriptionStatus($payment)
    {
        $userId = $payment->external_reference;
        $status = $payment->status;

        $user = \App\Models\User::find($userId);

        if ($user) {
            $user->update([
                'payment_status' => $status,
                'last_payment_at' => now(),
            ]);

            if ($status === 'approved') {
                $user->update([
                    'subscription_status' => 'active',
                    'subscription_end' => now()->addMonth(),
                ]);
            }
        }
    }

    public function success(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $paymentClient = new PaymentClient();

        try {
            $payment = $paymentClient->get($paymentId);

            if ($payment->status === 'approved') {
                auth()->user()->update([
                    'subscription_status' => 'active',
                    'subscription_end' => now()->addMonth(),
                ]);

                return view('subscription.success');
            }

            return redirect()->route('subscription.failure')->with('error', 'El pago no fue aprobado.');
        } catch (\Exception $e) {
            \Log::error('Error en pago exitoso: ' . $e->getMessage());
            return redirect()->route('subscription.failure')->with('error', 'Ocurrió un error al verificar el pago.');
        }
    }

    public function failure()
    {
        return view('subscription.failure');
    }

    public function pending()
    {
        return view('subscription.pending');
    }
}