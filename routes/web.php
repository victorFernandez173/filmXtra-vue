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


Route::get('/', [IndexController::class, 'index'])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// TODO revisar componentes Uno a uno, REVISADOS: AppLogoIndex, Carrusel, Checkbox



// TODO usar Navlink/RESPONSIVENAVLINK en Navbar y otros components if possible
// TODO revisar Pages y Layouts, REVISADOS:
// TODO revisar paso por paso funcionamiento de los CONTROLLERS y REQUESTS, REVISADOS:
// TODO revisar resto ficheros, REVISADOS:
// TODO lang english?? como aplicar mediante funcionalidad lang
// TODO modo oscuro
// TODO index, posters aleatorios? siempre alien al principio???
// TODO implementar columnas tablas personalizadas para login y register, tb email personalizado? etc
// TODO logo navbar +pequeño tam. movil, incluso icon,
// TODO validaciones notacion OBJETOS en lugar de arrays
// TODO citasYapiTraits unir en una clase e instanciar en el service container para testear el IoC????o mejorar de alguna manera
// TODO evento VERIFIED
// TODO compactar citas en INDEX??? Mejorar estilos recuadro blanco
// TODO busqueda navbar reactivar
// TODO redirección tras logueo: si duranto un logueo te vas a otra pagina como la de uno de los logueos de git o google y luego te logueas en el otro, al loguearse y redirigir no te devuelve a index si por ej partiste en un origen de index en filmXtra sino a la otra pagina de logueo de git o google que visitaste previamente, no se si podre reproducirlo,CONFIRMADO QUE OCURRE ESO
// TODO REPRODUCIR funcionalidades filmXtraVic
// TODO paginas de error todas, documentacion
// TODO en la pagina de usuario se debería esconder el bloque de contraseña para cuentas o'auth
// TODO al modificar la ruta de una obra, solo añadiendo caracteres en el trozo del titulo, se intenta acceder a esa obra pero claro, NO EXISTE y da un error de array[0] nulo porque claro no hay obra ESTUDIAR
// TODO eventserviceprovider event envio mail registros puede ser util?
// TODO event en RegisteredUserController, implementar para algo, event REGISTERED, VERIFIED...
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
// TODO buscador mejorar: paginación, mensajes con los resultados...
// TODO session bbdd driver, tabla con almacenamiento de sesiones
// TODO enlace correo filmxtra en footer layout lleva a formulario para contacto con nosotros: ssugerencias etc...
