<script setup>
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    status: Number,
});

const message = computed(() => {
    return props.status >= 500 ?
        'Parece que estamos teniendo problemas.' : 'Parece que ha habido algún error.';
});
</script>

<template>
    <Head>
        <title>
            Error {{ status }}
        </title>
        <meta name="description" content="Página de error">
    </Head>
    <error-layout>
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 md:text-5xl my-5 md:my-10">
            ERROR {{ status }}
        </h1>
        <p class="mb-5 md:mb-10 text-lg md:text-2xl leading-7 text-gray-800 text-center">
            {{ message }}
        </p>
        <img src="/error/error-gif.gif" class="m-auto mb-5 md:mb-10 w-80" alt="Gif error cine">
        <div class="flex items-center justify-center">
            <Link :href="route('/')" class="hover:text-flamingo hover:bg-black bg-flamingo px-3.5 py-2.5 text-sm font-semibold text-white">
                Ir a inicio &rarr;
            </Link>
        </div>
        <img src="/images/logo.png" class="w-60 my-5 md:my-10" alt="Logo FilmXtra">
    </error-layout>
</template>
