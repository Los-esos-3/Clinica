<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar autenticación primero
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Por favor inicia sesión para continuar');
        }

        $user = $request->user();
        $currentRoute = $request->route()->getName();

        // Si ya está en la página de planes, permitir el acceso
        if ($currentRoute === 'plans') {
            return $next($request);
        }

        // Obtener la fecha de expiración efectiva
        $expirationDate = $this->getEffectiveExpirationDate($user);

        // Verificar si el acceso ha expirado
        if ($this->hasAccessExpired($expirationDate)) {
            return $this->handleExpiredAccess($user);
        }

        // Verificar si el acceso está por expirar (7 días antes)
        if ($this->isAccessAboutToExpire($expirationDate)) {
            $daysRemaining = now()->diffInDays($expirationDate);
            return redirect()->route('plans')
                ->with('warning', "Tu acceso expira en {$daysRemaining} días. Por favor renueva tu plan.");
        }

        return $next($request);
    }

    /**
     * Calcula la fecha de expiración efectiva del usuario
     */
    protected function getEffectiveExpirationDate($user): ?Carbon
    {
        if (!$user->trial_ends_at && !$user->plan_expires_at) {
            return null;
        }

        $dates = array_filter([$user->trial_ends_at, $user->plan_expires_at]);
        return count($dates) ? max(array_map(fn($date) => Carbon::parse($date), $dates)) : null;
    }

    /**
     * Determina si el acceso ha expirado
     */
    protected function hasAccessExpired(?Carbon $expirationDate): bool
    {
        return !$expirationDate || $expirationDate->isPast();
    }

    /**
     * Determina si el acceso está por expirar (en los próximos 7 días)
     */
    protected function isAccessAboutToExpire(?Carbon $expirationDate): bool
    {
        return $expirationDate && $expirationDate->between(now(), now()->addDays(7));
    }

    /**
     * Maneja la redirección cuando el acceso ha expirado
     */
    protected function handleExpiredAccess($user): Response
    {
        $message = 'Tu período de prueba y/o plan ha finalizado. Por favor elige un plan.';

        // Si el usuario tenía un plan activo anteriormente
        if ($user->plan_expires_at && Carbon::parse($user->plan_expires_at)->isPast()) {
            $message = 'Tu plan ha expirado. Por favor renueva tu suscripción.';
        }

        // Redirigir a planes si la ruta existe, de lo contrario a welcome
        return redirect()->route(
            Route::has('plans') ? 'plans' : 'welcome'
        )->with('error', $message);
    }
}