<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait ProcesadoCamposTrait
{
    /**
     * Retorna string con enumeración de los géneros
     */
    public static function procesarGeneros(Collection $generos): string
    {
        $cadenaGeneros = '';
        $generos->each(function ($valor) use (&$cadenaGeneros) {
            $cadenaGeneros .= $valor->genero.', ';
        });

        return rtrim($cadenaGeneros, ', ').'.';
    }

    /**
     * Retorna string con enumeración los nombres de actores, directores
     */
    public static function procesarCasting(Collection $casting): string
    {
        $cadenaCasting = '';
        $casting->each(function ($valor) use (&$cadenaCasting) {
            $cadenaCasting .= static::procesarNombre($valor->nombre).', ';
        });

        return rtrim($cadenaCasting, ', ').'.';
    }

    /**
     * Procesa nombres para anteponer nombre al apellido
     */
    public static function procesarNombre(string $nombre): string
    {
        $nombreProcesado = substr($nombre, strrpos($nombre, ',') + 2).' ';
        $nombreProcesado .= substr($nombre, 0, strrpos($nombre, ','));

        return $nombreProcesado;
    }
}
