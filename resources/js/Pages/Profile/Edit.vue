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
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head>
        <title>Perfil</title>
        <meta name="description" content="Página de cuenta de usuario">
    </Head>

    <auth-layout>
        <div class="flex flex-col items-center h-fit">

            <div class="mb-16 max-w-fit bg-white">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Perfil</h2>
            </div>

<!--            <div :class="$page.props.auth.user.login_tipo_id === 1 && $page.props.auth.user.email_verificado_fecha ? 'lg:grid-cols-2' : 'lg:grid-cols-1'" class="w-[95%] lg:w-fit grid grid-cols-1 mb-16 bg-white text-center justify-items-center">-->
<!--                <update-profile-information-form-->
<!--                    :must-verify-email="mustVerifyEmail"-->
<!--                    :status="status"-->
<!--                    class="my-4 mx-16 w-4/5 sm:w-3/5 lg:w-4/5"-->
<!--                />-->

<!--                <update-password-form v-if="$page.props.auth.user.login_tipo_id === 1 && $page.props.auth.user.email_verificado_fecha" class="m-4 mt-24 lg:mt-4 mx-16 w-4/5  sm:w-3/5 lg:w-4/5" />-->
<!--            </div>-->

            <div class="w-[95%] lg:w-fit mb-12 bg-white shadow text-center">
                    <delete-user-form class="m-4" />
            </div>
        </div>
    </auth-layout>

</template>

<style>
    .barra{
        display: none!important;
    }
    .foot{
        display: none!important;
    }
</style>
