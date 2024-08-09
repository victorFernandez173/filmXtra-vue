<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estandar para lo habitual-->
<script setup>
import { Head } from "@inertiajs/vue3";
import Paginacion from "../Components/Paginacion.vue";
import FichaPeli from "@/Components/FichaPeli.vue";

defineProps(['obras']);
</script>

<template>
    <Head>
        <title>
            Top FilmXtra
        </title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
    <div class="flex content-stretch">
        <!-- Contenido -->
        <div class="lg:w-[87vw] xl:w-[89vw] 2xl:w-[92vw] mx-auto">
            <!-- Título -->
            <h1 class="w-full mt-2 font-oswald text-center text-5xl h-[8vh] text-flamingo">
                Top Valoraciones FilmXtra
            </h1>
            <!-- Seccion Principal con las fichas -->
            <div class="container grid grid-cols-1 m-auto my-8">
                <ficha-peli v-for="obra in obras.data" :obra="obra" :info="true" />
            </div>
            <!-- Componente para la paginación -->
            <div class="w-full flex mt-8 mb-2">
                <paginacion class="mx-auto" :datos="obras"/>
            </div>
        </div>
    </div>
</template>
