<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{ __('general.web.product.product') }}
        </template>
        <template v-slot:body>
            <div>
                <table v-if="!__isEmpty(product)">
                    <ul class="modal__tabs dark:border-gray-700">
                        <li class="mr-2">
                            <a @click="setTab(1)" aria-current="page" v-bind:class="getTabPage1">{{
                                __('general.web.product.information')
                            }}</a>
                        </li>
                        <li class="mr-2">
                            <a @click="setTab(2)" aria-current="page" v-bind:class="getTabPage2">{{
                                __('general.web.product.images')
                            }}</a>
                        </li>
                    </ul>
                    <div v-if="tab == 1">
                        <tr class="mt-5">
                            <td class="label-table">Id</td>
                            <td>{{ product.id }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.sku') }}</td>
                            <td>{{ product.sku }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.name_es') }}</td>
                            <td>{{ product.name_es }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.description_es') }}</td>
                            <td>{{ product.description_es }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.name_en') }}</td>
                            <td>{{ product.name_en }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.description_en') }}</td>
                            <td>{{ product.description_en }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.price') }}</td>
                            <td>{{ product.price }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.stock') }}</td>
                            <td>{{ product.stock }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.taxes') }}</td>
                            <td>{{ product.taxes }}</td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.category.category') }}</td>
                            <td>
                                {{ product.categories[0]['name_' + __locale()] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label-table">{{ __('general.web.product.status') }}</td>
                            <td>{{ __('general.web.product.' + product.status) }}</td>
                        </tr>
                        <div class="mt-5 flex justify-center">
                            <a
                                @click="setTab(2)"
                                class="modal-previous-next dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                {{ __('general.web.next') }} >
                            </a>
                        </div>
                    </div>
                    <div v-if="tab == 2">
                        <div v-for="(image, index) in images" :key="index">
                            <tr v-if="!__isEmpty(image)" class="mt-5 mb-10">
                                <td class="label-table">{{ __('general.web.product.image') + ' ' + (index + 1) }}</td>
                                <td>
                                    <div>
                                        <img class="mb-2 w-2/4" v-bind:src="__asset(image['url'])" />
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                </table>
                <div v-if="tab == 2">
                    <div class="mt-3 p-2 text-center">
                        <a
                            @click="setTab(1)"
                            class="modal-previous-next dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <{{ __('general.web.previous') }}
                        </a>
                        <button
                            @click="close()"
                            class="border rounded border-orangePantone px-6 py-2 font-bold text-orangePantone"
                        >
                            {{ __('general.web.close') }}
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script>
import Modal from '../../utils/Modal';
import axios from 'axios';

export default {
    name: 'ProductShow.vue',
    components: {
        Modal,
    },
    props: {
        isOpenShow: Boolean,
        product: Object,
    },
    data() {
        return {
            categories: [],
            tab: 1,
            images: [{}, {}, {}, {}, {}],
        };
    },

    mounted() {
        this.getAllCategories();
    },
    computed: {
        getTabPage1: function () {
            return {
                'active-tab active dark:bg-dimgray dark:text-orangePantone': this.tab === 1,
                'inactive-tab dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300': this.tab !== 1,
            };
        },
        getTabPage2: function () {
            return {
                'active-tab active dark:bg-dimgray dark:text-orangePantone': this.tab === 2,
                'inactive-tab dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300': this.tab !== 2,
            };
        },
    },
    emits: ['close'],

    methods: {
        setTab(tab) {
            this.tab = tab;
        },
        close: function () {
            this.$emit('close');
        },
        getAllCategories: function () {
            axios
                .get('/evertec/mercatodo/public/api/admin/categories')
                .then((response) => (this.categories = response.data.categories.data));
        },
    },

    watch: {
        show: function (newVal, oldVal) {
            this.isOpenShow = newVal;
        },
        isOpenShow: function (newVal, oldVal) {
            this.tab = 1;
        },
        product: function (newVal, oldVal) {
            this.images = [{}, {}, {}, {}, {}];
            this.product.images.map((image, index) => {
                this.images[index] = image;
            });
        },
    },
};
</script>
