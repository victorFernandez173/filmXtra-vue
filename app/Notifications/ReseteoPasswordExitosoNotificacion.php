<?php

namespace App\Notifications;

use App\Mail\ReseteoPasswordExitosoMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReseteoPasswordExitosoNotificacion extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): ReseteoPasswordExitosoMail
    {
        return new ReseteoPasswordExitosoMail($notifiable);
    }
}
