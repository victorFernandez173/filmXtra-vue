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
            <!-- Título estático -->
            <div class="w-full px-3">
                <p class="group-hover:invisible text-flamingo font-bold text-lg" :class="truncarTitulo ? 'truncate' : ''">{{ obra.titulo }}</p>
            </div>
            <!-- Título que aparece con el hover -->
            <!-- Si el título es muy largo y está truncado, se achica con hover -->
            <div :class="((obra.titulo.length > 45) && truncarTitulo ? 'text-sm py-2.5 top-0.5 ' : 'text-lg ')+(truncarTitulo ? 'truncate' : '')" class="z-10 inline-block px-3 py-2 duration-0 absolute opacity-0 transition-opacity group-hover:opacity-100 w-full font-bold group-hover:underline top-2 text-flamingo">
                <p>{{ obra.titulo }}</p>
            </div>

            <!-- Sección de imagen -->
            <img :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt" class="w-4/5 border-[10px] border-white group-hover:border-flamingo">
        </Link>
    </div>
</template>
