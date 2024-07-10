<?php

namespace App\Listeners;

use App\Notifications\VerificacionEmailExitosaNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificacionEmailExitosaListener implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        if ($event->user->hasVerifiedEmail()) {
            //Si se ha verificado el email, hay que enviar la notificación de bienvenida
            $event->user->notify(new VerificacionEmailExitosaNotification());
        }
    }
}
