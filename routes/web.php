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

// TODO computed en Index.vue necesarios???...
// TODO espacios y comas en mensajes de filtros corregir???...
// TODO props: $page.props, props, page.props, nombrePropDirectamente?poner todos declarando tipos...
// TODO paginación por scrolling en tops...
// TODO mejorar ficha obra: estilos y html revisar...
// TODO dejar de pasar user_id desde el front si es posible en otras rutas: quitado de evaluar
// TODO estilos barra lateral top revisar...
// TODO menu navbar cerrar al ir a ruta...
// TODO boton resetear filtros no responde a la primera y filtrar...
// TODO funcionamientos selects desde hasta como en filmaffinity...


// TODO notificaciones de algún tipo?? likes? criticas? estudiar (bootcamp ojear codigo)
// TODO policies para las modificaciones (bootcamp ojear codigo)
// TODO enlace correo filmxtra en footer layout lleva a formulario para contacto con nosotros: ssugerencias etc...
// TODO lang english?? como aplicar mediante funcionalidad lang
// TODO modo oscuro
// TODO sección de la web: listas propias/usuarios
// TODO honeypot (tallpad)
// TODO evaluación/criticas en el perfil de usuario
// TODO podcast en el permanent layout
// TODO avatar de usuario y datos faltantes personales en pagina de usuario
// TODO roles para los gestores en una posible futura sección de gestion de datos
// TODO session bbdd driver, tabla con almacenamiento de sesiones


