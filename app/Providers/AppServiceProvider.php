<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Models\User;
use MercadoPago\SDK;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();



        // Forzar HTTPS en producción
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }


        // if (class_exists('MercadoPago\SDK')) {
        //     SDK::setAccessToken(config('services.mercadopago.access_token'));
        //     SDK::setPublicKey(config('services.mercadopago.public_key'));
        // }
        // if($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}
