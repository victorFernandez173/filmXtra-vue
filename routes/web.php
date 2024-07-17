<?php

use App\Http\Controllers\ObtenerObraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;


/*
|--------------------------------------------------------------------------
| Rutas web
|--------------------------------------------------------------------------
|
| Rutas cargadas para por el RouteServiceProvider desde un grupo que contiene el grupo "web" middleware.
|
*/


Route::get('/', [IndexController::class, 'index'])->name('/');

Route::get('/obra/{id}', [ObtenerObraController::class, 'fichaPelicula'])->name('obra');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// TODO busqueda navbar reactivar;;;buscador mejorar: paginación, mensajes con los resultados...
// TODO 'route model binding' para las rutas de obra
// TODO REPRODUCIR funcionalidades filmXtraVic
// TODO al modificar la ruta de una obra, solo añadiendo caracteres en el trozo del titulo, se intenta acceder a esa obra pero claro, NO EXISTE y da un error de array[0] nulo porque claro no hay obra ESTUDIAR

// TODO notificaciones de algún tipo?? likes? criticas? estudiar (bootcamp ojear codigo)
// TODO policies para las modificaciones (bootcamp ojear codigo)
// TODO enlace correo filmxtra en footer layout lleva a formulario para contacto con nosotros: ssugerencias etc...
// TODO lang english?? como aplicar mediante funcionalidad lang
// TODO modo oscuro
// TODO sección de la web: listas propias/usuarios
// TODO honeypot (tallpad)
// TODO evaluación/criticas en el perfil de usuario
// TODO podcast en el permanent layout
// TODO avatar de usuario, completar las posibilidades de edición de datos personales en pagina de usuario
// TODO sección fotos de pelicula
// TODO roles para los gestores en una posible futura sección de gestion de datos
// TODO session bbdd driver, tabla con almacenamiento de sesiones
