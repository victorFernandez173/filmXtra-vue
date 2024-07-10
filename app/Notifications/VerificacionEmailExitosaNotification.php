<?php

namespace App\Notifications;

use App\Mail\BienvenidaMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerificacionEmailExitosaNotification extends Notification
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
    public function toMail(object $notifiable): BienvenidaMail
    {
        return (new BienvenidaMail($notifiable));
    }
}
