<script setup>
const props = defineProps({
    'citaInspiring' : String,
    'citaQuotable': String,
    'citaPelicula': String,
    'citaCine': String
});
</script>

<template>
    <!-- Seccion Principal Carrusel -->
    <div id="default-carousel" class="relative w-full bg-flamingo" data-carousel-interval="7000" data-carousel="slide">
        <!-- Diapositivas del carrusel -->
        <div class="fotos relative h-56 overflow-hidden md:h-96 [&>div>div>div>p]:text-gray-800 [&>div>div>div>p]:text-center">
            <!-- Primera -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/carrusel1.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-49" alt="primera diapositiva">
            </div>
            <!-- Segunda -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-flamingo flex flex-col justify-center items-center text-base lg:text-xl">
                    <div class="px-[40px] py-[10px] w-[100%] h-4/6 lg:py-[20px] lg:w-9/12 lg:h-3/6 bg-white flex flex-col justify-center items-center">
                        <h1 class="font-oswald font-semibold mb-2 text-lg lg:text-2xl">{{$t('carrusel.en_el_cine')}}</h1>
                        <p class="text-ellipsis overflow-hidden">{{citaPelicula}}</p>
                    </div>
                </div>
            </div>
            <!-- Tercera -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/carrusel2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="tercera diapositiva">
            </div>
            <!-- Cuarta -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-flamingo flex flex-col justify-center items-center text-base lg:text-xl">
                    <div class="px-[40px] py-[10px] w-[100%] h-4/6 lg:py-[20px] lg:w-9/12 lg:h-6/6 bg-white flex flex-col justify-center items-center">
                        <h1 class="font-oswald font-semibold mb-2 text-lg lg:text-2xl">{{$t('carrusel.sobre_el_cine')}}</h1>
                        <p class="text-ellipsis overflow-hidden">{{citaCine}}</p>
                    </div>
                </div>
            </div>
            <!-- Quinta -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/carrusel3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="quinta diapositiva">
            </div>
            <!-- Sexta -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-flamingo flex flex-col justify-center items-center text-base lg:text-xl">
                    <div class="px-[40px] py-[10px] w-[100%] h-4/6 lg:py-[20px] lg:w-9/12 lg:h-3/6 bg-white flex flex-col justify-center items-center">
                        <h1 class="font-oswald font-semibold mb-2 text-lg lg:text-2xl">{{$t('carrusel.inspirate')}}</h1>
                        <p class="text-ellipsis overflow-hidden" v-html="citaInspiring"></p>
                    </div>
                </div>
            </div>
            <!-- Septima -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/carrusel4.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="quinta diapositiva">
            </div>
            <!-- Octava -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-flamingo flex flex-col justify-center items-center text-base lg:text-xl">
                    <div class="px-[40px] py-[10px] w-[100%] h-4/6 lg:py-[20px] lg:w-9/12 lg:h-3/6 bg-white flex flex-col justify-center items-center">
                        <h1 class="font-oswald font-semibold mb-2 text-lg lg:text-2xl">{{$t('carrusel.inspirate')}}</h1>
                        <p class="text-ellipsis overflow-hidden">{{citaQuotable}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botones inferiores para desplazarte en el carrusel -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-3 left-1/2">
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 6" data-carousel-slide-to="5"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 7" data-carousel-slide-to="6"></button>
            <button type="button" class="w-3 h-3 bg-gray-800/30" aria-current="false" aria-label="Slide 8" data-carousel-slide-to="7"></button>
        </div>
        <!-- Flechas laterales para desplazarte en el carrusel -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
          <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-gray-800/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
              <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
              <span class="sr-only">Anterior</span>
          </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
          <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-gray-800/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
              <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              <span class="sr-only">Siguiente</span>
          </span>
        </button>
    </div>
</template>
