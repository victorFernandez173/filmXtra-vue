<script setup>
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head>
        <title>
            Error 404
        </title>
        <meta name="description" content="Página de error">
    </Head>
    <error-layout>
        <img src="/images/logo-error.png" class="m-auto w-60 mb-10" alt="Logo Error 404">
        <p class="mt-5 mb-12 text-2xl leading-7 text-gray-800">
            La pagina que buscas no existe, lo sentimos.
        </p>
        <img src="/error/error-gif.gif" class="m-auto mt-7 w-80" alt="Gif error cine">
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <Link :href="route('/')" class="hover:text-flamingo hover:bg-black bg-flamingo px-3.5 py-2.5 text-sm font-semibold text-white">
                Ir a inicio &rarr;
            </Link>
        </div>
        <img src="/images/logo.png" class="m-auto w-60 mt-10" alt="Logo FilmXtra">
    </error-layout>
</template>
