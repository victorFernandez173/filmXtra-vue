<script setup>
const props = defineProps({
    'obra' : Object
});
</script>

<template>
        <!--Trailer-->
        <div v-if="obra.trailer" class="mt-16 flex justify-center flex-wrap w-[95%] mx-auto">
            <!-- Titulo de la seccion -->
            <h3 class="w-full text-center text-flamingo font-bold text-2xl mb-4 px-4">Trailers</h3>
            <iframe
                class="w-[100vw] h-auto aspect-video"
                :src="obra.trailer.trailers"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
            </iframe>
        </div>
</template>
