<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import NavBar from "@/Components/NavBar.vue";
import Footer from "@/Components/Footer.vue";

// Para montar componentes Flowbite
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div class="min-h-[100vh] flex flex-col">

        <!-- Barra de navegacion -->
        <nav-bar/>

        <slot />

        <!-- Pie de pagina -->
        <Footer/>
    </div>
</template>

<!--Estilo esquinas 90º para swal-->
<style>
    .swal2-popup .swal2-styled.swal2-confirm {
        border-radius: 0 !important;
    }
    .swal2-popup {
        border-radius: 0 !important;
    }
</style>
