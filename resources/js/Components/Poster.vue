<script setup>
import { Link } from "@inertiajs/vue3";

// Props: 'obra': información de la obra; 'titulo': clases para estilos de los títulos en función de la vista/tamaño; 'info': ruta a la que va a llevan los enlaces (ficha info o fichaValoraciones)
const props = defineProps(['obra', 'titulo', 'info']);
</script>

<template>
    <div>
        <!-- Sección de títulos -->
        <Link :href="route([props.info ? '/':'/'], encodeURIComponent(obra['titulo']))" class="w-full flex justify-center flex-wrap text-center py-4 group relative font-oswald cursor-pointer">
            <div class="w-full px-3">
                <p :class="titulo" class="group-hover:invisible truncate text-flamingo font-bold text-lg">{{ obra['titulo'] }}</p>
            </div>
            <!-- Título que aparece con el hover -->
            <!--:class="obra['titulo'].length > 50 ? 'text-sm top-1 py-2.5' : 'text-lg top-0'"-->
            <div :class="titulo"  class="z-10 inline-block px-3 py-2 duration-0 absolute opacity-0 transition-opacity group-hover:opacity-100 w-full truncate text-flamingo font-bold group-hover:underline text-lg top-0">
                <p>{{ obra['titulo'] }}</p>
            </div>

            <!-- Sección de imagen -->
            <img :src="'../posters/' + [obra['ruta'] ? obra['ruta'] : obra['poster']['ruta']]"
                 :alt="obra['alt']" class="w-4/5 border-[10px] border-white group-hover:border-flamingo">

            <!-- Sección de nota y numero de valoraciones -->
            <h3 class="font-bold text-flamingo" v-if="obra['nota_media']">{{ parseFloat(obra['nota_media']).toFixed(1) }}</h3>
            <h3 class="font-medium" v-if="obra['num_valoraciones']">({{obra['num_valoraciones']}} valoraciones)</h3>
        </Link>
    </div>
</template>
