<?php

namespace App\Traits;

trait GifsTrait
{
    /**
     * Obtenemos el numero de gifs del directorio
     * Retornamos un int al azar que representa uno de ellos
     *
     * @return int
     */
    public static function obtenerUnNumDeGif(): int
    {
        $numDeGifs =  count(glob( public_path('/gif/') . '*')) - 2;
        return rand(1, $numDeGifs);
    }
}
