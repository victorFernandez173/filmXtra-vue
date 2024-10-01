<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\CriticasRepo;
use App\Http\Repositorios\ObrasRepo;
use App\Http\Requests\CriticarObraRequest;
use App\Http\Requests\EvaluarObraRequest;
use App\Models\Critica;
use App\Models\Evaluacion;
use App\Models\Like;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class CriticasController extends Controller
{
    public function obtenerFichaValoraciones($tituloSlug)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($tituloSlug);

        return Inertia::render('FichaValoraciones',
            [
                'obra'              => $obra,
                'mediaEvaluaciones' => ObrasRepo::obtenerObraNotaMedia($tituloSlug),
                'criticaUsuario'    => Critica::where('usuario_id', Auth::id())->where('obra_id', $obra->id)->pluck('critica'),
                'evaluacionUsuario' => Evaluacion::where('usuario_id', Auth::id())->where('obra_id', $obra->id)->pluck('evaluacion'),
                'criticas'          => CriticasRepo::obtenerArrayInfoCriticas($obra->criticas)->paginate(3),
                'nGifs'             => count(glob(public_path('/gif/') . '*'))
            ]
        );
    }


    /**
     * Para insertar tupla en likes o borrarla
     * @return RedirectResponse
     */
    public function darLike()
    {
        if (Like::where('usuario_id', request()->user()->id)
            ->where('critica_id', request('critica_id'))
            ->exists()) {
            // Si el like ya existe, se elimina
            Like::where('usuario_id', request()->user()->id)
                ->where('critica_id', request('critica_id'))
                ->delete();
        } else {
            // Sino, se guarda
            Like::create(['usuario_id' => request()->user()->id, 'critica_id' => request('critica_id')]);
        }
        return redirect()->back();
    }

    /**
     * Añade una evaluacion o la modifica
     * @return RedirectResponse
     * @throws Exception
     */
    public function evaluar(EvaluarObraRequest $request)
    {
        Evaluacion::updateOrCreate(
            [
                'usuario_id' => Auth::id(),
                'obra_id'    => $request->obra_id
            ],
            [
                'evaluacion' => $request->evaluacion,
            ]
        );
        return redirect()->back();
    }

    /**
     * Para poner o modificar critica de una obra
     * @param CriticarObraRequest $request
     * @return RedirectResponse
     */
    public function criticar(CriticarObraRequest $request)
    {
        Critica::updateOrCreate(
            [
                'usuario_id' => Auth::id(),
                'obra_id'    => $request->obra_id
            ],
            [
                'critica'    => $request->critica,
            ]
        );
        return redirect()->back();
    }
}
