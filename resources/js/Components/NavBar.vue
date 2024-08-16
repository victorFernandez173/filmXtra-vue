<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {onMounted, onUpdated, ref} from "vue";
import Poster from "@/Components/Poster.vue";
import ModalBusqueda from "@/Components/ModalBusqueda.vue";
import Swal from "sweetalert2";


// Para el formulario de busqueda
const form = useForm({
    tituloBuscado : ''
});

// Variable para almacenar el timeout de retardo de la busqueda
let retardoBusquedaActivo = null;
// Con inputs se activa la busqueda: reactivacion del retardo de 1' con "on input" para dar tiempo a escribir y no realizar tantas consultas
const reactivarRetardoBusqueda = () => {
    if(retardoBusquedaActivo !== null){
        clearTimeout(retardoBusquedaActivo);
    }
    retardoBusquedaActivo = setTimeout(submit, 1000)
};

// Entrega del formulario se lleva a cabo cuando no se reestablece el retardo tras no hacer input en 1'
const submit = () => {
    if(form.tituloBuscado.length > 3){
        axios.post(route('buscar'), {tituloBuscado: form.tituloBuscado})
            .then((response) => {
                mostrarModalResultados(response.data);
            })
            .catch(() => {
                Swal.fire({
                    title: 'Upps...',
                    text: 'Parece que algo fue mal con la búsqueda...',
                    imageUrl: '../gif/' + (Math.floor(Math.random() * usePage().props.nGifs) + 1) + '.gif',
                    imageWidth: '80%',
                    imageAlt: 'gif de cine',
                    showConfirmButton: false,
                    position: 'center',
                    timer: 4500
                });
            })
    }
};
// Si hay resultados || si estamos en pantalla movil y hemos pulsado el boton de busqueda, para mostrar modal resultados:
const mostrarModalResultados = function (res) {
    busquedaExito.value = true;
    resultados.value = res;
};
// busquedaExito = reactiva para renderizar el bloque de resultados
const busquedaExito = ref(false);
// Y se almacenan en const resultados para mostrarlos:
const resultados = ref(null);
// Si hay algun error se muestra un SWAL y si no hay resultados se indica que no los hay
// Para cerrar el bloque de resultados:
const cerrarModalBusqueda = () => {
    busquedaExito.value = false;
    form.reset();
};


// Para mantener posicionado el boton de menu en pantallas estrechas arriba
const posicionarme = () => {
    if($('#mobile-menu-2').hasClass('hidden')){
        $('#mobile-menu-2-button').removeClass('absolute');
    } else {
        $('#mobile-menu-2-button').addClass('absolute');
    }
};
// Configuracion para el sistema de toggle del menu en pantallas estrechas con codigo variado jquery, js, etc por testing
// Desde que se montan: responden a los click en los correspondientes botones
onMounted(() => {
    $('#mobile-menu-2-button').click(function() {
        if ($('#mobile-menu-2').hasClass("block")) {
            $('#mobile-menu-2').removeClass("block").addClass("hidden");
            $('#mobile-menu-2-button').removeClass('mr-4');
        } else {
            $('#mobile-menu-2').removeClass("hidden").addClass("block");
            $('#mobile-menu-2-button').addClass('mr-4');
        }
    });
});
// Con cambios en la seccion: nos aseguramos que cualquiera de los dos menus se pliegan
onUpdated(() => {
    if ($('#mobile-menu-2').hasClass('block')) {
        $('#mobile-menu-2').removeClass("block").addClass("hidden");
        $('#mobile-menu-2-button').addClass('absolute').removeClass('mr-4');
    }
    if ($('#user-dropdown').hasClass('block')) {
        $('#user-dropdown').removeClass("block").addClass("hidden");
    }
});
</script>

<template>

    <!--  Modal para los resultados de la busqueda  -->
    <modal-busqueda :show="busquedaExito" @close="cerrarModalBusqueda">
        <div class="p-6">
            <div id="navbar-search-mobile" class="w-full">
                <form @submit.prevent="submit" class="w-10/12 ml-[8.33%] mb-[23px] relative">
                    <svg class="w-5 h-5 text-gray-500 absolute top-[.7rem] left-[.8rem]" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                    <input @input="reactivarRetardoBusqueda" v-model="form.tituloBuscado" type="text" id="navbar-search" class="w-full p-2 pl-10 text-sm text-gray-900 border-gray-300 bg-gray-50 border-[4px] focus:border-flamingo focus:ring-0" :placeholder="$page.props.errors.tituloBuscado ? $page.props.errors.tituloBuscado[0] : 'Busca...'">
                </form>
            </div>
            <!--  Encabezado en caso de hacer búsqueda  -->
            <div class="col-span-full  text-center mt-2">
                <h2 v-if="resultados.numResultados > 0" class="text-2xl text-flamingo">
                    {{ resultados.numResultados }} {{ resultados.numResultados === 1 ?  'Resultado:' : 'Resultados' }}
                </h2>
                <h2 v-else class="text-2xl text-flamingo">
                    Sin resultados
                </h2>
            </div>
            <!-- Seccion Principal de contenido -->
            <div class="container grid grid-cols-1 sm:grid-cols-2 gap-x-2 gap-y-2 m-auto my-2">
                <!-- Posters -->
                <poster @click="cerrarModalBusqueda" v-for="obra in resultados.obrasFiltradas" :obra="obra" :truncarTitulo="true" />
            </div>

            <div class="my-2 flex justify-center">
                <secondary-button @click="cerrarModalBusqueda">
                    Cerrar resultados
                </secondary-button>
            </div>
        </div>
    </modal-busqueda>

    <nav class="bg-white border-gray-200 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between lg:mx-auto py-3 relative">
            <!-- Logo de la pagina -->
            <Link :href="route('/')" class="flex items-center mb-2 lg:mb-0 p-3">
                <img src="/images/logo.png" class="h-10 sm:h-14" alt="Logo FilmXtra" />
            </Link>
            <!-- Bloque de búsqueda  -->
            <div class="flex md:order-2">
                <div id="navbar-search" class="relative hidden lg:block">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Icono buscar</span>
                    </div>
                    <form @submit.prevent="submit">
                        <input @input="reactivarRetardoBusqueda" v-model="form.tituloBuscado" type="text" id="navbar-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border-gray-300 bg-gray-50 border-[4px] focus:border-flamingo focus:ring-0" :placeholder="$page.props.errors.tituloBuscado ? $page.props.errors.tituloBuscado[0] : 'Busca...'">
                    </form>
                </div>
            </div>
            <!-- Apartado de usuario -->
            <div class="flex items-center font-bold lg:order-2">
                <!-- Boton de búsqueda pantallas estrechas incluido aquí por motivos de responsividad -->
                <button @click="mostrarModalResultados" type="button" class="absolute right-[6.75rem] lg:hidden text-gray-500 focus:ring-flamingo focus:ring-4 hover:ring-4 hover:ring-flamingo focus:flamingo text-sm p-2.5 mr-1" id="navbar-search-mobile-button">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button type="button" class="absolute right-16 lg:right-3 flex text-sm bg-gray-800 focus:ring-flamingo focus:ring-4 hover:ring-4 p-1 hover:ring-flamingo focus:flamingo" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">
                        Abrir menú de usuario
                    </span>
                    <img class="w-8 h-8" src="/favicon.png" alt="Foto del usuario">
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-300 shadow-3xl" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">
                            FilmXtra
                        </span>
                        <span v-if="$page.props.auth.user" class="block text-sm  text-gray-500 truncate">
                            {{ $page.props.auth.user.email }}
                        </span>
                        <span v-else class="block text-sm  text-gray-500 truncate">
                            Logueate
                        </span>
                    </div>
                    <ul v-if="!$page.props.auth.user" class="py-2 [&>li>a]:block [&>li>a]:px-4 [&>li>a]:py-2 [&>li>a]:text-sm [&>li>a]:text-gray-700 hover:[&>li>a]:bg-flamingo hover:[&>li>a]:text-white" aria-labelledby="user-menu-button">
                        <li>
                            <Link :href="route('login')">
                                Loguearse
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('register')">
                                Registrarse
                            </Link>
                        </li>
                    </ul>
                    <ul v-else class="py-2 [&>li>a]:block [&>li>a]:px-4 [&>li>a]:py-2 [&>li>a]:text-sm [&>li>a]:text-gray-700 hover:[&>li>a]:bg-flamingo hover:[&>li>a]:text-white" aria-labelledby="user-menu-button">
<!--                        <li>-->
<!--                            <Link href="#">-->
<!--                                Mis valoraciones-->
<!--                            </Link>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <Link href="#">-->
<!--                                Mis favoritas-->
<!--                            </Link>-->
<!--                        </li>-->
                        <li>
                            <Link :href="route('profile.edit')">
                                Cuenta
                            </Link>
                        </li>
                        <li>
                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-flamingo hover:text-white w-full text-left" :href="route('logout')" method="post" as="button">
                                Cerrar sesión
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Bloque Links -->
            <button id="mobile-menu-2-button" @click="posicionarme" type="button" class="absolute right-4 inline-flex items-center text-sm text-gray-500 lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-flamingo hover:ring-4 hover:ring-flamingo p-2">
                <span class="sr-only">
                    Abrir menú principal
                </span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
            <div class="bg-white lg:order-1 items-center justify-between hidden w-full lg:flex lg:w-auto text-center shadow-bajera lg:shadow-none" id="mobile-menu-2">
                <ul class="hover:[&>li>a]:text-flamingo flex flex-col font-medium p-4 lg:p-0 lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white [&>li>a]:block [&>li>a]:py-2 [&>li>a]:pl-3 [&>li>a]:pr-4 lg:hover:[&>li>a]:bg-transparent lg:[&>li>a]:p-0">
                    <li>
                        <responsive-nav-link :href="route('/')" :elegido="$page.url === '/' ? 'text-flamingo' : ''">
                            Inicio
                        </responsive-nav-link>
                    </li>
                    <li>
                        <responsive-nav-link :href="route('top')" :elegido="$page.url === '/top' ? 'text-flamingo' : ''">
                            Top FilmXtra
                        </responsive-nav-link>
                    </li>
                    <li>
                        <responsive-nav-link :href="route('valoracionesTop')" :elegido="$page.url === '/valoraciones-top' ? 'text-flamingo' : ''">
                            Top Valoraciones
                        </responsive-nav-link>
                    </li>
                    <li>
                        <responsive-nav-link v-if="$page.props.auth.user" :href="route('profile.edit')" :elegido="$page.url === '/profile' ? 'text-flamingo' : ''">
                            Cuenta
                        </responsive-nav-link>
                        <responsive-nav-link v-else :href="route('login')" >
                            Cuenta
                        </responsive-nav-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
