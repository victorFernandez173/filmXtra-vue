<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['obras']);
</script>

<template>
    <nav>
        <ul class="pagination">
            <li v-if="obras.current_page === 1" disabled="true">
                « Anterior
            </li>
            <li v-else>
                <Link as="button" class="mr-1 mb-1 px-4 py-3 leading-4 hover:bg-white text-base text-white bg-flamingo border-flamingo border-solid border-1 hover:text-black" :href="obras.prev_page_url" v-html="'« Anterior'" preserve-state/>
            </li>

            <li v-if="obras.next_page_url">
                <Link as="button" class="mr-1 mb-1 px-4 py-3 leading-4 hover:bg-white text-base text-white bg-flamingo border-flamingo border-solid border-1 hover:text-black" :href="obras.next_page_url" v-html="'Siguiente »'" preserve-state/>
            </li>
            <li v-else disabled="true">
                Siguiente »
            </li>
        </ul>
    </nav>
</template>
