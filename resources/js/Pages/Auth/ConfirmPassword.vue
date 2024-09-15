<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head>
        <title>
            {{ $t('confirm_password.title') }}
        </title>
        <meta name="description" content="Pagina de confirmacion de password">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 h-screen lg:py-0">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-[95%] bg-white shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        {{ $t('confirm_password.confirmacion') }}
                    </h1>
                    <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-lg">
                        {{ $t('confirm_password.area_segura') }}
                    </h3>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <input-label for="password" :value="$t('confirm_password.label')" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password"
                                autocomplete="current-password"
                            />
                            <input-error class="mt-2" :message="form.errors.password"/>
                        </div>
                        <div class="text-center">
                            <primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ $t('confirm_password.confirmar') }}
                            </primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
