<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectConsulta from "./SelectConsulta.vue";
import {useForm, Link, router} from '@inertiajs/vue3';
import SelectRangoAnno from "./SelectRangoAnno.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    'paises' : Array,
    'generos' : Array,
    'pionera' : Number,
    'filtros' : Object
});

// Formulario
const form = useForm({
    genero: '',
    pais: '',
    desde: '',
    hasta: '',
});
// Entrega del formulario
const submit = () => {
    form.get(route('top'),
        {
            preserveState: false
        }
    );
};

const resetearFiltros = () => {
    router.get(route('top'));
}

// Calculamos el rango de años a partir de la pelicula más vieja
const rangoAnnos = parseInt((new Date().getFullYear()).toString()) - parseInt(props.pionera) + 1;
const annoActual = (new Date().getFullYear() + 1);
</script>

<template>
    <form @submit.prevent="submit" class="m-auto flex">
        <div class="m-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 hover:[&>div>select]:cursor-pointer">
            <!-- Selects-->
            <div>
                <select-consulta :consulta="generos" :filtro="filtros.genero" @emision="(e) => form.genero = e">
                    {{ $t('form_filtrado.genero') }}
                </select-consulta>
            </div>
            <div>
                <select-consulta :consulta="paises" :filtro="filtros.pais" @emision="(e) => form.pais = e">
                    {{ $t('form_filtrado.pais') }}
                </select-consulta>
            </div>
            <div>
                <select-rango-anno :filtro="filtros.desde" :rango-annos="rangoAnnos" :limite-superior="annoActual" @emision="(e) => form.desde = e">
                    {{ $t('form_filtrado.desde') }}
                </select-rango-anno>
            </div>
            <div>
                <select-rango-anno :filtro="filtros.hasta" :rango-annos="rangoAnnos" :limite-superior="annoActual" @emision="(e) => form.hasta = e">
                    {{ $t('form_filtrado.hasta') }}
                </select-rango-anno>
            </div>

            <!-- Botones -->
            <div class="flex pt-2.5 pb-3 md:col-span-2 xl:col-span-1">
                <primary-button :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    {{ $t('form_filtrado.filtra') }}
                </primary-button>
                <secondary-button @click="resetearFiltros">
                    <Link :href="route('top')">
                        {{ $t('form_filtrado.reset') }}
                    </Link>
                </secondary-button>
            </div>
        </div>
    </form>
</template>
