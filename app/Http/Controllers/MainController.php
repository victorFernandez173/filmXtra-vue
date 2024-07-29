<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Models\Genero;
use App\Models\Obra;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Carbon\Carbon;
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
     * Peticiones GET: carga inicial o enlaces de filtrado de la barra lateral
     * @return Response
     * @throws Exception
     */
    public function obtenerTop(): Response
    {
        // Si no hay valor se asigna valor vacío u otro
        $desde = request('desde') ?? '';
        $hasta = request('hasta') ?? '';
        $pais = request('pais') ?? '';
        $genero = request('genero') ?? '';
        $d = request('desde') ?: '1870';
        $h = request('hasta') ?: Carbon::now()->format('Y');

        // Consulta multicondición para filtrar películas
        $obras = Obra::with(
            [
                'poster'
            ]
        )->where(
            'pais', 'LIKE', '%' . $pais . '%'
        )->whereBetween(
            'fecha', [$d, $h]
        )->whereHas(
            'generos',
            function ($query) use ($genero) {
                $query->where('genero', 'like', '%' . $genero . '%');
            }
        )->withCount(
            'evaluaciones'
        )->withAvg(
            'evaluaciones',
            'evaluacion'
        )->orderBy(
            'evaluaciones_avg_evaluacion', 'DESC'
        )->paginate(
            12
        );


        return Inertia::render('Top', [
            'obras'   => $obras,
            'generos' => Genero::select('genero')->get(),
            'paises'  => Obra::select('pais')->groupBy('pais')->orderBy('pais')->get(),
            'filtros' => [
                'genero' => $genero,
                'pais'   => $pais,
                'desde'  => $desde,
                'hasta'  => $hasta
            ],
            'pionera' => Obra::select('fecha')->orderBy('fecha')->limit(1)->get(),
        ]);
    }

}
