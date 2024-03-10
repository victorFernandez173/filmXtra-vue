<?php

namespace App\Traits;

use Http;
use Log;
use Throwable;

trait APIsTrait
{
    use CitasTrait;

    /**
     * Por medio de una consulta a la API Quotable
     *  Obtenemos una cita y la devovemos para usarla
     * @return string
     */
    public function citaQuotable(): string
    {
        try {
            // Consultamos la api
            $respuesta = json_decode(Http::get('https://api.quotable.io/quotes/rasndom')->body(), true);

            // Creamos y retornamos la cita
            return '"' . $respuesta[0]['content'] . '" - ' . $respuesta[0]['author'];
        } catch(Throwable $e) {
            Log::error($e->getMessage().': '.$e->getTraceAsString());

            return $this->citaSobreCine();
        }
    }
}
