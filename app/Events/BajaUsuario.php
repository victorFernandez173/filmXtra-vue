<?php

namespace App\Events;

use App\Models\Usuario;
use Illuminate\Foundation\Events\Dispatchable;

class BajaUsuario
{
    use Dispatchable;

    /**
     * Crea la instancia del evento
     *
     * @param Usuario $usuario
     */
    public function __construct(
        public Usuario $usuario
    ){}
}
