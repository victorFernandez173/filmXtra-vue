<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'generos' : Array,
    'paises' : Array,
    'decadas' : Array,
})
</script>

<template>
    <section class="h-full bg-flamingo p-4 pb-8 hover:[&>ul>li]:text-white [&>ul>li]:truncate">
        <!-- Genero -->
        <h5 class="mt-3 font-bold underline">Género</h5>
        <ul>
            <li v-for="genero in generos">
                <Link :href="route('top')" :data="{ genero: genero }">
                    {{ genero }}
                </Link>
            </li>
        </ul>

        <!-- Decada -->
        <h5 class="mt-5 font-bold underline">Década</h5>
        <ul>
            <li v-for="decada in decadas">
                <Link :href="route('top')" :data="{ desde : decada.toString(), hasta : (decada+9) }">
                    {{ `${decada}s` }}
                </Link>
            </li>
        </ul>

        <!-- Pais -->
        <h5 class="mt-6 font-bold underline">País</h5>
        <ul>
            <li v-for="pais in paises">
                <Link :href="route('top')" :data="{ pais : pais }">
                    {{ pais }}
                </Link>
            </li>
        </ul>
    </section>
</template>
