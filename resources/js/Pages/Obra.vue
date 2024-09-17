<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";
export default {
    layout: LayoutPrincipal,
}
</script>

<script setup>
import dayjs from "dayjs";
import relativeTime from 'dayjs/plugin/relativeTime';
import { Head, Link } from "@inertiajs/vue3";
import Poster from "../Components/Poster.vue";
import Estrellitas from "../Components/Estrellitas.vue";
import Trailers from "../Components/Trailers.vue";
import Critica from "@/Components/Critica.vue";
import { getActiveLanguage } from "laravel-vue-i18n";
import es from "dayjs/locale/es";
import en from "dayjs/locale/en";

const props = defineProps({
    'obra' : Object,
    'generos' : String,
    'reparto' : String,
    'direccion' : String,
    'mediaEvaluaciones' : Object,
    'criticas' : Object,
    'secuelaPrecuela' : Object,
    'spinoffs' : Object,
    'nGifs' : Number
});

// Configuración fechas relativas dayjs
dayjs.extend(relativeTime);
dayjs.locale(getActiveLanguage());
</script>

<template>
    <Head>
        <title>
            {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}
        </title>
        <meta name="description" content="Ficha general de obra">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo text-3xl px-8">
            {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original  }}
        </h1>
        <!--3 apartados para poster, datos y valoraciones-->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-10">
            <!--Poster-->
            <div class="flex justify-start flex-col m-auto h-[100%] w-[90%]">
                <img :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt">
                <!--Puntuacion-->
                <estrellitas :mediaEvaluaciones="parseFloat(mediaEvaluaciones.evaluaciones_avg_evaluacion).toFixed(1)" :obra="obra" :mostrar-votos="true"/>
            </div>

            <!--Datos pelicula-->
            <div class="flex justify-center w-[95%] md:-ml[100px]">
                <div class="w-[90%] mx-auto">
                <!--Info general-->
                    <div class="mx-auto w-[90%]">
                        <!--Títulos-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.titulo') }}:
                        </span>
                            {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original  }}
                        </div>
                        <!--Año-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.fecha') }}:
                        </span>
                            {{ obra.fecha }}
                        </div>
                        <!--Duración-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.duracion') }}:
                        </span>
                            {{ Math.floor((parseInt(obra.duracion) / 60)) }}h
                            {{ parseInt(obra.duracion) % 60 }}min
                        </div>
                        <!--País-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.pais') }}:
                        </span>
                            {{ obra.pais }}
                        </div>
                        <!--Dirección-->
                        <div v-if="obra.directors[0]">
                        <span class="font-semibold text-lg">
                            {{ $t('obra.direccion') }}:
                        </span>
                            <span>
                            {{ props.direccion }}
                        </span>
                        </div>
                        <!--Reparto-->
                        <div v-if="obra.actors[0]">
                        <span class="font-semibold text-lg">
                            {{ $t('obra.reparto') }}:
                        </span>
                            <span>
                            {{ props.reparto }}
                        </span>
                        </div>
                        <!--Productora-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.productora') }}:
                        </span>
                            {{ obra.productora }}
                        </div>
                        <!--Géneros-->
                        <div v-if="obra.generos">
                        <span class="font-semibold text-lg">
                            {{ $t('obra.genero') }}:
                        </span>
                            <span>
                            {{ props.generos }}
                        </span>
                        </div>
                        <!--Sinopsis-->
                        <div>
                        <span class="font-semibold text-lg">
                            {{ $t('obra.sinopsis') }}:
                        </span>
                            {{ obra.sinopsis }}
                        </div>
                    </div>
                    <!--Festivales y premios-->
                    <div class="mt-4 mx-auto">
                        <h5 v-if="obra.festivals.length > 0" class="font-bold text-flamingo text-xl list-none">
                            {{ $t('obra.galardones') }}
                        </h5>
                        <div class="mx-auto w-[90%]">
                            <p v-for="fest in obra.festivals" class="text-md md:text-lg">
                                <span class="font-extrabold text-lg">{{ $t('obra.mejor_pelicula') }}</span> {{ fest.nombre}} ({{fest.edicion }})
                            </p>
                        </div>
                    </div>
                    <!--Saga-->
                    <div class="mt-4">
                        <span v-if="secuelaPrecuela || spinoffs" class="font-bold text-flamingo text-xl mt-2">
                            {{ $t('obra.saga') }}
                        </span>
                        <!-- Bloque para secuela/precuela -->
                        <div v-if="secuelaPrecuela" class="text-center flex flex-col items-center">
                            <div v-for="obra in secuelaPrecuela" class="w-[80%] md:w-[70%]">
                                <p class="mt-2 -mb-3">
                                    {{ props.obra.secuela.orden === 0 ? $t('obra.relacion') : obra.secuela.orden < props.obra.secuela.orden ? $t('obra.precuela') : $t('obra.secuela') }}
                                </p>
                                <poster :obra="obra" />
                            </div>
                        </div>
                        <!-- Bloque para spin-offs -->
                        <div v-if="spinoffs" class="text-center flex flex-col items-center">
                            <div v-for="obra in spinoffs" class="w-[80%] md:w-[70%]">
                                <p class="mt-2 -mb-3">
                                    {{ props.obra.secuela.orden === 0 ? $t('obra.relacion') : $t('obra.spinoff') }}
                                </p>
                                <poster :obra="obra" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Contenedor criticas-->
        <div class="m-auto w-[95%] grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-10 mb-15 justify-center bg-flamingo text-white lg:divide-x md:divide-x divide-y">
            <!--Criticas-->
            <div class="py-10 lg:col-span-3 md:col-span-2 w-[85%] sm:w-[80%] mx-auto">
                <!--Titulo-->
                <ul>
                    <li v-if="obra.profesionals.length > 0" class="list-none font-bold text-black text-xl mb-5">
                        {{ $t('obra.criticas_profesionales') }}
                    </li>
                </ul>
                <ul v-for="p in obra.profesionals">
                    <!--Críticas profesionales-->
                    <li class="ml-3 mb-4">
                        <span class="font-semibold">
                            <a class="hover:text-black" :href="p.medio.web" target="_blank">
                                {{ p.medio.nombre }}
                            </a>:
                        </span>
                        {{ p.contenido }}
                        <span class="italic">{{ p.autor }}
                        </span>
                        <span v-if="p.fecha">
                            ({{ dayjs(p.fecha).fromNow() }})
                        </span>
                    </li>
                </ul>
                <!--Titulo-->
                <div>
                    <h5 class="list-none font-bold text-black text-xl mt-10 mb-5">
                        {{ $t('obra.criticas_usuarios') }}
                    </h5>
                </div>
                <div v-for="(critica, indice) in criticas.slice(0, 2)" class="ml-3">
                    <!--Críticas usuarios-->
                    <critica :critica="critica" :indice="indice" />
                </div>
                <p class="ml-3">[...]</p>
                <p v-if="!criticas[0]" class="py-3">
                    {{ $t('obra.sin_criticas') }}
                </p>

                <Link :href="route('obraValoraciones', obra.titulo_slug)"
                      class="my-5 m-auto font-bold focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none text-sm">
                    <div class="mx-auto w-fit text-center mt-8 bg-white text-flamingo hover:bg-black px-5 py-2.5">
                        {{ $t('obra.usuarios_todas') }}&rarr;
                    </div>
                </Link>

            </div>

            <!--Seccion valorar-->
            <div class="w-full">
                <div class="py-5 mx-auto w-[80%] sm:w-[85%]">
                    <!--Titulo-->
                    <h3 class="font-bold text-black text-xl my-5 text-center">
                        {{ $t('obra.quieres_valorar') }}
                    </h3>
                    <h4>
                        {{ $t('obra.h4') }}
                    </h4>
                    <ul class="ml-[20px]">
                        <li class="list-disc ml-2">
                            {{ $t('obra.li1') }}
                        </li>
                        <li class="list-disc ml-2">
                            {{ $t('obra.li2') }}
                        </li>
                        <li class="list-disc ml-2">
                            {{ $t('obra.li3') }}
                        </li>
                    </ul>
                    <p class="pt-7">
                        {{ $t('obra.p') }}
                    </p>
                    <Link :href="route('valoracionesTop')"
                          class="my-15 m-auto focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold block w-4/6">
                        <div class="mt-10 text-center bg-white text-flamingo hover:bg-black px-5 text-sm py-2.5">
                            {{ $t('obra.top_valoraciones') }}&rarr;
                        </div>
                    </Link>
                </div>
            </div>
        </div>

<!--         Componente para el trailer-->
        <trailers :obra="obra"/>
    </div>
</template>
