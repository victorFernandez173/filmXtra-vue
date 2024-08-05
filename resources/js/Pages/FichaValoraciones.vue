<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<script setup>
import dayjs from "dayjs";
import es from "dayjs/locale/es";
import relativeTime from 'dayjs/plugin/relativeTime';
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import Estrellitas from "../Components/Estrellitas.vue";
import SelectRango from "../Components/SelectRango.vue";
import PaginacionSimple from "../Components/PaginacionSimple.vue";
import Swal from "sweetalert2";

const page = usePage();
const props = defineProps(['obra', 'mediaEvaluaciones', 'profesionales', 'criticas', 'pelicula_criticas', 'pelicula_evaluaciones', 'nGifs']);

// Para las fechas relativas
dayjs.extend(relativeTime);
dayjs.locale(es);

// Formularios y sus campos dinámicos
// Crítica
const form = useForm({
    user_id: '',
    obra_id: '',
    critica: '',
});
// Evaluación
const form2 = useForm({
    usuario_id: '',
    obra_id: '',
    evaluacion: '',
});

// SWAL para likes sin login
function alertaDarLikeSinLogin(){
    Swal.fire({
        title: 'UPSSS!',
        text: `Regístrate y logueate para dar like`,
        imageUrl: '/gif/' + (Math.floor(Math.random() * page.props.nGifs) + 1) + '.gif',
        imageWidth: '80%',
        imageAlt: 'gif de cine para mensaje dar like sin login',
        confirmButtonColor: '#e37f81'
    });
}
</script>

<template>
    <Head>
        <title>Valoraciones: {{ obra.titulo }}</title>
        <meta name="description" content="Ficha valoraciones obra">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo text-3xl w-11/12 mx-auto">{{ obra.titulo }}</h1>
        <!--2 bloque para poster, criticas usuarios-->
        <div class="grid grid-cols-1 lg:grid-cols-4 mt-10">
            <div>
                <!--Poster-->
                <div class="w-full flex justify-center flex-wrap items-center">
                    <img class="w-11/12 sm:w-8/12 lg:w-[98%]" :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt">
                    <Estrellitas class="w-full mb-1" :mediaEvaluaciones="mediaEvaluaciones.evaluaciones_avg_evaluacion" :obra="obra"/>
                    <p class="text-black text-center"> &nbsp;&nbsp;
                        {{ parseFloat(mediaEvaluaciones.evaluaciones_avg_evaluacion).toFixed(1) }}/10 ({{ obra.evaluaciones.length }}
                    </p>
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                    </svg>
                    )
                </div>
                <!--Boton para llevarte a la pagina de datos de la película-->
                <div class="flex justify-center mx-auto w-11/12 lg:w-full mb-7 lg:mb-0">
                    <Link :href="route('obra', obra.titulo_slug)"
                          class="text-black hover:text-flamingo bg-flamingo hover:bg-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 mt-5 text-center">
                        &larr; Ficha {{ obra.titulo }}
                    </Link>
                </div>
            </div>

            <!--Criticas-->
            <div class="w-11/12 mx-auto lg:mr-0 col-span-3 flex flex-wrap bg-flamingo">
                <!--Titulo usuarios-->
                <div>
                    <div class="flex flex-wrap pt-5 pb-12">
                        <div class="w-full px-10">
                            <ul>
                                <li class="font-bold text-xl mt-10 mb-5">Críticas de nuestros
                                    usuarios:
                                </li>
                            </ul>
                        </div>
                        <div class="px-10">
                            <ul v-for="(cri, i) in criticas.data">
                                <!--Críticas usuarios-->
                                <li class="list-disc ml-5 mb-4 text-white text-right">
                                    <p class="font-semibold text-left">
                                        {{ cri.usuario.nombre }}:
                                        <span class="font-normal">
                                            {{ cri.critica }}
                                        </span>
                                    </p>
                                    <p class="inline-block">
                                        ({{ dayjs(cri.modificada).fromNow() }}) - Likes: {{ cri.likes_count }} &nbsp;
                                    </p>

                                    <!--Mano arriba-->
                                    <Link v-if="$page.props.auth.user" as="button" method="post"
                                          :href="route('darLike')"
                                          :data="{ usuario_id: $page.props.auth.user['id'], critica_id: cri.id }"
                                          preserveScroll>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             :fill=" $page.props.criticas.data[i].likes.map(critica => critica.id).includes($page.props.auth.user.id) ? 'black' : 'white'"
                                             class="w-5 h-5 inline hover:fill-yellow-300 mb-1">
                                            <path
                                                d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                                        </svg>
                                    </Link>
                                    <svg v-else @click="alertaDarLikeSinLogin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="white"
                                         class="w-5 h-5 inline hover:fill-yellow-300 mb-1">
                                        <path
                                            d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                                    </svg>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="w-full flex justify-center self-end mt-5">
                    <PaginacionSimple :datos="criticas" />
                </div>
            </div>

            <!-- Sección formularios container-->
            <div class="col-span-1 lg:col-span-4 mt-5 bg-flamingo container">
                <div v-if="$page.props.auth.user" class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 p-1">
                    <!-- Formulario evas -->

                    <form @submit.prevent="form2.post(route('evaluar'),
                                {
                                        preserveScroll: true,
                                        })"
                        class="col-span-1 md:col-span-3 lg:col-span-2 flex justify-center flex-wrap p-1 border-b md:border-r md:border-b-0 content-center">

                        <div class="w-full text-center">
                            <label class="font-bold text-xl text-white">Evaluar: </label>
                        </div>
<!--           //////////////////////////////////////////////////////////////////////////////////             -->
<!--                        <p v-if="existeLaEvaluacionBandera" class="text-center text-xs">(Ya has evaluado esta película, puedes modificar tu evaluación):</p>-->
                        <!--           //////////////////////////////////////////////////////////////////////////////////             -->
                        <div class="w-full">
                            <SelectRango class="w-2/5 sm:w-1/4 md:w-3/4 text-center" :limite="11"
                                         :valor="'Nota'"
                                         @emision="(e) => form2.evaluacion = e">
                            </SelectRango>
                        </div>
                        <div class="w-full text-center">
                            <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto">
                                {{ $page.props.errors['evaluacion'] }}
                            </p>
                            <!--           //////////////////////////////////////////////////////////////////////////////////             -->
<!--                            <p v-if="form2.recentlySuccessful">{{  existeLaEvaluacionVarComputed }}</p>-->
                            <!--           //////////////////////////////////////////////////////////////////////////////////             -->
                        </div>
                        <div class="w-full text-center">
                            <button
                                @click="form2.usuario_id = $page.props.auth.user.id; form2.obra_id = obra.id"
                                class="w-2/5 sm:w-1/4 md:w-3/4 text-flamingo bg-white hover:bg-black font-bold text-sm px-5 py-2.5 my-2 text-center">
                                Evaluar {{ obra.titulo }} &rarr;
                            </button>
                        </div>
                    </form>
                    <!-- Formulario críticas -->
                    <div
                        class="col-span-1 md:col-span-9 lg:col-span-10 p-1 lg:ml-1 flex justify-center flex-wrap">
                        <label class="w-full text-center font-bold text-xl mt-3 text-white">Reseña
                            {{ obra.titulo }}
                            <span
                                :class="[form.critica.length > 5000 ? 'text-yellow-300  font-bold' : 'text-white']">({{
                                    form.critica.length
                                }}/5000 caracteres){{
                                    form.critica.length > 5000 ? ' Máximo de caracteres sobrepasado' : ''
                                }}
                            </span>
                        </label>
                        <!--           //////////////////////////////////////////////////////////////////////////////////             -->
<!--                        <p v-if="existeLaCriticaBandera" class="text-center text-xs">(Ya has reseñado esta película, puedes modificar tu crítica):</p>-->
                        <!--           //////////////////////////////////////////////////////////////////////////////////             -->
                        <form
                            @submit.prevent="form.post(
                                route('criticar'),
                                {
                                        preserveScroll: true,
                                        })"
                            class="w-11/12 text-center">
                            <textarea class="w-full h-[200px] m-1 focus:border-black focus:border-[3px] focus:ring-0" v-model="form.critica"></textarea>
                            <div class="w-full text-center">
                                <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto">
                                    {{ $page.props.errors['critica'] }}</p>
                                <p class="invisible" v-if="form.recentlySuccessful">{{ existeLaCriticaVarComputed }}</p>
                            </div>
                            <button
                                @click="form.user_id = $page.props.auth.user['id']; form.obra_id = obra[0]['id']"
                                class="w-2/5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                                Reseñar {{ obra.titulo }} &rarr;
                            </button>
                        </form>

                    </div>
                </div>
                <div v-else class="grid grid-cols-1 p-10 font-bold text-white text-3xl text-center">
                    Para poder evaluar o poner notas a la película tienes que estar logueado.
                    <Link as="button" :href="route('login')"
                          class="m-auto mt-5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                        Loguearse
                    </Link>
                    <img src="/images/logo-blanco.png" class="w-40 pt-5 m-auto" alt="Logo de la web">
                </div>
            </div>
        </div>
    </div>
</template>



