<?php

namespace App\Http\Repositorios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaginacionController;
use App\Models\Like;
use App\Models\Obra;
use App\Models\Secuela;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_Obra_QB;

class ObrasRepo extends Controller
{
    /**
     * Para obtener los datos iniciales/base de la obra con relaciones
     * @param int $idObra
     * @return Obra|Builder|Model|_IH_Obra_QB
     */
    static function obtenerDatosFichaObra(int $idObra): Obra|Builder|Model|_IH_Obra_QB
    {
        return Obra::with([
            'poster',
            'secuela:obra_id,orden,saga',
            'criticas',
            'directors:nombre,edad,defuncion,pais',
            'festivals:obra_id,nombre,edicion',
            'profesionals.medio:id,nombre,web',
            'evaluaciones:obra_id,usuario_id,evaluacion',
            'actors:nombre,nombre_real,edad,defuncion,pais',
            'generos:genero',
            'trailer'])
            ->where('id', $idObra)
            ->first();
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
            $sumatorio += $eva->evaluacion;
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
                'id_critica' => $critica->id,
                'id_usuario' => $critica->usuario_id,
                'critica'    => $critica->critica,
                'likes'      => Like::where('critica_id', $critica->id)
                    ->count(),
                'fecha'      => $critica->modificada,
                'usuario'    => Usuario::select(['usuario'])
                    ->where('id', $critica->usuario_id)
                    ->get(),
                'gustadaPor' => Like::select('usuario_id')
                    ->where('critica_id', $critica->id)
                    ->get(),
            ];
        }
        return PaginacionController::paginar($criticasLikes, 4);
    }

    /**
     * Para obtener: secuelas, precuelas o spinoffs si las hubiera
     * @param $obra
     * @return mixed
     */
    static function obtenerSecuelaPrecuela($obra): mixed
    {
        // Si es parte de una saga esta obra
        if ($obra->secuela) {
            // Obtenemos su orden en la saga
            $orden = $obra->secuela->orden;
            // Obtenemos las que haya: secuela, precuela y spin-offs según 'orden'
            $relacionadas = Secuela::select('obra_id')
                ->where('saga', $obra->secuela->saga)
                ->whereIn('orden', [0, $orden + 1, $orden - 1])
                ->orderBy('orden', 'desc')
                ->get();

            // Retornamos info de esas obras
            return Obra::with('poster', 'secuela:obra_id,orden')
                ->find($relacionadas);
        }
        return null;
    }
}
