<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estándar-->
<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import Carrusel from "../Components/Carrusel.vue";
import Poster from "../Components/Poster.vue";
import {computed, onMounted} from "vue";
import {initCarousels} from "flowbite";
import Swal from "sweetalert2";

const props = defineProps(['obras', 'verificacionExitosa', 'gifNumero', 'citaInspiring', 'citaQuotable', 'citaPelicula', 'citaCine']);
const page = usePage();
const confirmacionVerificacionMail = computed(() => page.props.verificacionExitosa);
const borradoCuentaExitoso = computed(() => page.props.borradoCuentaExitoso);

onMounted(() => {
    /*Iniciamos el carrusel*/
    initCarousels();
    /*Si hay flash de email verificado, lanzamos SWAL*/
    if (confirmacionVerificacionMail.value) {
        Swal.fire({
            title: 'Enhorabuena!!',
            text: 'Tu email ha sido validado exitosamente',
            imageUrl: '../gif/' + usePage().props.gifNumero + '.gif',
            imageWidth: 400,
            imageAlt: 'gif de cine',
            showConfirmButton: false,
            position: 'center',
            timer: 4500
        });
    }
    /*Si hay flash de cuenta borrada, lanzamos SWAL*/
    if (borradoCuentaExitoso.value) {
        Swal.fire({
            title: 'Adios!!',
            text: 'Tu cuenta ha sido borrada. Lamentamos que te vayas.',
            imageUrl: '../gif/' + usePage().props.gifNumero + '.gif',
            imageWidth: 400,
            imageAlt: 'gif de cine',
            showConfirmButton: false,
            position: 'center',
            timer: 4500
        });
    }
})

</script>

<template>
    <Head>
        <title>Inicio</title>
        <meta name="description" content="Página de bienvenida de filmXtra">
    </Head>

    <!--  Carrusel   -->
    <Carrusel :citaInspiring="citaInspiring" :citaQuotable="citaQuotable" :citaPelicula="citaPelicula" :citaCine="citaCine" />

    <!-- Seccion Principal de contenido -->
    <div
        class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-4 m-auto my-8">
        <!-- Posters -->
        <Poster v-for="obra in obras" :obra="obra" :info="true"/>
    </div>
</template>
