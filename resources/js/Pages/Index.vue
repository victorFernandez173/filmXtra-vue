<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estándar-->
<script setup>
import {Head} from "@inertiajs/vue3";
import Carrusel from "../Components/Carrusel.vue";
import Poster from "../Components/Poster.vue";
import {onMounted} from "vue";
import {initCarousels} from "flowbite";

onMounted(() => {
    initCarousels();
})

defineProps(['obras', 'numResultados']);

</script>

<template>
    <Head>
        <title>Inicio</title>
        <meta name="description" content="Página de bienvenida">
    </Head>

    <!--  Carrusel   -->
    <Carrusel/>

    <!-- Seccion Principal de contenido -->
    <div
        class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-4 m-auto my-8">
        <div v-if="$page.props.numResultados > 0" class="col-span-full  text-center my-3">
            <h4 class="text-lg">Resultados:</h4>
        </div>
        <!-- Posters -->
        <Poster v-for="obra in obras" :obra="obra" :titulo="`text-lg hover:text-sm sm:text-xl sm:hover:text-xl`"
                :info="true"/>
    </div>
</template>
