<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roles->isEmpty()) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
