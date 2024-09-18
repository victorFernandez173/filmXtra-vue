<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'obra' : Object,
    'truncarTitulo' : {
        type : Boolean,
        default: false
    },
});
</script>

<template>
    <div>
        <!-- Sección de títulos -->
        <Link :href="route('obra', obra.titulo_slug)" class="w-full flex justify-center flex-wrap text-center py-4 group relative font-oswald cursor-pointer">
            <!-- Título estático: solo truncado en pantallas < sm y si hay existe truncarTitulo -->
            <div class="w-full px-3">
                <p class="group-hover:invisible text-flamingo font-bold text-lg" :class="truncarTitulo ? 'sm:truncate' : ''">{{ obra.titulo}}</p>
            </div>
            <!-- Título :hover -->
            <!-- Si el título es >45 y existe truncado: se achica con hover -->
            <div :class="(obra.titulo.length > 45 && truncarTitulo ? 'text-lg sm:text-sm sm:py-2.5 sm:top-0.5 ' : 'text-lg ')+(truncarTitulo ? 'sm:truncate' : '')" class="z-10 inline-block px-3 py-2 duration-0 absolute opacity-0 transition-opacity group-hover:opacity-100 w-full font-bold group-hover:underline top-2 text-flamingo">
                <p>{{ obra.titulo }}</p>
            </div>

            <!-- Sección de imagen -->
            <img :src="'/posters/thumbnails/tn_' + obra.poster.ruta" :alt="obra.poster.alt" class="w-4/5 border-[10px] border-white group-hover:border-flamingo">
        </Link>
    </div>
</template>
