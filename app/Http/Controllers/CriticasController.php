<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\CriticasRepo;
use App\Http\Repositorios\ObrasRepo;
use App\Http\Requests\EvaluarObraRequest;
use App\Models\Evaluacion;
use App\Models\Like;
use Auth;
use Exception;
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
//                'peliculaCriticas'     =>
//                    Critica::select(
//                        [
//                            'usuario_id',
//                            'obra_id',
//                            'critica'
//                        ]
//                    )->where(
//                        'obra_id',
//                        $obra->id
//                    )->get(),
                // Evaluaciones relacionadas con esta película
//                'peliculaEvaluaciones' =>
//                    Evaluacion::select(
//                        [
//                            'evaluaciones.id',
//                            'usuario_id',
//                            'obra_id',
//                            'evaluacion'
//                        ]
//                    )->where(
//                        'obra_id',
//                        $obra->id
//                    )->get(),
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
     * @throws Exception
     */
    public function evaluar(EvaluarObraRequest $request)
    {
        Evaluacion::updateOrCreate(
            [
                'usuario_id' => Auth::id(),
                'obra_id' => $request->obra_id
            ],
            [
                'evaluacion' => $request->evaluacion,
            ]
        );
    }
}
