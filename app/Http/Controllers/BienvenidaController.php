<?php

namespace App\Http\Controllers;

use DB;
use Inertia\Inertia;
use Exception;

class BienvenidaController extends Controller
{
    /**
     * Genera un array con 24 ids al azar
     * que serán las películas cargadas en Index
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
     * Devuelve la vista de bienvenida con esas películas
     * @throws Exception
     */
    public function bienvenida(){
        return Inertia::render('Index', [
            'obras' => DB::table('obras')
                ->select('obras.titulo', 'p.ruta', 'p.alt')
                ->join('posters AS p', 'obras.id', '=', 'p.obra_id')
                ->whereIn('obras.id', $this->obtenerObrasAleatorias())
                ->get()
        ]);
    }
}
