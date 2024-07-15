<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    if(socialId === 1){
        nextTick(() => passwordInput.value.focus());
    }
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};

// Para saber el tipo de cuenta y así determinar el tipo de borrado (cuentas o'auth no requerirán contraseña)
let socialId = usePage().props.auth.user.login_tipo_id;
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Borrar cuenta</h2>

            <p class="mt-1 text-sm text-gray-600">
                Una vez borrada, no podrás recuperar tu cuenta. Guarda los datos antes de confirmar el borrado.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Borrar cuenta</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    ¿Seguro que quieres borrar la cuenta?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Una vez borrada, no podrás recuperar tu cuenta. Guarda los datos antes de confirmar el borrado.
                </p>

                <div class="mt-6">
                    <InputLabel v-if="socialId === 1" for="password" value="Password" class="sr-only" />

                    <TextInput
                        v-if="socialId === 1"
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError v-if="socialId === 1" :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Borrar cuenta
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
