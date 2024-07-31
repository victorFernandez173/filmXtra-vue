<script setup>
import { Link } from "@inertiajs/vue3";
import NotaMedia from "@/Components/NotaMedia.vue";
import NumValoraciones from "@/Components/NumValoraciones.vue";

const props = defineProps(['obra']);

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
    <div class="w-11/12 flex my-4 mx-auto">
        <!--    Poster     -->
        <div class="w-3/12">
            <Link :href="route('obra', obra.titulo_slug)">
                <img :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt" class="w-11/12 border-[10px] border-white hover:border-flamingo">
            </Link>
        </div>
        <!--     Info    -->
        <div class="w-7/12 pr-4">
            <h1 class="font-bold text-flamingo text-2xl mt-4 mb-2">
                {{obra.titulo}}
            </h1>
            <!--Pais/Año-->
            <p class="text-lg">
                {{ obra.pais }} ({{ obra.fecha }})
            </p>
            <!--Duración-->
            <p class="text-lg">
                {{ Math.floor((parseInt(obra.duracion) / 60)) }}h
                {{ parseInt(obra.duracion) % 60 }}min
            </p>
            <!--Dirección-->
            <p v-if="obra.directors.length > 0" class="text-lg font-semibold">
                <span v-for="(director, i) in obra.directors">
                    {{ procesarNombre(director.nombre) }}{{ (i + 1 < obra.directors.length ? ',&nbsp;' : '' )}}
                </span>
            </p>
            <!--Reparto-->
            <p v-if="obra.actors.length > 0" class="text-lg truncate">
                <span class="text-lg">Reparto: </span>
                <span v-for="(actor, i) in obra.actors">
                    {{ procesarNombre(actor.nombre) }}{{ (i + 1 < obra.actors.length ? ',&nbsp;' : '' )}}
                </span>
                <span>...</span>
            </p>
            <!--Géneros-->
            <p v-if="obra.generos.length > 0" class="text-lg">
                <span class="text-lg">Género: </span>
                <span v-for="(genero, i) in obra.generos">
                    {{ genero.genero }}{{ (i + 1) < obra.generos.length ? ',&nbsp;' : '' }}
                </span>
            </p>
            <!--Productora-->
            <p class="text-lg">
                <span class="text-lg">Productora: </span>
                {{ obra.productora }}
            </p>
        </div>
        <!--     Valoraciones    -->
        <div class="w-2/12">
            <div class="w-full mt-[33%] text-center">
                <NotaMedia class="text-3xl" v-if="obra.evaluaciones_avg_evaluacion" :avg-evaluaciones="obra.evaluaciones_avg_evaluacion" />
                <NumValoraciones v-if="obra.evaluaciones_count" :num-valoraciones="obra.evaluaciones_count" />
            </div>
        </div>
    </div>
</template>
