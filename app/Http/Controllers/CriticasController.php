<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\CriticasRepo;
use App\Http\Repositorios\ObrasRepo;
use App\Models\Critica;
use App\Models\Evaluacion;
use App\Models\Like;
use Inertia\Inertia;

class CriticasController extends Controller
{
    public function obtenerFichaValoraciones($tituloSlug)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($tituloSlug);

        return Inertia::render('FichaValoraciones',
            [
                'obra'                  => $obra,
                // Para generar la nota media de la película
                'mediaEvaluaciones'     => ObrasRepo::obtenerObraNotaMedia($tituloSlug),
                // Criticas relacionadas con esta película
                'pelicula_criticas'     =>
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
                'criticas'              => CriticasRepo::obtenerArrayInfoCriticas($obra->criticas)->paginate(3),
                //Numero de gifs disponibles en public/gif
                'nGifs'                 => count(glob(public_path('/gif/') . '*'))
            ]
        );
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

    /**
     * Añade una evaluacion o la modifica
     * @return void
     */
    public function evaluar()
    {

        $validated = request()->validate(
            [
                'evaluacion' => 'required|int|min:0|max:10',
            ],
            [
                'evaluacion' => 'No has elegido una puntuación.'
            ]
        );

        $evaluacion = new Evaluacion(
            [
                'usuario_id' => request('usuario_id'),
                'obra_id'    => request('obra_id'),
                'evaluacion' => request('evaluacion'),
            ]
        );

        if (Evaluacion::where('usuario_id', $evaluacion->usuario_id)->where('obra_id', $evaluacion->obra_id)->exists()) {
            $evaluacion->where('usuario_id', $evaluacion->usuario_id)->where('obra_id', $evaluacion->obra_id)->update(['evaluacion' => $evaluacion->evaluacion]);
        } else {
            $evaluacion->save();
        }
    }
}
