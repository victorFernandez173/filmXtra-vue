<?php

namespace App\Http\Repositorios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaginacionController;
use App\Models\Obra;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ObrasRepo extends Controller
{
    /**
     * Para obtener los datos iniciales/base de la obra con relaciones
     * @param int $idObra
     * @return Collection|Builder[]
     */
    static function obtenerDatosFichaObra(int $idObra): array|Collection
    {
        return Obra::with(['poster', 'secuela:obra_id,orden,saga', 'criticas', 'directors:nombre,edad,defuncion,pais', 'festivals:obra_id,nombre,edicion', 'profesionals:obra_id,medio_id,autor,contenido,fecha', 'evaluaciones:obra_id,usuario_id,evaluacion', 'actors:nombre,nombre_real,edad,defuncion,pais', 'generos:genero', 'trailer'])->where('id', $idObra)->get();
    }

    /**
     * Para devolver la nota media de todas las evaluaciones, devuelve 0 si no hay evaluaciones
     * @param $evaluaciones
     * @return float
     */
    static function calcularMediaEvaluaciones($evaluaciones): float
    {
        $sumatorio = 0;
        foreach ($evaluaciones as $eva) {
            $sumatorio += $eva['evaluacion'];
        }
        if (count($evaluaciones) == 0) {
            return 0;
        }
        return round($sumatorio / count($evaluaciones), 1);
    }

    /**
     * Crea un array con el contenido, likes y fecha de cada critica para la vista a partir de todas las criticas de la película y devuelve dicha información paginada
     * @param $criticas
     * @return LengthAwarePaginator
     */
    static function obtenerArrayInfoCriticas($criticas): LengthAwarePaginator
    {
        $criticasLikes = array();
        foreach ($criticas as $critica) {
            $criticasLikes[] = [
                'id_critica' => $critica['id'],
                'id_usuario' => $critica['usuario_id'],
                'critica' => $critica['critica'],
                'likes' => DB::table('likes')->where('critica_id', '=', $critica['id'])->count(),
                'fecha' => $critica['modificada'],
                'usuario' => DB::table('usuarios')->select('nombre', 'usuario')->where('id', '=', $critica['usuario_id'])->get(),
                'gustadaPor' => DB::table('likes')->select('usuario_id')->where('critica_id', '=', $critica['id'])->get(),
            ];
        }
        return PaginacionController::paginar($criticasLikes, 4);
    }

    /**
     * Para obtener secuelas/precuelas si las hubiera
     * @param $obra
     * @return mixed
     */
    static function obtenerSecuelaPrecuela($obra): mixed
    {
        // Si es una secuela esta obra
        if (isset($obra[0]['secuela'])) {
            // Obtenemos su orden en la saga
            $orden = $obra[0]['secuela']['orden'];
            $secuelaPrecuela = array();
            // Obtenemos las array con las pelis de la saga
            $secuelas = DB::table('secuelas')->select('saga', 'obra_id', 'orden')->where('saga', '=', $obra[0]['secuela']['saga'])->orderBy('orden', 'desc')->get();
            //proceso el array $secuelas para orden + 1 (secuela) y orden - 1 (precuela) y orden = 0 (spin-off)
            foreach ($secuelas as $esSecuela) {
                if (($esSecuela->orden == 0 && $orden >= 1) || (($orden - 1) == $esSecuela->orden || ($orden + 1) == $esSecuela->orden)) {
                    $secuelaPrecuela[] = $esSecuela->obra_id;
                }
            }
            return Obra::with('poster', 'secuela:obra_id,orden')->find($secuelaPrecuela);
        }
        return null;
    }

    /**
     * Para generar array con la info de las criticas profesionales
     * @param $obra
     * @return array|null
     * @throws Exception
     */
    static function obtenerInfoMediosProfesionals($obra): ?array
    {
        if (count($obra[0]['profesionals']) > 0) {
            $arrayProfesionals = array();
            foreach ($obra[0]['profesionals'] as $profesional) {
                $infoMedio = DB::table('medios')->find($profesional['medio_id']);
                $arrayProfesionals[] = ['medio' => $infoMedio->nombre, 'web' => $infoMedio->web, 'contenido' => $profesional->contenido, 'autor' => $profesional['autor'], 'fecha' => $profesional['fecha']];
            }
            return $arrayProfesionals;
        }
        return null;
    }
}
