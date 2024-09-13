<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'generos' : Array,
    'paises' : Array,
    'decadas' : Array,
})

const desplegarListado = (e) => {
    const listado = $(e.currentTarget).next();
    const titulo = $(e.currentTarget).children()[0];
    const flechaDesplegar = $(titulo).children()[0];
    const flechaOcultar = $(titulo).children()[1];
    if ($(e.currentTarget).next().hasClass("block")) {
        $(listado).removeClass("block");
        $(listado).addClass("hidden");
        $(flechaDesplegar).removeClass("hidden");
        $(flechaDesplegar).addClass("inline-block");
        $(flechaOcultar).addClass("hidden");
        $(flechaOcultar).removeClass("inline-block");
    } else {
        $(listado).removeClass("hidden");
        $(listado).addClass("block");
        $(flechaDesplegar).addClass("hidden");
        $(flechaDesplegar).removeClass("inline-block");
        $(flechaOcultar).removeClass("hidden");
        $(flechaOcultar).addClass("inline-block");
    }
}
</script>

<template>
    <section class="h-full bg-flamingo p-4 hover:[&>ul>li]:text-white [&>ul>li]:truncate">
        <!-- Genero -->
        <div @click="desplegarListado" class="hover:cursor-pointer">
            <h5 class="mt-5 font-bold">
                {{ $t('genero') }}
                <svg class="w-4 h-3 hidden text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
                <svg class="w-3 h-4 inline-block text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
            </h5>
        </div>
        <div class="block">
            <ul>
                <li v-for="genero in generos">
                    <Link :href="route('top')" :data="{ genero: genero }">
                        {{ genero }}
                    </Link>
                </li>
            </ul>
        </div>

        <!-- Decada -->
        <div @click="desplegarListado" class="hover:cursor-pointer">
            <h5 class="mt-5 font-bold">
                {{ $t('decada') }}
                <svg class="w-4 h-3 inline-block text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
                <svg class="w-3 h-4 hidden text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
            </h5>
        </div>
        <div class="hidden">
            <ul>
                <li v-for="decada in decadas">
                    <Link :href="route('top')" :data="{ desde : decada.toString(), hasta : (decada+9) }">
                        {{ `${decada}s` }}
                    </Link>
                </li>
            </ul>
        </div>

        <!-- Pais -->
        <div @click="desplegarListado" class="hover:cursor-pointer">
            <h5 class="mt-5 font-bold">
                {{ $t('pais') }}
                <svg class="w-4 h-3 inline-block text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                    <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                </svg>
                <svg class="w-3 h-4 hidden text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 10">
                    <path d="M15.434 1.235A2 2 0 0 0 13.586 0H2.414A2 2 0 0 0 1 3.414L6.586 9a2 2 0 0 0 2.828 0L15 3.414a2 2 0 0 0 .434-2.179Z"/>
                </svg>
            </h5>
        </div>
        <div class="hidden">
            <ul>
                <li v-for="pais in paises">
                    <Link :href="route('top')" :data="{ pais : pais }">
                        {{ pais }}
                    </Link>
                </li>
            </ul>
        </div>
    </section>
</template>
