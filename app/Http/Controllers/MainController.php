<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Models\Genero;
use App\Models\Pais;
use App\Traits\ProcesadosNumericosTrait;
use Inertia\Inertia;
use Exception;
use Inertia\Response;

class MainController extends Controller
{
    use ProcesadosNumericosTrait;

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
            'generos' => Genero::select(['genero_'.app()->getLocale()])->pluck('genero_'.app()->getLocale()),
            'paises'  => Pais::select(['pais_'.app()->getLocale()])->orderBy('pais_'.app()->getLocale())->pluck('pais_'.app()->getLocale()),
            'pionera' => static::obtenerDecadaPionera(),
            'decadas' => static::obtenerArrayDecadas()
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
        )->paginate(12);

        return Inertia::render('ValoracionesTop', [
            'obras' => $obras,
        ]);
    }

}
