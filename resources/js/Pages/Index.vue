<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estándar-->
<script setup>
import { Head } from "@inertiajs/vue3";
import Carrusel from "../Components/Carrusel.vue";
import Poster from "../Components/Poster.vue";
import { onMounted } from "vue";
import { initCarousels } from "flowbite";
import Swal from "sweetalert2";
import { getActiveLanguage } from "laravel-vue-i18n";

const props = defineProps({
    'obras' : Object,
    'verificacionExitosa' : Boolean,
    'borradoCuentaExitoso' : Boolean,
    'nGifs' : Number,
    'citaInspiring' : String,
    'citaQuotable' : String,
    'citaPelicula' : String,
    'citaCine' : String
});

onMounted(() => {
    /*Iniciamos el carrusel*/
    initCarousels();
    /*Si hay flash de email verificado, lanzamos SWAL*/
    if (props.verificacionExitosa) {
        Swal.fire({
            title: getActiveLanguage() === 'es' ? 'Enhorabuena' : 'Congrats',
            text: getActiveLanguage() === 'es' ? 'Tu email ha sido validado exitosamente' : 'Email successfuly validated',
            imageUrl: '../gif/' + (Math.floor(Math.random() * props.nGifs) + 1) + '.gif',
            imageWidth: '80%',
            imageAlt: 'gif de cine',
            showConfirmButton: false,
            position: 'center',
            timer: 4500
        });
    }
    /*Si hay flash de cuenta borrada, lanzamos SWAL*/
    if (props.borradoCuentaExitoso) {
        Swal.fire({
            title: getActiveLanguage() === 'es' ? 'Adios' : 'Bye bye',
            text: getActiveLanguage() === 'es' ? 'Tu cuenta ha sido borrada. Lamentamos que te vayas' : 'Account deleted. We regret see you leaving us',
            imageUrl: '../gif/' + (Math.floor(Math.random() * props.nGifs) + 1) + '.gif',
            imageWidth: '80%',
            imageAlt: 'gif de cine',
            showConfirmButton: false,
            position: 'center',
            timer: 4500
        });
    }
});
</script>

<template>
    <Head>
        <title>
            {{ $t('inicio.title') }}
        </title>
        <meta name="description" content="Página de bienvenida de filmXtra">
    </Head>

    <!--  Carrusel   -->
    <carrusel :citaInspiring="citaInspiring" :citaQuotable="citaQuotable" :citaPelicula="citaPelicula" :citaCine="citaCine" />

    <!-- Seccion Principal de contenido -->
    <div class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-4 m-auto my-8">
        <!-- Posters -->
        <poster v-for="obra in obras" :obra="obra" :truncarTitulo="true" />
    </div>
</template>
