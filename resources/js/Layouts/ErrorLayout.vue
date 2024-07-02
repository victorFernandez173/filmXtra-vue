<template>
    <section class="grid h-screen place-items-center bg-white px-6 sm:py-32 lg:px-8 bg-cover bg-[url('/error/error-fondo.gif')]">
        <div class="flex flex-col justify-center items-center bg-neutral-50/75 rounded p-20 h-[80vh] w-[50vw]">
            <slot>
                <!-- Contenido del layout -->
            </slot>
        </div>
    </section>
</template>
<script setup lang="ts">
</script>
