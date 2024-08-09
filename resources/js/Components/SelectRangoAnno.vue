<!--Componente que recibe un int (rango de años) y un int (año tope) y genera un select que ofrece todos los años desde el año tope (no incluido) hacia atras: rango=>4; tope=>2000 => 1996, 1997, 1998, 1999-->
<script setup>
import {ref} from "vue";

const props = defineProps({
    rangoAnnos : Number,
    limiteSuperior : Number,
    filtro: String
});

const emit = defineEmits(['emision']);
const valorSelect = ref(props.filtro);
emit('emision', valorSelect);
</script>

<template>
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select v-model="valorSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value=""><slot></slot></option>
            <option v-for="n in rangoAnnos">{{ limiteSuperior - n }}</option>
        </select>
    </div>
</template>
