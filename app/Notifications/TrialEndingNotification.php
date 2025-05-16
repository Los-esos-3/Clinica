<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TrialEndingNotification extends Notification
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Tu prueba gratuita de Expedmed terminará en 3 días.')
            ->action('Elegir un plan', url('/plans'))
            ->line('¡Gracias por confiar en nuestro sistema!');
    }
}
