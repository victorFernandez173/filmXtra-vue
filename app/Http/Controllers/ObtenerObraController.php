<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\CriticasRepo;
use App\Http\Repositorios\ObrasRepo;
use App\Traits\ProcesadoCamposTrait;
use Exception;
use Inertia\Inertia;
use Inertia\Response;

class ObtenerObraController extends Controller
{
    use ProcesadoCamposTrait;

    /**
     * Datos necesarios para pasar a la ficha de película
     * @param string $tituloSlug
     * @return Response
     * @throws Exception
     */
    public function fichaPelicula(string $tituloSlug)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($tituloSlug);

        return Inertia::render('Obra', [
            'obra'              => $obra,
            'generos'           => static::procesarGeneros($obra->generos),
            'reparto'           => static::procesarCasting($obra->actors),
            'direccion'         => static::procesarCasting($obra->directors),
            'mediaEvaluaciones' => ObrasRepo::obtenerObraNotaMedia($obra->titulo_slug),
            'criticas'          => CriticasRepo::obtenerArrayInfoCriticas($obra->criticas)->get(),
            'secuelaPrecuela'   => ObrasRepo::obtenerObrasRelacionadas($obra),
            'spinoffs'          => ObrasRepo::obtenerObrasRelacionadas($obra, false),
            //Numero de gifs disponibles en public/gif
            'nGifs'             => count(glob(public_path('/gif/') . '*'))
        ]);
    }
}
