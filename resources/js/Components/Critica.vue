<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import dayjs from "dayjs";
import relativeTime from 'dayjs/plugin/relativeTime';
import Swal from "sweetalert2";
import es from "dayjs/locale/es";

// Para las fechas relativas
dayjs.extend(relativeTime);
dayjs.locale(es);

const props = defineProps({
    'critica' : Object,
    'indice' : Number
});

// SWAL para likes sin login
function alertaDarLikeSinLogin(){
    Swal.fire({
        title: 'UPSSS!',
        text: `Regístrate y logueate para dar like`,
        imageUrl: '/gif/' + (Math.floor(Math.random() * usePage().props.nGifs) + 1) + '.gif',
        imageWidth: '80%',
        imageAlt: 'gif de cine para mensaje dar like sin login',
        confirmButtonColor: '#e37f81'
    });
}
</script>

<template>
    <div class="w-full">
        <p class="font-semibold">
            {{ critica.usuario.usuario }}:
            <span class="font-normal">
                {{ critica.critica }}
            </span>
        </p>
    </div>
    <!--Fecha relativa y likes-->
    <div class="w-full text-right mb-6 text-pink-800 text-sm md:text-base">
        <p class="inline-block">
            ({{ dayjs(critica.modificada).fromNow() }}) Likes: {{ critica.likes_count }} &nbsp;
        </p>
        <Link v-if="$page.props.auth.user" as="button" method="post" :href="route('darLike')" :data="{ critica_id: critica.id }" preserve-scroll>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" :fill="critica.likes.map(critica => critica.id).includes($page.props.auth.user.id) ? 'black' : 'white'" class="w-5 h-5 inline hover:fill-yellow-300 mb-1">
                <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
            </svg>
        </Link>
        <svg v-else @click="alertaDarLikeSinLogin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white" class="w-5 h-5 inline hover:fill-yellow-300 mb-1">
            <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
        </svg>
    </div>
</template>
