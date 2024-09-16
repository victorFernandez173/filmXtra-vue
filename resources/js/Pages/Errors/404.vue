<script setup>
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
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
        <img src="/images/logo-error.png" class="m-auto w-[150px] md:w-[300px] my-6 md:my-10" alt="Logo Error 404">
        <p class="mb-6 md:mb-10 text-lg lg:text-2xl leading-7 text-gray-800 text-center">
            {{ msg }}
        </p>
        <img src="/error/error-gif.gif" class="mx-auto mb-6 md:mb-10 w-80" alt="Gif error cine">
        <div class="flex items-center justify-center">
            <Link :href="route('/')" class="hover:text-flamingo hover:bg-black bg-flamingo px-3.5 py-2.5 text-sm font-semibold text-white">
                {{ inicio }}&rarr;
            </Link>
        </div>
        <img src="/images/logo.png" class="m-auto lg:w-60 my-6 md:my-10" alt="Logo FilmXtra">
    </error-layout>
</template>
