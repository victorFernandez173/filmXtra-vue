<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectConsulta from "./SelectConsulta.vue";
import {useForm, Link} from '@inertiajs/vue3';
import SelectRangoAnno from "./SelectRangoAnno.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

// Formulario
const form = useForm({
    genero: '',
    pais: '',
    desde: '',
    hasta: '',
});

// Entrega del formulario
const submit = () => {
    form.get(route('top'), {preserveState: true});
};

// Props
const props = defineProps({
    generos: Object,
    paises: Object,
    pionera: String
})

const peliPionera = parseInt((new Date().getFullYear()).toString()) - parseInt(props.pionera) + 1;
const annoActual = (new Date().getFullYear() + 1);
</script>

<template>
    <form @submit.prevent="submit" class="m-auto flex">
        <div class="m-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 hover:[&>div>select]:cursor-pointer">
            <!-- Selects-->
            <div>
                <SelectConsulta :consulta="generos" :valor="`genero`" @emision="(e) => form.genero = e">Género
                </SelectConsulta>
            </div>
            <div>
                <SelectConsulta :consulta="paises" :valor="`pais`" @emision="(e) => form.pais = e">País
                </SelectConsulta>
            </div>
            <div>
                <SelectRangoAnno :limite-inferior="peliPionera" :limite-superior="annoActual" @emision="(e) => form.desde = e">Desde
                </SelectRangoAnno>
            </div>
            <div>
                <SelectRangoAnno :limite-inferior="peliPionera" :limite-superior="annoActual" @emision="(e) => form.hasta = e">Hasta
                </SelectRangoAnno>
            </div>

            <!-- Botones -->
            <div class="flex pt-2.5 pb-3 md:col-span-2 lg:col-span-1">
                <PrimaryButton :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    FILTRA
                </PrimaryButton>
                <SecondaryButton class="">
                    <Link :href="route('top')">
                        RESET
                    </Link>
                </SecondaryButton>
            </div>
        </div>
    </form>
</template>
