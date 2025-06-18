<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\User;

class AuthenticatedSessionController 
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (Auth::user()->HAsAnyRole('Admin','Doctor','Secretaria')) {
            return redirect()->route('dashboard');
        }elseif(Auth::user()->hasRole('Root'))
        {
            return redirect()->route('dashboardRoot');
        }
        // Usuario con roles, redirigir al dashboard
        return redirect()->intended(route('welcome'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
