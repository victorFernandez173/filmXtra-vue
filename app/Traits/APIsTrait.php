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
     *
     * @throws RandomException
     */
    public static function citaQuotable(): string
    {
        try {
            // Consultamos la api: añadido withouthVerifying por problemas de la API con SSL certificate
            $respuesta = json_decode(Http::withoutVerifying()->get('https://api.quotable.io/quotes/random')->body(), true);

            // Creamos y retornamos la cita
            return '"'.$respuesta[0]['content'].'" - '.$respuesta[0]['author'];
        } catch(Throwable $e) {
            Log::error($e->getMessage());

            return static::citaSobreCine();
        }
    }
}
