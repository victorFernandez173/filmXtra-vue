<script>
import LayoutPrincipal from "../../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const userLoginTipo = usePage().props.auth.user.login_tipo_id;
</script>

<template>

    <Head>
        <title>Perfil</title>
        <meta name="description" content="Página de cuenta de usuario">
    </Head>

    <auth-layout>
        <div class="py-12 flex flex-col items-center">

            <div class="mb-2 p-4 max-w-fit bg-white shadow rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Perfil</h2>
            </div>

            <div :class="userLoginTipo === 1 ? 'lg:grid-cols-2' : 'lg:grid-cols-1'" class="w-full lg:w-fit grid grid-cols-1 my-2 p-4 sm:p-8 bg-white shadow lg:rounded-lg text-center justify-items-center">
                <update-profile-information-form
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="my-4 mx-16 w-4/5 sm:w-3/5 lg:w-4/5"
                />

                <update-password-form v-if="userLoginTipo === 1" class="mt-24 lg:mt-4 mx-16 w-4/5  sm:w-3/5 lg:w-4/5" />
            </div>

            <div class="w-full lg:w-fit my-4 p-4 sm:p-8 bg-white shadow lg:rounded-lg text-center">
                    <delete-user-form class="m-4" />
            </div>
        </div>
    </auth-layout>

</template>
