<?php

namespace App\Traits;

use Http;
use Log;
use Random\RandomException;
use Throwable;

trait APIsTrait
{
    use CitasTrait;

    /**
     * Por medio de una consulta a la API Quotable
     * Obtenemos una cita y la devovemos para usarla
     * @return string
     * @throws RandomException
     */
    static function citaQuotable(): string
    {
        try {
            // Consultamos la api
            $respuesta = json_decode(Http::get('https://api.quotable.io/quotes/random')->body(), true);

            // Creamos y retornamos la cita
            return '"'.$respuesta[0]['content'].'" - '.$respuesta[0]['author'];
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return static::citaSobreCine();
        }
    }
}
