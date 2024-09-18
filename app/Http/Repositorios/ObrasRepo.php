<?php

namespace App\Http\Repositorios;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use App\Models\Secuela;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Inspiring;
use LaravelIdea\Helper\App\Models\_IH_Obra_C;
use LaravelIdea\Helper\App\Models\_IH_Obra_QB;
use Random\RandomException;

class ObrasRepo extends Controller
{
    use CitasTrait, APIsTrait, GifsTrait;

    /**
     * Para obtener los datos iniciales/base de la obra con relaciones
     * @param string $tituloSlug
     * @return Obra|Builder|Model|_IH_Obra_QB
     */
    static function obtenerDatosFichaObra(string $tituloSlug): Obra|Builder|Model|_IH_Obra_QB
    {
        $obra = Obra::with([
            'poster',
            'pais:id,pais_'.app()->getLocale().' as pais',
            'secuela:obra_id,orden,saga',
            'criticas',
            'directors:nombre,edad,defuncion,pais',
            'festivals:obra_id,nombre,edicion',
            'profesionals.medio:id,nombre,web',
            'evaluaciones:obra_id,usuario_id,evaluacion',
            'actors:nombre,nombre_real,edad,defuncion,pais',
            'generos:genero_'.app()->getLocale().' as genero',
            'trailer'
        ])->where('titulo_slug', $tituloSlug)->first();

        // Si no hubiera obra, se aborta 404
        if (!$obra) {
            abort(404);
        }

        return $obra;
    }

    /**
     * Para obtener: secuelas, precuelas o spinoffs si las hubiera.
     * $tipo defecto true equivale a precuelas/secuelas; false spinoffs
     * @param Obra $obra
     * @param bool $tipo
     * @return mixed
     */
    static function obtenerObrasRelacionadas(Obra $obra, bool $tipo = true): mixed
    {
        // Si es parte de una saga esta obra
        if ($obra->secuela) {
            // Obtenemos su orden en la saga
            $orden = $obra->secuela->orden;
            // Obtenemos las que haya según 'orden'
            $relacionadas = Secuela::select('obra_id')
                ->where('saga', $obra->secuela->saga)
                ->where('obra_id', '!=', $obra->id)
                // $tipo = true: obtenemos secuelas/precuelas
                // Si es un spinoff obtenemos la primera de la saga como relacion
                ->when($tipo && $orden == 0, function ($query) use ($orden) {
                    return $query->where('orden', 1);
                })
                // Si es la primera de la saga solo obtenemos la secuela
                ->when($tipo && $orden == 1, function ($query) use ($orden) {
                    return $query->whereIn('orden', [$orden + 1]);
                })
                // Si es otra: secuela y precuela
                ->when($tipo && $orden > 1, function ($query) use ($orden) {
                    return $query->whereIn('orden', [$orden + 1, $orden - 1]);
                })
                // $tipo = false: obtenemos spinoffs
                ->when(!$tipo, function ($query) {
                    return $query->where('orden', 0);
                })
                ->get();

            // Retornamos info de esas obras
            return Obra::with(['poster', 'secuela' => function ($query) {
                $query->orderBy('orden');
            }])->find($relacionadas);
        }
        return null;
    }

    /**
     * Genera un array con 12 ids al azar
     * que serán las películas cargadas en Index
     * @throws Exception
     */
    static function obtenerObrasAleatorias(): array
    {
        $numPeliculas = Obra::count();
        $peliculasId = [];
        for ($i = 0; $i < 12; $i++) {
            $aleatorio = random_int(1, $numPeliculas);
            while (in_array($aleatorio, $peliculasId)) {
                $aleatorio = random_int(1, $numPeliculas);
            }
            $peliculasId[] = $aleatorio;
        }
        return $peliculasId;
    }

    /**
     * Datos adicionales necesario para el Index
     * @return array
     * @throws RandomException
     */
    static function obtenerDatosGeneralesIndex(): array
    {
        return [
            'verificacionExitosa'  => session('verificacionExitosa'),
            'borradoCuentaExitoso' => session('borradoCuentaExitoso'),
            'nGifs'                => static::obtenerNumDeGif(),
            /*Citas*/
            'citaInspiring'        => Inspiring::quote(),
            'citaQuotable'         => static::citaQuotable(),
            'citaPelicula'         => static::citaPelicula(),
            'citaCine'             => static::citaSobreCine(),
        ];
    }

    /**
     * Datos de obras aleatorias mostrados en el index
     * @throws Exception
     */
    static function obtenerObrasIndex()
    {
        return Obra::select(['id', 'titulo', 'titulo_original', 'titulo_slug'])
            ->with('poster:id,obra_id,ruta,alt')
            ->whereIn('id', static::obtenerObrasAleatorias())
            ->get()
            ->shuffle();
    }


    /**
     * @throws Exception
     */
    static function obtenerObrasBusqueda(string $tituloBuscado): array|Collection|_IH_Obra_C
    {
        return Obra::select(['id', 'titulo', 'titulo_original', 'titulo_slug', 'fecha'])
            ->with('poster:id,obra_id,ruta,alt')
            ->where('obras.titulo', 'like', '%' . $tituloBuscado . '%')
            ->orWhere('obras.titulo_original', 'like', '%' . $tituloBuscado . '%')
            ->orderBy('fecha', 'DESC')
            ->get();
    }


    /**
     * Datos consulta comunes a los dos tops
     * @return Builder|_IH_Obra_QB
     */
    static function obtenerDatosObrasTop(): Builder|_IH_Obra_QB
    {
        return Obra::select([
            'id',
            'pais_id',
            'titulo',
            'titulo_original',
            'titulo_slug',
            'duracion',
            'fecha',
            'productora'
        ])->with([
            'poster',
            'pais:id,pais_'.app()->getLocale().' as pais',
            'directors',
            'actors',
            'generos:genero_'.app()->getLocale().' as genero'
        ])->whereBetween(
            'fecha',
            [
                request('desde') ?: '1870',
                request('hasta') ?: Carbon::now()->format('Y')
            ]
        )->whereHas(
            'generos',
            function ($query) {
                $query->where(
                    'genero_'.app()->getLocale(),
                    'like',
                    '%' . (request('genero') ?? '') . '%'
                );
            }
        )->whereHas(
            'pais',
            function ($query) {
                $query->where(
                    'pais_'.app()->getLocale(),
                    'like',
                    '%' . (request('pais') ?? '') . '%'
                );
            }
        );
    }

    /**
     * Obtiene la nota media de una obra
     * @param string $tituloSlug
     * @return Obra
     */
    static function obtenerObraNotaMedia(string $tituloSlug): Obra
    {
        return Obra::where('titulo_slug', $tituloSlug)->withAvg('evaluaciones', 'evaluacion')->first();
    }

}
