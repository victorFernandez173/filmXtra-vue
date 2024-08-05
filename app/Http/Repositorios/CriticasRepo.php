<?php

namespace App\Http\Repositorios;


use App\Http\Controllers\Controller;
use App\Models\Critica;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Critica_QB;

class CriticasRepo extends Controller
{
    /**
     * Crea un array con el contenido, likes y fecha de cada critica para la vista a partir de todas las criticas de la película y devuelve dicha información paginada
     * @param $criticas
     * @return _IH_Critica_QB|Builder
     */
    static function obtenerArrayInfoCriticas($criticas): Builder|_IH_Critica_QB
    {
        return Critica::with(['likes', 'usuario'])->whereIn('id', $criticas->pluck('id'))->withCount('likes');
    }

}
