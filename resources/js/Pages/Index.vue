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

const props = defineProps(['obras', 'verificacionExitosa', 'gifNumero', 'cita', 'cita2', 'cita3', 'cita4']);
const page = usePage();
const confirmacionVerificacionMail = computed(() => page.props.verificacionExitosa);

onMounted(() => {
    /*Iniciamos el carrusel*/
    initCarousels();
    /*Si hay flash de password reset, lanzamos SWAL*/
    if (confirmacionVerificacionMail.value === true) {
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
})

</script>

<template>
    <Head>
        <title>Inicio</title>
        <meta name="description" content="Página de bienvenida de filmXtra">
    </Head>

    <!--  Carrusel   -->
    <Carrusel :cita="cita" :cita2="cita2" :cita3="cita3" :cita4="cita4" />

    <!-- Seccion Principal de contenido -->
    <div
        class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-4 m-auto my-8">
        <!-- Posters -->
        <Poster v-for="obra in obras" :obra="obra" :info="true"/>
    </div>
</template>
