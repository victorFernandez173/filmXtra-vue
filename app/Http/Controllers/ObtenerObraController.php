<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\CriticasRepo;
use App\Http\Repositorios\ObrasRepo;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use Inertia\Response;

class ObtenerObraController extends Controller
{
    /**
     * Datos necesarios para pasar a la ficha de película
     * @param string $tituloSlug
     * @return Response
     * @throws Exception
     */
    public function fichaPelicula(string $tituloSlug)
    {
        $obra = ObrasRepo::obtenerDatosFichaObra($tituloSlug);

        return Inertia::render('Obra', [
            'obra'              => $obra,
            'generos'           => $this->procesarGeneros($obra->generos),
            'reparto'           => $this->procesarCasting($obra->actors),
            'direccion'         => $this->procesarCasting($obra->directors),
            'mediaEvaluaciones' => ObrasRepo::obtenerObraNotaMedia($obra->titulo_slug),
            'criticas'          => CriticasRepo::obtenerArrayInfoCriticas($obra->criticas)->get(),
            'secuelaPrecuela'   => ObrasRepo::obtenerObrasRelacionadas($obra),
            'spinoffs'          => ObrasRepo::obtenerObrasRelacionadas($obra, false),
            //Numero de gifs disponibles en public/gif
            'nGifs'             => count(glob(public_path('/gif/') . '*'))
        ]);
    }


    /**
     * Retorna string con enumeración de los géneros
     * @param Collection $generos
     * @return string
     * @throws Exception
     */
    public function procesarGeneros(Collection $generos)
    {
        $cadenaGeneros = '';
        $generos->each(function ($valor) use (&$cadenaGeneros) {
            $cadenaGeneros .= $valor->genero . ', ';
        });
        return rtrim($cadenaGeneros, ', ') . '.';
    }

    /**
     * Retorna string con enumeración los nombres de actores, directores
     * @param Collection $casting
     * @return string
     * @throws Exception
     */
    public function procesarCasting(Collection $casting)
    {
        $cadenaCasting = '';
        $casting->each(function ($valor) use (&$cadenaCasting) {
            $cadenaCasting .= $this->procesarNombre($valor->nombre) . ', ';
        });
        return rtrim($cadenaCasting, ', ') . '.';
    }

    /**
     * Procesa nombres para anteponer nombre al apellido
     * @param string $nombre
     * @return string
     */
    public function procesarNombre(string $nombre)
    {
        $nombreProcesado = substr($nombre, strrpos($nombre, ',') + 2) . ' ';
        $nombreProcesado .= substr($nombre, 0, strrpos($nombre, ','));
        return $nombreProcesado;
    }
}
