<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->roles->isNotEmpty()) {
            // Si el usuario tiene roles y no está en el dashboard, permite continuar
            if (!$request->is('dashboard')) {
                return $next($request);
            }
        } else {
            // Si el usuario no tiene roles, redirige al welcome
            return redirect()->route('welcome');
        }
        
        return $next($request);
    }
}
