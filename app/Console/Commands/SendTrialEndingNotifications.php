<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\TrialEndingSoonNotification;

class SendTrialEndingNotifications extends Command
{
    protected $signature = 'trials:send-ending-notifications';
    protected $description = 'Send notifications for trials ending soon';

    public function handle()
    {
        $users = User::whereBetween('trial_ends_at', [now(), now()->addDays(3)])
            ->where('trial_ended', false)
            ->whereNull('trial_ending_notified_at')
            ->get();

        foreach ($users as $user) {
            $daysLeft = now()->diffInDays($user->trial_ends_at);
            $user->notify(new TrialEndingSoonNotification($daysLeft));
            $user->update(['trial_ending_notified_at' => now()]);
        }

        $this->info('Sent notifications to '.$users->count().' users');
    }
}