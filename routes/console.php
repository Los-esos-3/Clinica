<?php

use App\Console\Commands\CheckTrialsExpiration;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();    

return function (Schedule $schedule) {
     // Verificar trials expirados diariamente a las 3 AM
    $schedule->command(CheckTrialsExpiration::class)->dailyAt('03:00');
    
    // Notificar trials por expirar (3 días antes) diariamente a las 10 AM
    $schedule->command(SendTrialEndingNotifications::class)->dailyAt('10:00');
};