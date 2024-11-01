<?php

namespace App\Events;

use App\Models\Usuario;
use Illuminate\Foundation\Events\Dispatchable;

class BajaUsuario
{
    use Dispatchable;

    public function __construct(public Usuario $usuario) {}
}
