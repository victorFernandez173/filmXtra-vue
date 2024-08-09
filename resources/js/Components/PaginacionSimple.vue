<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    'datos' : Object
});
</script>

<template>
    <nav>
        <ul class="flex m-auto">
            <li v-if="datos.current_page === 1" class="px-4 py-3  md:mr-2 text-gray-600" disabled="true">
                « Anterior
            </li>
            <li v-else>
                <Link as="button" class="px-4 py-3 hover:bg-black md:mr-2 hover:text-flamingo font-bold" :href="datos.prev_page_url" v-html="'« Anterior'" preserve-state/>
            </li>
            <li v-if="datos.next_page_url">
                <Link as="button" class="px-4 py-3 hover:bg-black hover:text-flamingo font-bold" :href="datos.next_page_url" v-html="'Siguiente »'" preserve-state/>
            </li>
            <li v-else class="px-4 py-3 mr-2 text-gray-600" disabled="true">
                Siguiente »
            </li>
        </ul>
    </nav>
</template>
