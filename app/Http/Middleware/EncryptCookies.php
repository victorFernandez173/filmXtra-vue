<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Nombres de las cookies que no deberían ser encriptadas
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
