<?php

namespace App\Traits;

trait GifsTrait
{
    /**
     * Obtenemos el numero de gifs del directorio
     * y retornamos un int al azar que representa uno de ellos
     *
     * @return int
     */
    public function obtenerUnNumDeGif(): int
    {
        $numDeGifs = count(glob(public_path('/gif/') . '*'));
        return rand(1, $numDeGifs);
    }
}
