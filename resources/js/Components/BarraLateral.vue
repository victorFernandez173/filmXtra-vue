<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <section class="h-full bg-flamingo p-4 pb-8 hover:[&>ul>li]:text-white [&>ul>li]:overflow-ellipsis [&>ul>li]:overflow-hidden">
        <!-- Genero -->
        <h5 class="py-4 font-bold underline">Género</h5>
        <ul>
            <li>
                <Link :href="route('top')" :data="{ genero : 'acción' }">
                    Acción
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'aventuras' }">
                    Aventuras
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'biográfico' }">
                    Biográfico
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'bélico' }">
                    Bélico
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'ciencia ficción' }">
                    Ciencia ficción
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'cine mudo' }">
                    Cine Mudo
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'cine negro' }">
                    Cine Negro
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'comedia' }">
                    Comedia
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'cortometraje' }">
                    Cortometraje
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'crimen' }">
                    Crimen
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'deportiva' }">
                    Deportiva
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'documental' }">
                    Documental
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'drama' }">
                    Drama
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'fantástico' }">
                    Fantástico
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'historica' }">
                    Histórica
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'infantil' }">
                    Infantil
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'intriga' }">
                    Intriga
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'musical' }">
                    Musical
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'policiaca' }">
                    Policiaca
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'propagandístico' }">
                    Propagandístico
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'película de culto' }">
                    Película de culto
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'road movie' }">
                    Road Movie
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'romance' }">
                    Romance
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'terror' }">
                    Terror
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'thriller' }">
                    Thriller
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ genero : 'western' }">
                    Western
                </Link>
            </li>
        </ul>

        <!-- Decada -->
        <h5 class="py-4 font-bold underline">Década</h5>
        <ul>
            <li>
                <Link :href="route('top')" :data="{ desde : '2010', hasta : '2019' }">
                    2010s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '2000', hasta : '2009' }">
                    2000s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1990', hasta : '1999' }">
                    90s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1980', hasta : '1989' }">
                    80s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1970', hasta : '1979' }">
                    70s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1960', hasta : '1969' }">
                    60s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1950', hasta : '1959' }">
                    50s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1940', hasta : '1949' }">
                    40s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1930', hasta : '1939' }">
                    30s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1920', hasta : '1929' }">
                    20s
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ desde : '1900', hasta : '1910' }">
                    00s
                </Link>
            </li>
        </ul>

        <!-- Pais -->
        <h5 class="py-4 font-bold underline">País</h5>
        <ul>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Alemania' }">
                    Alemania
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Australia' }">
                    Australia
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'España' }">
                    España
                </Link>
            </li>
            <li>
                <div id="tio">
                  <Link :href="route('top')" :data="{ pais : 'Estados Unidos de America' }">
                      Estados Unidos de América
                  </Link>
                </div>

            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Francia' }">
                    Francia
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Italia' }">
                    Italia
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Japón' }">
                    Japón
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Nueva Zelanda' }">
                    Nueva Zelanda
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'Reino Unido' }">
                    Reino Unido
                </Link>
            </li>
            <li>
                <Link :href="route('top')" :data="{ pais : 'USSR' }">
                    USSR
                </Link>
            </li>
        </ul>
    </section>
</template>
