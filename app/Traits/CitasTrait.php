<?php

namespace App\Traits;

use App\Models\Cita;
use Random\RandomException;

trait CitasTrait
{
    /**
     * Para devolver una cita de pelicula al azar
     * @return string
     * @throws RandomException
     */
    static function citaPelicula(): string
    {
        $citasPeliculas = Cita::where('tipo', Cita::PELICULA)->get();
        return $citasPeliculas[random_int(0, count($citasPeliculas)-1)]['cita'];
    }

    /**
     * Para devolver una cita sobre cine al azar
     * @return string
     * @throws RandomException
     */
    static function citaSobreCine(): string
    {
        $citasPeliculas = Cita::where('tipo', Cita::SOBRECINE)->get();
        return $citasPeliculas[random_int(0, count($citasPeliculas)-1)]['cita'];
    }
}
