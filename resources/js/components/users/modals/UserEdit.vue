<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{ __('general.web.user.edit-user') }}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td>Id</td>
                        <td>{{ user.id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.name') }}</td>
                        <td>
                            <input type="text" v-model="user.name" />
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.email') }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('general.web.user.role') }}</td>
                        <td>
                            <select v-model="user.role" class="focus:outline-none">
                                <option value="">{{ __('general.web.user.' + user.role) }}</option>
                                <option value="administrator">{{ __('general.web.user.administrator') }}</option>
                                <option value="client">{{ __('general.web.user.client') }}</option>
                                <option value="stock_assistant">{{ __('general.web.user.stock_assistant') }}</option>
                                <option value="financial_assistant">
                                    {{ __('general.web.user.financial_assistant') }}
                                </option>
                                <option value="logistic_assistant">
                                    {{ __('general.web.user.logistic_assistant') }}
                                </option>
                                <option value="marketing_assistant">
                                    {{ __('general.web.user.marketing_assistant') }}
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>

                <div class="mt-3 p-2 text-center">
                    <button
                        @click="isOpenEdit = false"
                        class="border rounded border-orangePantone px-6 py-2 font-bold text-orangePantone"
                    >
                        {{ __('general.web.close') }}
                    </button>
                    <button class="rounded ml-2 bg-orangePantone px-6 py-2 text-white" v-on:click="update">
                        {{ __('general.web.save') }}
                    </button>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script>
import axios from 'axios';
import Modal from '../../utils/Modal';

export default {
    components: {
        Modal,
    },
    props: {
        edit: Boolean,
        user: Object,
    },
    emits: ['close'],
    data() {
        return {
            isOpenEdit: false,
        };
    },

    methods: {
        close: function () {
            this.$emit('close');
        },

        update: function () {
            axios
                .put('/evertec/mercatodo/public/api/admin/users/' + this.user.id, this.user)
                .then((response) => {
                    console.log(this.user);
                    alert(response.data.message);
                    this.close();
                })
                .catch((error) => {
                    alert(JSON.stringify(error.response.data.errors));
                });
        },
    },

    watch: {
        edit: function (newVal, oldVal) {
            this.isOpenEdit = newVal;
        },
    },
};
</script>
