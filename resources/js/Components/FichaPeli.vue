<script setup>
import { Link } from "@inertiajs/vue3";
import NotaMedia from "@/Components/NotaMedia.vue";
import NumValoraciones from "@/Components/NumValoraciones.vue";

const props = defineProps({
    'obra' : Object
});

// Antepone el nombre al apellido al estar "apellido, nombre" en la BBDD y devuelve el string
function procesarNombre(nombre) {
    // Primero el nombre
    let nombreProcesado = nombre.substring(nombre.indexOf(',') + 2, nombre.length);
    // Despues el apellido
    nombreProcesado += ' ' + nombre.substring(0, nombre.indexOf(','));
    return nombreProcesado;
}
</script>

<template>
    <div class="w-[97.5%] sm:w-11/12 flex my-4 mx-auto">
        <!--    Poster     -->
        <div class="w-4/12 md:w-3/12">
            <Link :href="route('obra', obra.titulo_slug)">
                <img :src="'/posters/thumbnails/tn_' + obra.poster.ruta" :alt="obra.poster.alt" class="w-[97.5%] sm:w-11/12 border-[10px] border-white hover:border-flamingo">
            </Link>
        </div>
        <!--     Info    -->
        <div class="w-8/12 md:w-7/12 pr-2 md:pr-4 lg:[&>p]:text-lg">
            <Link :href="route('obra', obra.titulo_slug)">
                <h1 class="font-bold text-flamingo text-lg md:text-xl lg:text-2xl mt-2 lg:mt-4 mb-1 lg:mb-2 hover:underline">
                    {{ $page.props.lang.appLocale === 'es' ? obra.titulo : obra.titulo_original }}
                </h1>
            </Link>
            <!-- Bloque valoraciones para pantallas estrechas -->
            <div class="md:hidden w-full text-center flex">
                <nota-media class="text-xl sm:text-2xl mr-4" v-if="obra.evaluaciones_avg_evaluacion" :avg-evaluaciones="obra.evaluaciones_avg_evaluacion" />
                <num-valoraciones v-if="obra.evaluaciones_count" :num-valoraciones="obra.evaluaciones_count" />
            </div>
            <!--Pais/Año-->
            <p>
                {{ obra.pais }} ({{ obra.fecha }})
            </p>
            <!--Duración-->
            <p>
                {{ Math.floor((parseInt(obra.duracion) / 60)) }}h
                {{ parseInt(obra.duracion) % 60 }}min
            </p>
            <!--Dirección-->
            <p v-if="obra.directors.length > 0" class="font-semibold">
                <span v-for="(director, i) in obra.directors">
                    {{ procesarNombre(director.nombre) }}{{ (i + 1 < obra.directors.length ? ',&nbsp;' : '' )}}
                </span>
            </p>
            <!--Reparto-->
            <p v-if="obra.actors.length > 0" class="truncate hidden lg:block">
                <span>{{ $t('ficha_peli.reparto') }}: </span>
                <span v-for="(actor, i) in obra.actors">
                    {{ procesarNombre(actor.nombre) }}{{ (i + 1 < obra.actors.length ? ',&nbsp;' : '' )}}
                </span>
                <span>...</span>
            </p>
            <!--Géneros-->
            <p v-if="obra.generos.length > 0" class="truncate">
                <span>{{ $t('ficha_peli.genero') }}: </span>
                <span v-for="(genero, i) in obra.generos">
                    {{ genero.genero }}{{ (i + 1) < obra.generos.length ? ',&nbsp;' : '' }}
                </span>
            </p>
            <!--Productora-->
            <p class="hidden lg:block">
                <span>{{ $t('ficha_peli.productora')}}: </span>
                {{ obra.productora }}
            </p>
        </div>
        <!--     Valoraciones    -->
        <div class="hidden md:block md:w-2/12">
            <div class="w-full mt-[33%] text-center">
                <nota-media class="text-2xl md:text-3xl lg:text-4xl" v-if="obra.evaluaciones_avg_evaluacion" :avg-evaluaciones="obra.evaluaciones_avg_evaluacion" />
                <num-valoraciones v-if="obra.evaluaciones_count" :num-valoraciones="obra.evaluaciones_count" />
            </div>
        </div>
    </div>
</template>
