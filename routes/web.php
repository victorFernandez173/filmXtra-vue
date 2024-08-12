<?php

use App\Http\Controllers\CriticasController;
use App\Http\Controllers\ObtenerObraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;


/*
|--------------------------------------------------------------------------
| Rutas web
|--------------------------------------------------------------------------
|
| Rutas cargadas para por el RouteServiceProvider desde un grupo que contiene el grupo "web" middleware.
|
*/

// Rutas principales: index, buscar, tops...
Route::controller(MainController::class)
    ->group(function () {
        Route::get('/', 'index')->name('/');
        Route::post('/buscar', 'buscar')->name('buscar');
        Route::get('/top', 'obtenerTop')->name('top');
        Route::get('/valoraciones-top', 'obtenerValoracionesTop')->name('valoracionesTop');
    });

// Ficha de obra
Route::get('/obra/{tituloSlug}', [ObtenerObraController::class, 'fichaPelicula'])->name('obra');


// Rutas para likes, criticas...
Route::controller(CriticasController::class)
    ->group(function () {
        Route::get('/obra/{tituloSlug}/valoraciones', 'obtenerFichaValoraciones')->name('obraValoraciones');
        Route::post('/like', 'darLike')->name('darLike')->middleware('auth', 'verified');
        Route::post('/evaluar', 'evaluar')->name('evaluar')->middleware('auth', 'verified', 'throttle:6,1');
        Route::post('/criticar', 'criticar')->name('criticar')->middleware('auth', 'verified', 'throttle:6,1');
    });

// Rutas perfil: mostrar, editar y borrar
Route::middleware('auth')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Resto rutas auth
require __DIR__ . '/auth.php';

// TODO mejorar ficha obra: estilos y html revisar...
// TODO funcionamientos selects desde hasta como en filmaffinity...
// TODO quitar bloque paginacion en topvaloraciones o combinar top valoraciones con top ????....
// TODO revisar cambios navbar ayer: ref()???

// TODO link email en footer a formulario para contacto, sugerencias...
// TODO lang english: aplicar mediante funcionalidad lang...
// TODO modo oscuro: (ej ResponsiveNavLink)...
// TODO seccion listas de peliculas personales usuarios...
// TODO spatie/laravel-honeypot...
// TODO secciones evaluaciones/criticas en el perfil de usuario...
// TODO podcast en el permanent layout...
// TODO avatar de usuario y +datos del usuario en el perfil...
// TODO roles para gestores en futura sección de gestion de datos...
// TODO session bbdd driver, tabla con almacenamiento de sesiones...


