<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head>
        <title>
            {{ $t('reset_password.title') }}
        </title>
        <meta name="description" content="Página para resetear password">
    </Head>

    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 h-screen lg:py-0">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-[95%] p-6 bg-white shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    {{ $t('reset_password.h2') }}
                </h2>
                <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" @submit.prevent="submit">
                    <div>
                        <input-label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $t('reset_password.email_label') }}
                        </input-label>
                        <text-input id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5" :placeholder="$t('reset_password.email_label')" v-model="form.email" />
                        <input-error class="mt-2" :message="form.errors.email"/>
                    </div>
                    <div>
                        <input-label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $t('reset_password.password_label') }}
                        </input-label>
                        <text-input type="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5"  v-model="form.password" />
                        <input-error class="mt-2" :message="form.errors.password"/>
                    </div>
                    <div>
                        <input-label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $t('reset_password.password_label') }}
                        </input-label>
                        <text-input type="password"  id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5" v-model="form.password_confirmation" />
                        <input-error class="mt-2" :message="form.errors.password_confirmation"/>
                    </div>
                    <div>
                        <primary-button type="submit" class="w-full text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium text-sm px-5 py-2.5 text-center">
                            {{ $t('reset_password.boton') }}
                        </primary-button>
                    </div>
                    <p class="text-sm font-light text-gray-500">
                        {{ $t('reset_password.tienes_cuenta') }}
                        <Link :href="route('login')" class="font-medium text-primary-600 hover:underline focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white">
                            {{ $t('reset_password.incia_sesion') }}
                        </Link>
                    </p>
                </form>
            </div>
        </div>
    </auth-layout>
</template>
