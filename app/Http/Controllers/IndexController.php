<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Http\Requests\BuscarTitulosRequest;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Inertia\Inertia;
use Exception;
use Log;

class IndexController extends Controller
{
    use CitasTrait, APIsTrait, GifsTrait;

    /**
     * Devuelve la vista de bienvenida con los posters y datos necesarios
     * @throws Exception
     */
    public function index()
    {
        return Inertia::render('Index',
            array_merge(
                ['obras' => ObrasRepo::obtenerObrasIndex()],
                ObrasRepo::obtenerDatosGeneralesIndex(),
            )
        );
    }

    /**
     * Devuelve la info de busqueda necesaria
     * @throws Exception
     */
    public function buscar(BuscarTitulosRequest $request)
    {
        return ['tituloBuscado' => $request->tituloBuscado];
    }

    /**
     * @throws Exception
     */
    public function cargarResultados()
    {
        $obras = ObrasRepo::obtenerObrasBusqueda(request('tituloBuscado'));

        return Inertia::render('Index', array_merge(
            [
                'obras'         => $obras,
                'numResultados' => $obras->count()
            ],
            ObrasRepo::obtenerDatosGeneralesIndex()
        ));
    }
}
