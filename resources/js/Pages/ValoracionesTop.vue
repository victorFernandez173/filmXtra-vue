<script setup>
import { Head } from "@inertiajs/vue3";
import Paginacion3 from "../Components/Paginacion3.vue";
import FichaPeli from "@/Components/FichaPeli.vue";

const props = defineProps({
    'obras' : Object
});
</script>

<template>
    <Head>
        <title>
            {{ $t('top_valoraciones.title') }}
        </title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
    <div class="flex content-stretch">
        <!-- Contenido -->
        <div class="lg:w-[87vw] xl:w-[89vw] 2xl:w-[92vw] mx-auto">
            <!-- Título -->
            <div class="mb-8 mt-2">
                <h1 class="w-full font-oswald text-center text-4xl sm:text-5xl h-[8vh] text-flamingo">
                    {{ $t('top_valoraciones.title') }}
                </h1>
            </div>
            <!-- Seccion Principal con las fichas -->
            <div class="container grid grid-cols-1 m-auto my-4">
                <ficha-peli v-for="obra in obras.data" :obra="obra" />
            </div>
            <!-- Componente para la paginación -->
            <div class="w-full flex mt-8 mb-2">
                <paginacion3 class="mx-auto" :datos="obras"/>
            </div>
        </div>
    </div>
</template>
