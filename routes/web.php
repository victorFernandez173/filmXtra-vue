<?php

use App\Http\Controllers\CriticasController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ObtenerObraController;
use App\Http\Controllers\ProfileController;

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
        Route::post('/like', 'darLike')->name('darLike')->middleware('auth', 'verified', 'throttle:13,1');
        Route::post('/evaluar', 'evaluar')->name('evaluar')->middleware('auth', 'verified', 'throttle:13,1');
        Route::post('/criticar', 'criticar')->name('criticar')->middleware('auth', 'verified', 'throttle:13,1');
    });

// Rutas perfil: mostrar, editar y borrar
Route::middleware('auth')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Cambio de idioma
Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang');

// Resto rutas auth
require __DIR__.'/auth.php';

// TODO phpinsights and larastan???
// TODO estilos globales y especificos de vistas para p, span...etc en ficheros css o algo así?? Quitando así clases de vistas...?
// TODO avatar de usuario y + otros datos del usuario en el perfil
// TODO modo oscuro: (ej ResponsiveNavLink)...
// TODO secciones evaluaciones/criticas en el perfil de usuario...

// TODO api REST
// TODO mantener paginacion en topvaloraciones o combinar con topfilmxtra es decir, que solo haya una seccion de tops que permita modificar el orden por nota o numValoraciones...
// TODO uso de collections en lugar de arrays???....
// TODO revision codigo global y otras ideas: logica componentes en componentes, ....
// TODO simbolito de carga o "cargando..." en la paginación por scroll...
// TODO link email en footer a formulario para contacto, sugerencias...
// TODO seccion listas de peliculas personales usuarios...
// TODO spatie/laravel-honeypot...
// TODO podcast en el permanent layout...
// TODO roles para gestores en futura sección de gestion de datos...
