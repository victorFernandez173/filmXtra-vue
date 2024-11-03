<?php

namespace App\Notifications;

use App\Mail\ReseteoPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReseteoPasswordNotificacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $url) {}

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
    public function toMail(object $notifiable): ReseteoPasswordMail
    {
        return new ReseteoPasswordMail($notifiable, $this->url);
    }
}
