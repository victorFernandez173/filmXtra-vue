<script setup>
import { Head } from "@inertiajs/vue3";
import BarraLateral from "../Components/BarraLateral.vue";
import FormularioFiltrado from "../Components/FormularioFiltrado.vue";
import FichaPeli from "@/Components/FichaPeli.vue";
import { useIntersectionObserver } from '@vueuse/core';
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    'obras' : Object,
    'paises' : Array,
    'generos' : Array,
    'filtros' : Object,
    'pionera' : Number,
    'decadas' : Array
});

const gatilloScroll = ref(null);

// Para controllar con vue useIntersectionObserver el scrolling infinito
const { stop } = useIntersectionObserver(
    // Elemento observado para actuar
    gatilloScroll,
    ([{ isIntersecting }]) => {
        // Si llegamos al elemento
        if (isIntersecting) {
            // Clonamos el objeto para que pueda ser reutilizado sin errores
            const obrasClonadas = JSON.parse(JSON.stringify(props.obras));
            // Axios con url basica, parametros y cursor para especificar datos a pasar
            axios.get(`${props.obras.path}?cursor=${props.obras.next_cursor}${props.filtros.pais?'&pais='+props.filtros.pais:''}${props.filtros.genero?'&genero='+props.filtros.genero:''}${props.filtros.desde?'&desde='+props.filtros.desde:''}${props.filtros.hasta?'&hasta='+props.filtros.hasta:''}`).then((response) => {
                // En caso de que haya que paginar
                if(response.data.tienePaginas) {
                    props.obras.data = [...obrasClonadas.data, ...response.data.obras.data];
                    props.obras.prev_cursor = response.data.obras.prev_cursor;
                    props.obras.next_cursor = response.data.obras.next_cursor;
                }
                // Si response no tiene next_cursor, no hay más datos, se para el scrolling
                if (!response.data.obras.next_cursor) {
                    stop();
                }
            })
        }
    }
);
</script>

<template>
    <Head>
        <title>
            {{ $t('top_filmxtra.title') }}
        </title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
        <div class="min-h-[70.475vh] flex content-stretch">
            <!-- Barra lateral -->
            <div class="hidden lg:block lg:w-[14vw] xl:w-[13vw] 2xl:w-[11vw] min-[1800px]:w-[10vw] min-[2000px]:w-[9vw]">
                <barra-lateral :generos="generos" :paises="paises" :decadas="decadas" />
            </div>
            <!-- Contenido -->
            <div class="lg:w-[86vw] xl:w-[87vw] 2xl:w-[89vw] min-[1800px]:w-[90vw] min-[2000px]:w-[91vw] mx-auto">

                <!-- Título -->
                <h1 class="w-full mt-2 mb-12 font-oswald text-center text-5xl h-[8vh] text-flamingo">
                    {{ $t('top_filmxtra.h1') }}
                </h1>

                <!-- Formulario de filtrado -->
                <formulario-filtrado :paises="paises" :generos="generos" :pionera="pionera" :filtros="filtros"  />

                <!-- Seccion Principal con las fichas -->
                <div class="container grid grid-cols-1 m-auto my-8">
                    <ficha-peli v-for="obra in obras.data" :obra="obra" />
                </div>

                <!-- Para el infinite scrolling -->
                <div ref="gatilloScroll" />
            </div>
        </div>
</template>
