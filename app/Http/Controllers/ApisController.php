<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class ApisController extends Controller
{
    /**
     * Por medio de una consulta a la API Quotable
     * Obtenemos una cita y la devovemos para usarla
     * @return string
     */
    static function cita2() {
        // Consultamos la api
        $respuesta = json_decode(Http::get('https://api.quotable.io/quotes/random')->body(), true);

        // Creamos y retornamos la cita
        return '"' . $respuesta[0]['content'] . '" - ' . $respuesta[0]['author'];
    }
}
