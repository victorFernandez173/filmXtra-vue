<?php

namespace App\Http\Controllers;

use App\Models\Critica;
use App\Models\Like;
use Exception;
use Illuminate\Http\Request;

class CriticasController extends Controller
{
    /**
     * Para poner o modificar critica de una obra
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function criticar(Request $request)
    {
        // Validación (reglas y mensajes de error)
        $validated = $request->validate([
            'critica' => 'required|max:5000',
        ],
        [
            'critica.required' => 'No has escrito nada.',
            'critica.max'      => 'No puedes sobrepasar los 5000 caracteres.'
        ]);

        // Creamos el objeto
        $critica = new Critica([
            'user_id' => $request['user_id'],
            'obra_id' => $request['obra_id'],
            'critica' => $validated['critica']
        ]);

        if (Critica::where('user_id', $critica->user_id)
            ->where('obra_id', $critica->obra_id)
            ->exists()) {
            $critica->where('user_id', $critica->user_id)
                ->where('obra_id', $critica->obra_id)
                ->update(['critica' => $critica->critica]);
        } else {
            $critica->save();
        }
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
