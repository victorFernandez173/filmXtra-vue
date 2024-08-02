<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\ObrasRepo;
use App\Models\Critica;
use App\Models\Evaluacion;
use App\Models\Like;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CriticasController extends Controller
{
    public function obtenerFichaValoraciones($tituloSlug)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($tituloSlug);

        return Inertia::render('FichaValoraciones',
            [
                'obra' => $obra,
                // Para generar la nota media de la película
                'mediaEvaluaciones' => ObrasRepo::obtenerObraNotaMedia($tituloSlug),
                // Paginación, organización y mostrado de las críticas
//                'criticas' => InfoController::obtenerArrayInfoCriticas($obra[0]['criticas']),
                // Criticas relacionadas con esta película
                'pelicula_criticas' =>
                    Critica::select(
                        [
                            'usuario_id',
                            'obra_id',
                            'critica'
                        ]
                    )->where(
                        'obra_id',
                        $obra->id
                    )->get(),
                // Evaluaciones relacionadas con esta película
                'pelicula_evaluaciones' =>
                    Evaluacion::select(
                        [
                            'evaluaciones.id',
                            'usuario_id',
                            'obra_id',
                            'evaluacion'
                        ]
                    )->where(
                        'obra_id',
                        $obra->id
                    )->get(),
                // Paginación, organización y mostrado de las críticas
                'criticas' => $this->obtenerArrayInfoCriticas($obra->criticas),
                //Numero de gifs disponibles en public/gif
                'nGifs' => count(glob( public_path('/gif/') . '*'))
            ]
        );
    }

    /**
     * Crea un array con el contenido, likes y fecha de cada critica para la vista a partir de todas las criticas de la película y devuelve dicha información paginada
     * @param $criticas
     * @return LengthAwarePaginator
     */
    function obtenerArrayInfoCriticas($criticas): LengthAwarePaginator
    {
        $criticasLikes = array();
        foreach ($criticas as $critica) {
            $criticasLikes[] = [
                'id_critica' => $critica['id'],
                'id_usuario' => $critica['user_id'],
                'critica' => $critica['critica'],
                'likes' => DB::table('likes')->where('critica_id', '=', $critica['id'])->count(),
                'fecha' => $critica['modificada'],
                'usuario' => DB::table('usuarios')->select('nombre', 'usuario')->where('id', '=', $critica['usuario_id'])->get(),
                'gustadaPor' => DB::table('likes')->select('usuario_id')->where('critica_id', '=', $critica['id'])->get(),
            ];
        }
        // Solo 2 para testear los estilos del componente de paginacion???
        return PaginacionController::paginar($criticasLikes, 2);
    }


    /**
     * Para insertar tupla en likes o borrarla
     * @return void
     */
    public function darLike(): void
    {
        if (Like::where('usuario_id', request('usuario_id'))
            ->where('critica_id', request('critica_id'))
            ->exists()) {
            // Si el like ya existe, se elimina
            Like::where('usuario_id', request('usuario_id'))
                ->where('critica_id', request('critica_id'))
                ->delete();
        } else {
            // Sino, se guarda
            Like::create(['usuario_id' => request('usuario_id'), 'critica_id' => request('critica_id')]);
        }
    }
}
