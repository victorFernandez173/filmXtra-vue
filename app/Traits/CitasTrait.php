<?php

namespace App\Traits;

use App\Models\Cita;

trait CitasTrait
{
    /**
     * Para devolver una cita de pelicula al azar
     * @return string
     */
    public function citaPelicula(): string
    {
        $citasPeliculas = Cita::where('tipo', 'Pelicula')->get();
        return $citasPeliculas[rand(0, count($citasPeliculas)-1)]['cita'];
    }

    /**
     * Para devolver una cita sobre cine al azar
     * @return string
     */
    public function citaSobreCine(): string
    {
        $citasPeliculas = Cita::where('tipo', 'SobreCine')->get();
        return $citasPeliculas[rand(0, count($citasPeliculas)-1)]['cita'];
    }
}
