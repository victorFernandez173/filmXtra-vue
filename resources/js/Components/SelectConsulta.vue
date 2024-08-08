<script setup>
import {ref} from "vue";

const props = defineProps({
    consulta : Object,
    filtro : String
});

// Para la emision a componentes padre
const emit = defineEmits(['emision']);
const valorSelect = ref(props.filtro);
emit('emision', valorSelect);

</script>

<template>
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select v-model="valorSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value="">
                <slot />
            </option>
            <option v-for="elemento in consulta">
                {{elemento}}
            </option>
        </select>
    </div>
</template>

