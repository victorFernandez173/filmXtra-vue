<?php

namespace App\Traits;

use App\Models\Obra;

trait ProcesadosNumericosTrait
{
    /**
     * Retorna int con la decada inicial de las peliculas existentes a partir de la mas antigua
     * @return int
     */
    public static function obtenerDecadaPionera(): int
    {
        return (int) (substr(Obra::select(['fecha'])->orderBy('fecha')->first()->fecha, 0, 2).'00');
    }

    /**
     * Retorna array con enumeración de las decadas
     * @return array
     */
    public static function obtenerArrayDecadas(): array
    {
        $decadaInicial = static::obtenerDecadaPionera();
        $decadas = [];
        for ($i = $decadaInicial; $i <= now()->format('Y'); $i += 10) {
            $decadas[] = $i;
        }

        return $decadas;
    }
}
