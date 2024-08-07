<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Collection;

trait ProcesadoCamposTrait
{
    /**
     * Retorna string con enumeración de los géneros
     * @param Collection $generos
     * @return string
     * @throws Exception
     */
    static function procesarGeneros(Collection $generos): string
    {
        $cadenaGeneros = '';
        $generos->each(function ($valor) use (&$cadenaGeneros) {
            $cadenaGeneros .= $valor->genero . ', ';
        });
        return rtrim($cadenaGeneros, ', ') . '.';
    }

    /**
     * Retorna string con enumeración los nombres de actores, directores
     * @param Collection $casting
     * @return string
     * @throws Exception
     */
    static function procesarCasting(Collection $casting): string
    {
        $cadenaCasting = '';
        $casting->each(function ($valor) use (&$cadenaCasting) {
            $cadenaCasting .= $this->procesarNombre($valor->nombre) . ', ';
        });
        return rtrim($cadenaCasting, ', ') . '.';
    }

    /**
     * Procesa nombres para anteponer nombre al apellido
     * @param string $nombre
     * @return string
     */
    static function procesarNombre(string $nombre): string
    {
        $nombreProcesado = substr($nombre, strrpos($nombre, ',') + 2) . ' ';
        $nombreProcesado .= substr($nombre, 0, strrpos($nombre, ','));
        return $nombreProcesado;
    }
}
