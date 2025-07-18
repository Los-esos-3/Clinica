<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckTrial
{
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        // Permitir acceso a rutas públicas
        if (!$user || $request->routeIs('plans', 'register', 'login', 'verification.*')) {
            return $next($request);
        }

        // Ignorar usuarios con el rol de Root
        if ($user->hasRole('Root')) {
            return $next($request);
        }
        
        if ($user->trial_ends_at && Carbon::now()->greaterThan($user->trial_ends_at)) {
            // Si ya está marcado como expirado pero sigue accediendo
            if (!$user->trial_ended) {
                $user->update(['trial_ended' => true]);
            }

            return redirect()->route('plans')->with('error', 'Tu prueba gratuita ha finalizado. Por favor elige un plan.');
        }

        return $next($request);
    }
}
