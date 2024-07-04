<?php

namespace App\Traits;

use Random\RandomException;

trait GifsTrait
{
    /**
     * Obtenemos el numero de gifs del directorio
     * y retornamos un int al azar que representa uno de ellos
     *
     * @return int
     * @throws RandomException
     */
    public function obtenerUnNumDeGif(): int
    {
        $numDeGifs = count(glob(public_path('/gif/').'*'));
        return random_int(1, $numDeGifs);
    }
}
