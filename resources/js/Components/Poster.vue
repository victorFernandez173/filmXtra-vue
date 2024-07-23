<script setup>
import { Link } from "@inertiajs/vue3";
import NotaMedia from "@/Components/NotaMedia.vue";
import NumValoraciones from "@/Components/NumValoraciones.vue";

// Props:
// 'obra': título y poster de la obra;
const props = defineProps(['obra', 'titulo']);
</script>

<template>
    <div>
        <!-- Sección de títulos -->
        <Link :href="route('obra', obra.titulo_slug)" class="w-full flex justify-center flex-wrap text-center py-4 group relative font-oswald cursor-pointer">
            <!-- Título estático -->
            <div class="w-full px-3">
                <p class="group-hover:invisible lg:truncate text-flamingo font-bold text-lg">{{ obra.titulo }}</p>
            </div>
            <!-- Título que aparece con el hover -->
            <div :class="(titulo && obra.titulo.length > 50) ? titulo : 'text-lg'" class="z-10 inline-block px-3 py-2 duration-0 absolute opacity-0 transition-opacity group-hover:opacity-100 w-full lg:truncate text-flamingo font-bold group-hover:underline text-lg top-0">
                <p>{{ obra.titulo }}</p>
            </div>

            <!-- Sección de imagen -->
            <img :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt" class="w-4/5 border-[10px] border-white group-hover:border-flamingo">

            <!-- Sección de nota y numero de valoraciones -->
            <!-- Se muestran solo si se pasa como parte de la info de la obra: -->
            <!-- O 'NotaMedia' para el top filmXtra -->
            <NotaMedia v-if="obra.nota_media" :obra="obra" />
            <!-- o 'NumValoraciones' para el top valoraciones -->
            <NumValoraciones v-if="obra.num_valoraciones" :obra="obra" />
        </Link>
    </div>
</template>
