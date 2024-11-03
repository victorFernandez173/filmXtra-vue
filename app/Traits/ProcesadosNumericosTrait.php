<?php

namespace App\Traits;

use App\Models\Obra;

trait ProcesadosNumericosTrait
{
    public static function obtenerDecadaPionera(): int
    {
        return (int) (substr(Obra::select(['fecha'])->orderBy('fecha')->first()->fecha, 0, 2).'00');
    }

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
