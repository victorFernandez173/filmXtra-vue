<script setup>
import {Link, useForm} from "@inertiajs/vue3";

// Para el formulario de busqueda
const form = useForm({
    titulo : ''
});
</script>

<template>
    <nav class="bg-white border-gray-200  sticky top-0 z-50">
        <!-- Div con el contenido del nav -->
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo de la pagina -->
            <Link :href="route('/')" class="flex items-center">
                <img src="/images/logo.png" class="h-14" alt="Logo FilmXtra" />
            </Link>
            <!-- Bloque de búsqueda  -->
            <div class="flex justify-end md:order-2">
                <button type="button" data-collapse-toggle="navbar-search"  aria-controls="navbar-search" aria-expanded="false" class="lg:hidden text-gray-500  hover:bg-gray-100  focus:outline-none focus:ring-4 focus:ring-gray-200  rounded-lg text-sm p-2.5 mr-1" >
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Buscar</span>
                </button>
                <div id="navbar-search" class="relative hidden lg:block">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Icono buscar</span>
                    </div>
                    <form @submit.prevent="form.post( route('/'),
                    {
                    preserveScroll: true,
                    })">
                        <input v-model="form.titulo" type="text" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border-gray-300 rounded-lg bg-gray-50  border-[3px] focus:border-flamingo
                        focus:ring-0" placeholder="Buscar...">
                    </form>
                </div>
            </div>
            <!-- Apartado de usuario -->
            <div class="flex items-center md:order-3 font-bold">
                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-flamingo focus:ring-2 hover:ring-4 hover:ring-flamingo focus:flamingo" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Abrir menú de usuario</span>
                    <img class="w-8 h-8 rounded-full" src="/favicon.png" alt="Foto del usuario">
                </button>
                <!-- Menu de usuario desplegable -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-300 rounded-lg shadow-2xl" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">FilmXtra</span>
                        <span v-if="$page.props.auth.user" class="block text-sm  text-gray-500 truncate">{{ $page.props.auth.user.email }}</span>
                        <span v-else class="block text-sm  text-gray-500 truncate">Logueate</span>
                    </div>
                    <ul v-if="!$page.props.auth.user" class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <Link :href="route('/')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white">Loguearse</Link>
                        </li>
                        <li>
                            <Link :href="route('/')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white">Registrarse</Link>
                        </li>
                    </ul>
                    <ul v-else class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <Link href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white">Mis valoraciones</Link>
                        </li>
                        <li>
                            <Link href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white">Mis favoritas</Link>
                        </li>
                        <li>
                            <Link :href="route('/')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white">Ajustes</Link>
                        </li>
                        <li>
                            <Link :href="route('/')" method="post" as="button" class="block px-4 py-2 hover:bg-flamingo hover:text-white"  >Cerrar sesión</Link>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Links -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 text-center" id="mobile-menu-2">
                <ul class="hover:[&>li>a]:text-flamingo flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <Link :href="route('/')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Inicio</Link>
                    </li>
                    <li>
                        <Link :href="route('/')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Top FilmXtra</Link>
                    </li>
                    <li>
                        <Link :href="route('/')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 ">Top Valoraciones</Link>
                    </li>
                    <li>
                        <Link :href="route('/')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Cuenta</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>