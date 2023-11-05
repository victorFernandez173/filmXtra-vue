<?php

namespace App\Traits;

use Http;

trait APIsTrait
{
    /**
     * Por medio de una consulta a la API Quotable
     * Obtenemos una cita y la devovemos para usarla
     * @return string
     */
    public function citaQuotable(): string
    {
        // Consultamos la api
        $respuesta = json_decode(Http::get('https://api.quotable.io/quotes/random')->body(), true);

        // Creamos y retornamos la cita
        return '"' . $respuesta[0]['content'] . '" - ' . $respuesta[0]['author'];
    }
}
