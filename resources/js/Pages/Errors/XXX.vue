<script setup>
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    status: Number,
    title: String,
    h1: String,
    msg: String,
    inicio: String,
});

</script>

<template>
    <Head>
        <title>
            {{ title }}
        </title>
        <meta name="description" content="Página de error">
    </Head>
    <error-layout>
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 md:text-5xl my-5 md:my-10">
            {{ h1 }}
        </h1>
        <p class="mb-5 md:mb-10 text-lg md:text-2xl leading-7 text-gray-800 text-center">
            {{ msg }}
        </p>
        <img src="/error/error-gif.gif" class="m-auto mb-5 md:mb-10 w-80" alt="Gif error cine">
        <div class="flex items-center justify-center">
            <Link :href="route('/')" class="hover:text-flamingo hover:bg-black bg-flamingo px-3.5 py-2.5 text-sm font-semibold text-white">
                {{ inicio }} &rarr;
            </Link>
        </div>
        <img src="/images/logo.png" class="w-60 my-5 md:my-10" alt="Logo FilmXtra">
    </error-layout>
</template>
