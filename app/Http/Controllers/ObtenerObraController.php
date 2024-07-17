<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use Exception;
use Inertia\Inertia;
use Inertia\Response;

class ObtenerObraController extends Controller
{
    /**
     * Datos necesarios para pasar a la ficha de película
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function fichaPelicula(int $id)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($id);

        return Inertia::render('Obra', [
            'obra'              => $obra,
            'mediaEvaluaciones' => ObrasRepo::calcularMediaEvaluaciones($obra->evaluaciones),
            'criticas'          => ObrasRepo::obtenerArrayInfoCriticas($obra->criticas),
            'saga'              => $obra->secuela->saga ?? '',
            'secuelaPrecuela'   => ObrasRepo::obtenerSecuelaPrecuela($obra),
            //Numero de gifs disponibles en public/gif
            'nGifs'             => count(glob(public_path('/gif/') . '*'))
        ]);
    }
}
