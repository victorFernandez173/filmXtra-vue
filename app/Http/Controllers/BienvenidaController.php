<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class BienvenidaController extends Controller
{
    /**
     * Genera un array con 16 ids al azar
     * @throws Exception
     */
    public function obtenerObrasAleatorias(){
        $numPeliculas = DB::table('obras')->count();
        $peliculasId = [];
        for($i = 0; $i < 24; $i++){
            $aleatorio = rand(1, $numPeliculas);
            while(in_array($aleatorio, $peliculasId)){
                $aleatorio = rand(1, $numPeliculas);
            }
            $peliculasId[] = $aleatorio;
        }
        return $peliculasId;
    }

    /**
     * Devuelve la vista de bienvenida con esos 16 id
     * @throws Exception
     */
    public function bienvenida(){
        return Inertia::render('Welcome', [
            'obras' => DB::table('obras')
                ->select('obras.titulo', 'p.ruta', 'p.alt')
                ->join('posters AS p', 'obras.id', '=', 'p.obra_id')
                ->whereIn('obras.id', $this->obtenerObrasAleatorias())
                ->get()
        ]);
    }
}
