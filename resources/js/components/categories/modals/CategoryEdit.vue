<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{ __('general.web.category.edit_category') }}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td class="label-table">Id</td>
                        <td class="mx-0 md:mx-auto">{{ category.id }}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.name_es') }}</td>
                        <td>
                            <div>
                                <input
                                    name="name_es"
                                    type="text"
                                    v-model="category.name_es"
                                    class="input-table"
                                    required
                                    minlength="4"
                                    maxlength="60"
                                />
                                <error :errors="__e(errors, 'name_es')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.name_en') }}</td>
                        <td>
                            <div>
                                <input
                                    name="name_en"
                                    type="text"
                                    v-model="category.name_en"
                                    class="input-table"
                                    required
                                    minlength="4"
                                    maxlength="60"
                                />
                                <error :errors="__e(errors, 'name_en')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.type') }}</td>
                        <td>
                            <div>
                                <select name="type" class="input-table" id="type" v-model="category.type" required>
                                    <option value="">{{ __('general.web.select') }}</option>
                                    <option value="category">{{ __('general.web.category.category') }}</option>
                                    <option value="subcategory">{{ __('general.web.category.subcategory') }}</option>
                                </select>
                                <error :errors="__e(errors, 'type')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.icon') }}</td>
                        <td>
                            <div>
                                <input
                                    name="icon"
                                    type="text"
                                    v-model="category.icon"
                                    class="input-table"
                                    required
                                    minlength="5"
                                />
                                <error :errors="__e(errors, 'icon')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.status') }}</td>
                        <td>
                            <div>
                                <select
                                    name="status"
                                    class="input-table"
                                    id="status"
                                    v-model="category.status"
                                    required
                                >
                                    <option value="">{{ __('general.web.select') }}</option>
                                    <option value="active">{{ __('general.web.category.active') }}</option>
                                    <option value="inactive">{{ __('general.web.category.inactive') }}</option>
                                </select>
                                <error :errors="__e(errors, 'status')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{ __('general.web.category.outstanding_image') }}</td>
                        <td>
                            <div>
                                <img class="mb-2 w-2/4" v-bind:src="__asset(category.outstanding_image)" />
                                <button>
                                    <input
                                        name="outstanding_image"
                                        class="overflow-x-scroll"
                                        type="file"
                                        id="outstanding_image"
                                        v-on:change="onChange"
                                        accept="image/png,image/jpeg,image/jpg"
                                        required
                                    />
                                </button>
                            </div>
                            <error :errors="__e(errors, 'outstanding_image')"></error>
                        </td>
                    </tr>
                </table>
                <div class="mt-3 p-2 text-center">
                    <button
                        @click="close()"
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
import Error from '../../utils/Error';

export default {
    name: 'CategoryEdit.vue',
    components: {
        Modal,
        Error,
    },
    props: {
        isOpenEdit: Boolean,
        category: Object,
    },
    data() {
        return {
            errors: [],
        };
    },

    emits: ['close', 'getAllCategories'],

    methods: {
        onChange(e) {
            this.category.outstanding_image = e.target.files[0];
        },

        close: function () {
            this.errors = [];
            this.$emit('close');
        },

        update: function () {
            const config = {
                headers: {
                    accept: 'application/json',
                    'Accept-Language': 'en-US,en;q=0.8',
                    'Content-Type': 'multipart/form-data',
                },
            };

            let data = new FormData();
            data.append('name_es', this.category.name_es);
            data.append('name_en', this.category.name_en);
            data.append('type', this.category.type);
            data.append('status', this.category.status);
            data.append('icon', this.category.icon);
            data.append('_method', 'PUT');

            if (typeof this.category.outstanding_image === 'object') {
                data.append('outstanding_image', this.category.outstanding_image);
            }

            axios
                .post('/evertec/mercatodo/public/api/admin/categories/' + this.category.id, data, config)
                .then((response) => {
                    alert(response.data.message);
                    this.$emit('getAllCategories');
                    this.close();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
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
