<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Http\Requests\BuscarTitulosRequest;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Inertia\Inertia;
use Exception;
use Random\RandomException;

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
     * Pasa la validacion y devuelve el titulo buscado
     * @throws Exception
     */
    public function buscar(BuscarTitulosRequest $request)
    {
        return ['tituloBuscado' => $request->tituloBuscado];
    }

    /**
     * Recibe el texto buscado y recupera los datos que está confirmado que existen
     * @return mixed
     * @throws RandomException
     * @throws Exception
     */
    public function cargarResultadosBusqueda()
    {
        $obras = ObrasRepo::obtenerObrasBusqueda(request('titulo-buscado'));

        return array_merge(
                [
                    'obras'         => $obras,
                    'numResultados' => $obras->count()
                ],
                ObrasRepo::obtenerDatosGeneralesIndex()
        );
    }
}
