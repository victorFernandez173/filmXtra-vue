<?php

namespace App\Listeners;

use App\Events\BajaUsuario;
use App\Notifications\BajaUsuarioNotificacion;
use Illuminate\Contracts\Queue\ShouldQueue;

class BajaUsuarioEscuchador implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(BajaUsuario $event): void
    {
        $event->usuario->notify(new BajaUsuarioNotificacion());
    }
}
