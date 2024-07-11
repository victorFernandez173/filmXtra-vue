<?php

namespace App\Listeners;

use App\Notifications\ReseteoPasswordExitosoNotificacion;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReseteoPasswordExitosoEscuchador implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        $event->user->notify(new ReseteoPasswordExitosoNotificacion());
    }
}
