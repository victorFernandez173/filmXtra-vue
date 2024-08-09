<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Models\Genero;
use App\Models\Obra;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Inertia\Inertia;
use Exception;
use Inertia\Response;

class MainController extends Controller
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
                [
                    'obras' => ObrasRepo::obtenerObrasIndex()
                ],
                ObrasRepo::obtenerDatosGeneralesIndex(),
            )
        );
    }

    /**
     * Para la busqueda de obras del navbar
     * @throws Exception
     */
    public function buscar()
    {
        $obras = ObrasRepo::obtenerObrasBusqueda(request('tituloBuscado'));

        return array_merge(
            [
                'obrasFiltradas' => $obras,
                'numResultados'  => $obras->count()
            ],
        );
    }

    /**
     *  Datos necesarios para obtener el TOP con filtrado si se incluyen parametros en la peticion
     * @return array|Response
     * @throws Exception
     * /
     */

    public function obtenerTop()
    {
        $obras = ObrasRepo::obtenerDatosObrasTop()->withCount(
            'evaluaciones'
        )->withAvg(
            'evaluaciones',
            'evaluacion'
        )->orderBy(
            'evaluaciones_avg_evaluacion',
            'DESC'
        )->cursorPaginate(
            8
        );

        $filtros = [
            'genero' => request('genero') ?? '',
            'pais'   => request('pais') ?? '',
            'desde'  => request('desde') ?? '',
            'hasta'  => request('hasta') ?? ''
        ];

        if (request()->wantsJson()) {
            return [
                'tienePaginas' => $obras->hasPages(),
                'obras'        => $obras,
                'filtros'      => $filtros,
            ];
        }

        return Inertia::render('Top', [
            'obras'   => $obras,
            'filtros' => $filtros,
            'generos' => Genero::select('genero')->pluck('genero'),
            'paises'  => Obra::select('pais')->groupBy('pais')->orderBy('pais')->pluck('pais'),
            'pionera' => Obra::select(['fecha'])->orderBy('fecha')->first()->fecha,
        ]);
    }

    /**
     * Datos necesarios para obtener el TOP VALORACIONES con filtrado si se incluyen parametros en la peticion
     * @return Response
     * @throws Exception
     */
    public function obtenerValoracionesTop(): Response
    {
        $obras = ObrasRepo::obtenerDatosObrasTop(
        )->withCount(
            'evaluaciones'
        )->orderBy(
            'evaluaciones_count',
            'DESC'
        )->withAvg(
            'evaluaciones',
            'evaluacion'
        )->paginate(8);

        return Inertia::render('ValoracionesTop', [
            'obras' => $obras,
        ]);
    }

}
