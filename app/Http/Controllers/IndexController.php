<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Traits\APIsTrait;
use App\Traits\CitasTrait;
use App\Traits\GifsTrait;
use Illuminate\Foundation\Inspiring;
use Inertia\Inertia;
use Exception;

class IndexController extends Controller
{
    use CitasTrait, APIsTrait, GifsTrait;

    /**
     * Genera un array con 24 ids al azar
     * que serán las películas cargadas en Index
     * @throws Exception
     */
    public function obtenerObrasAleatorias(){
        $numPeliculas = Obra::count();
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
    public function index(){
        return Inertia::render('Index', [
            'obras' => Obra::select(['id', 'titulo'])
                ->with('poster:id,obra_id,ruta,alt')
                ->whereIn('id', $this->obtenerObrasAleatorias())
                ->get(),
            'verificacionExitosa' => session('verificacionExitosa'),
            'gifNumero' => $this->obtenerUnNumDeGif(),
            /*Citas*/
            'cita' => Inspiring::quote(),
            'cita2' => $this->citaQuotable(),
            'cita3' => $this->citaPelicula(),
            'cita4' => $this->citaSobreCine(),
        ]);
    }
}
