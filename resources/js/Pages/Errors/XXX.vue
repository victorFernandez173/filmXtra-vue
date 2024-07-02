<script setup>
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import {Head, Link} from "@inertiajs/vue3";

defineProps([ 'status', 'message']);
</script>

<template>
    <Head>
        <title>Error {{}}</title>
        <meta name="description" content="Página de error">
    </Head>
    <ErrorLayout>
        <div class="flex flex-col justify-center items-center bg-neutral-50/75 rounded p-20 h-[50vh] w-[50vw]">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">ERROR</h1>
            <p class="my-10 text-2xl leading-7 text-gray-800">Parece que algo ha ido mal, vuelve a inicio.</p>
            <Link :href="route('home')" class="hover:text-flamingo hover:bg-black bg-flamingo rounded-md px-3.5 py-2.5 mb-10 text-sm font-semibold text-white">Ir a inicio &rarr;</Link>
            <img src="/images/logo.png" class="w-60" alt="Logo FilmXtra">
        </div>
    </ErrorLayout>
</template>
