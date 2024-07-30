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
    });

// Ficha de obra
Route::get('/obra/{tituloSlug}', [ObtenerObraController::class, 'fichaPelicula'])->name('obra');


// Dar/quitar like
Route::post('/like', [CriticasController::class, 'darLike'])->name('darLike')->middleware('auth', 'verified');

// Rutas perfil: mostrar, editar y borrar
Route::middleware('auth')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Resto rutas auth
require __DIR__ . '/auth.php';

// TODO top: barra lateral hasta abajo && revisar: formulariofiltrado, selectconsulta, selectRangoanno... && quizas otra forma de mostrar el top con unas mini-fichas... && desactivar filtros deseleccionando opciones individualmente
// TODO fondo perfil cuenta corregir
// TODO REPRODUCIR funcionalidades filmXtraVic...


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


