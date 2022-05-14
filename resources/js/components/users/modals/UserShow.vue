<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{ __('general.web.user.show-user') }}
        </template>
        <template v-slot:body>
            <div class="mt-4">
                <table>
                    <tr>
                        <td>Id</td>
                        <td>{{ user.id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.name') }}</td>
                        <td>{{ user.name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.email') }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.role') }}</td>
                        <td>{{__('general.web.user.'+ user.role) }}</td>
                    </tr>
                </table>

                <div class="mt-3 p-2 text-center">
                    <button
                        @click="close()"
                        class="border rounded border-orangePantone px-6 py-2 font-bold text-orangePantone"
                    >
                        {{ __('general.web.close') }}
                    </button>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script>
import Modal from '../../utils/Modal';

export default {
    props: {
        show: Boolean,
        user: Object,
    },
    components: {
        Modal,
    },
    emits: ['close'],
    data() {
        return {
            isOpenShow: false,
        };
    },

    methods: {
        close: function () {
            this.$emit('close');
        },
    },

    watch: {
        show: function (newVal, oldVal) {
            this.isOpenShow = newVal;
        },
    },
};
</script>
