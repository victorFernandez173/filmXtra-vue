<?php

namespace App\Notifications;

use App\Mail\BajaUsuarioMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BajaUsuarioNotificacion extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): BajaUsuarioMail
    {
        return new BajaUsuarioMail($notifiable);
    }
}
