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
import {Head, Link, usePage} from "@inertiajs/vue3";
import Poster from "../Components/Poster.vue";
import Swal from "sweetalert2";
import Estrellitas from "../Components/Estrellitas.vue";
import Trailers from "../Components/Trailers.vue";

const props = defineProps(['obra', 'generos', 'reparto', 'direccion', 'mediaEvaluaciones', 'criticas', 'secuelaPrecuela', 'spinoffs', 'nGifs']);

// Configuración fechas relativas dayjs
dayjs.extend(relativeTime);
dayjs.locale(es);

// Alert para avisar que no pueder dar like sin estar registrado y logueado
function alertaDarLike() {
    Swal.fire({
        title: 'UPSSS!',
        text: `Regístrate y logueate para dar like`,
        imageUrl: '../gif/' + (Math.floor(Math.random() * usePage().props.nGifs) + 1) + '.gif',
        imageWidth: '80%',
        imageAlt: 'ocupate de arreglarlo, imagen para Regístrate y logueate para dar like',
        confirmButtonColor: '#e37f81'
    });
}

// Coloreado de los likes.
// Parametros: usuario logueado y  datos de la critica.
// Se crea un array al que le pasamos los id de los usuarios que gustan la crítica.
// Retornamos si incluye el id del usuario logueado (true): se colorea de negro pues.
function colorearManoLike($usuario, $gustadas) {
    let gustadaPorArray = []
    for(const usuario_id in $gustadas.gustadaPor){
        gustadaPorArray.push($gustadas.gustadaPor[usuario_id].usuario_id);
    }
    return gustadaPorArray.includes($usuario.id);
}
</script>

<template>
    <Head>
        <title>{{ obra.titulo }}</title>
        <meta name="description" content="Ficha general de obra">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo text-3xl px-8">{{ obra.titulo }}</h1>
        <!--3 apartados para poster, datos y valoraciones-->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-10">
            <!--Poster-->
            <div class="flex justify-start flex-col m-auto h-[100%] w-[90%]">
                <img :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt">
                <!--Puntuacion-->
                <Estrellitas :mediaEvaluaciones="parseFloat(mediaEvaluaciones.evaluaciones_avg_evaluacion).toFixed(1)" :obra="obra" :mostrar-votos="true"/>
            </div>

            <!--Datos pelicula-->
            <div class="flex justify-center mr-10 px-5 w-full md:-ml[100px]">
                <div>
                    <!--Info general-->
                    <div>
                        <ul>
                            <!--Títulos-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">Título</span>:
                                {{ obra.titulo }}
                                ({{ obra.titulo_original }})
                            </li>
                            <!--Año-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">Año</span>:
                                {{ obra.fecha }}
                            </li>
                            <!--Duración-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">Duración</span>:
                                {{ Math.floor((parseInt(obra.duracion) / 60)) }}h
                                {{ parseInt(obra.duracion) % 60 }}min
                            </li>
                            <!--País-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">País</span>:
                                {{ obra.pais }}
                            </li>
                            <!--Dirección-->
                            <li v-if="obra.directors[0]" class="ml-5">
                                <span class="font-semibold text-lg">Dirección</span>:
                                <span> {{ props.direccion }}  </span>
                            </li>
                            <!--Reparto-->
                            <li v-if="obra.actors[0]" class="
                             ml-5">
                                <span class="font-semibold text-lg">Reparto</span>:
                                <span>{{ props.reparto }} </span>
                            </li>
                            <!--Productora-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">Productora</span>:
                                {{ obra.productora }}
                            </li>
                            <!--Géneros-->
                            <li v-if="obra.generos" class="ml-5">
                                <span class="font-semibold text-lg">Género</span>:
                                <span> {{ props.generos }} </span>
                            </li>
                            <!--Sinopsis-->
                            <li class="ml-5">
                                <span class="font-semibold text-lg">Sinopsis</span>:
                                {{ obra.sinopsis }}
                            </li>
                        </ul>
                    </div>
                    <!--Festivales y premios-->
                    <div class="mt-4">
                        <ul>
                            <li v-if="obra.festivals.length > 0" class="font-bold text-flamingo text-xl list-none">
                            Galardones
                            </li>
                            <li>
                                <ul>
                                    <li v-for="fest in obra.festivals" class="ml-5">
                                        <span class="font-semibold text-lg">Mejor película</span>:
                                        {{ fest.nombre }}({{ fest.edicion }})
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--Saga-->
                    <div class="mt-4">
                        <span v-if="secuelaPrecuela || spinoffs" class="font-bold text-flamingo text-xl mt-2">
                            Saga
                        </span>
                        <!-- Bloque para secuela/precuela -->
                        <div v-if="secuelaPrecuela" class="text-center flex flex-col items-center">
                            <div v-for="obra in secuelaPrecuela" class="w-[80%] md:w-[70%]">
                                <p class="mt-2 -mb-3">
                                    {{props.obra.secuela.orden === 0 ? 'Relación' : obra.secuela.orden < props.obra.secuela.orden ? 'Precuela' : 'Secuela'}}
                                </p>
                                <Poster :obra="obra" :titulo="`text-lg hover:text-sm md:text-base md:hover:text-base`" :info="true"/>
                            </div>
                        </div>
                        <!-- Bloque para spin-offs -->
                        <div v-if="spinoffs" class="text-center flex flex-col items-center">
                            <div v-for="obra in spinoffs" class="w-[80%] md:w-[70%]">
                                <p class="mt-2 -mb-3">
                                    {{props.obra.secuela.orden === 0 ? 'Relación' : 'Spinoff'}}
                                </p>
                                <Poster :obra="obra" :info="true"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Contenedor criticas-->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-10 mb-15 justify-center bg-flamingo text-white lg:divide-x md:divide-x divide-y ">
            <!--Criticas-->
            <div class="py-10 pr-10 pl-12 lg:col-span-3 md:col-span-2">
                <!--Titulo-->
                <ul>
                    <li v-if="obra.profesionals.length > 0" class="list-none font-bold text-black text-xl mb-5">
                        Críticas profesionales
                    </li>
                </ul>
                <ul v-for="p in obra.profesionals">
                    <!--Críticas profesionales-->
                    <li class="ml-5 mb-4">
                        <span class="font-semibold">
                            <a class="hover:text-black" :href="p.medio.web" target="_blank">
                                {{ p.medio.nombre }}
                            </a>:
                        </span>
                        {{ p.contenido }}
                        <span class="italic">{{ p.autor }}
                        </span>
                        <span v-if="p.fecha">
                            ({{ dayjs(p.fecha).fromNow() }})
                        </span>
                    </li>
                </ul>
                <!--Titulo-->
                <ul>
                    <li class="list-none font-bold text-black text-xl mt-10 mb-5">
                        Críticas de nuestros usuarios
                    </li>
                </ul>
                <ul v-for="(critica, indice) in criticas">
                    <!--Críticas usuarios-->
                    <li v-if="indice < 2" class="ml-5 mb-4">
                        <span class="font-semibold">
                            {{ critica.usuario.usuario }}
                        </span>
                        : {{ critica.critica }} ({{ dayjs(critica.fecha).fromNow() }}) - Likes: {{ critica.likes_count }}

                        <!--Mano arriba-->
                        <Link v-if="$page.props.auth.user" class="inline-block" as="button" method="post"
                              :href="route('darLike')"
                              :data="{ usuario_id: $page.props.auth.user.id, critica_id: critica.id_critica }"
                              preserveScroll>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 :fill="colorearManoLike($page.props.auth.user, $page.props.criticas) ? 'black' : 'white'"
                                 class="w-5 h-5 inline-block hover:fill-yellow-300">
                                <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                            </svg>
                        </Link>
                        <svg v-else @click="alertaDarLike" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="white"
                             class="w-5 h-5 inline-block hover:fill-yellow-300">
                            <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                        </svg>
                    </li>
                </ul>
                <p class="ml-5">[...]</p>
                <p v-if="!criticas[0]" class="py-3">Sin críticas de usuarios todavía. Participa, pon la
                    tuya.</p>
                <div class="mx-auto w-fit text-center mt-8 bg-white text-flamingo hover:bg-black px-5 py-2.5">
                    <Link :href="route('obraValoraciones', obra.titulo_slug)"
                          class="my-5 m-auto font-bold focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none text-sm"
                          preserve-scroll>
                        Ir a criticas de {{ obra.titulo }}&rarr;
                    </Link>
                </div>
            </div>

            <!--Seccion valorar-->
            <div class="py-5 pl-10 pr-10">
                <!--Titulo-->
                <h3 class="font-bold text-black text-xl my-5 text-center">¿Quieres valorar esta
                    película?</h3>
                <h4>En FilmXtra nos apasiona el cine y queremos escuchar tu voz. ¡Exprésate como quieras!</h4>
                <ul class="ml-[20px]">
                    <li class="list-disc ml-2">Puedes ponerle una puntuación del 1 al 10 a las películas que veas.</li>
                    <li class="list-disc ml-2">Si te gusta entrar en detalles, déjanos tus críticas más elaboradas. ¡Suelta todo lo que
                        piensas!
                    </li>
                    <li class="list-disc ml-2">Y, por supuesto, dale un buen "like" a las críticas de otros usuarios que te parezcan geniales.
                        ¡Comparte el amor cinéfilo!
                    </li>
                </ul>
                <p class="pt-7">¡Tu voz cinéfila importa! Exprésate libremente y comparte el amor por el cine.</p>
                <div class="mt-10 text-center bg-white text-flamingo hover:bg-black px-5 text-sm py-2.5">
                    <Link :href="route('valoracionesTop')"
                          class="my-15 m-auto focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold block w-4/6"
                          preserve-scroll>
                        Top Valoraciones &rarr;
                    </Link>
                </div>
            </div>
        </div>

        <!-- Componente para el trailer-->
        <Trailers :obra="obra"/>
    </div>
</template>
