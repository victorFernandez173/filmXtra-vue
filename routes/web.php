<?php

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


Route::get('/', [IndexController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// TODO españolizar columnas/datos de user como created_at etc....
// TODO logo navbar +pequeño tam. movil, incluso icon,
// TODO compactar citas en INDEX??? Mejorar estilos recuadro blanco
// TODO redirección tras logueo: si duranto un logueo te vas a otra pagina como la de uno de los logueos de git o google y luego te logueas en el otro, al loguearse y redirigir no te devuelve a index si por ej partiste en un origen de index en filmXtra sino a la otra pagina de logueo de git o google que visitaste previamente, no se si podre reproducirlo,CONFIRMADO QUE OCURRE ESO
// TODO eventserviceprovider event envio mail registros puede ser util?
// TODO event en RegisteredUserController, implementar para algo, event REGISTERED, VERIFIED...


// TODO lang english?? como aplicar mediante funcionalidad lang
// TODO modo oscuro
// TODO citasYapiTraits unir en una clase e instanciar en el service container para testear el IoC????o mejorar de alguna manera
// TODO REPRODUCIR funcionalidades filmXtraVic
// TODO al modificar la ruta de una obra, solo añadiendo caracteres en el trozo del titulo, se intenta acceder a esa obra pero claro, NO EXISTE y da un error de array[0] nulo porque claro no hay obra ESTUDIAR
// TODO 'route model binding' para las rutas de obra
// TODO rutas agrupadas por bloques
// TODO sección de la web: listas propias/usuarios
// TODO honeypot (tallpad)
// TODO evaluación/criticas en el perfil de usuario
// TODO podcast en el permanent layout
// TODO avatar de usuario, completar las posibilidades de edición de datos personales en pagina de usuario
// TODO sección fotos de pelicula
// TODO roles para los gestores en una posible futura sección de gestion de datos
// TODO notificaciones de algún tipo?? likes? criticas? estudiar (bootcamp ojear codigo)
// TODO policies para las modificaciones (bootcamp ojear codigo)
// TODO busqueda navbar reactivar;;;buscador mejorar: paginación, mensajes con los resultados...
// TODO session bbdd driver, tabla con almacenamiento de sesiones
// TODO enlace correo filmxtra en footer layout lleva a formulario para contacto con nosotros: ssugerencias etc...
