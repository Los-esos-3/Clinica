<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Si el usuario no tiene trial_ends_at o ya expiró
        if (!auth()->user()->trial_ends_at || auth()->user()->trial_ends_at < now()) {
            // Verifica si la ruta plans existe para evitar errores
            if (Route::has('plans')) {
                return redirect()->route('plans')
                    ->with('error', 'Tu período de prueba ha finalizado. Por favor elige un plan.');
            }

            // Fallback si la ruta no existe
            return redirect()->route('welcome')
                ->with('error', 'Tu período de prueba ha finalizado.');
        }

        return $next($request);
    }
}
