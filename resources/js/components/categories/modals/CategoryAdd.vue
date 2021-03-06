<template>
    <Modal :isVisible="isOpenAdd" @close="close">
        <template v-slot:title>
            {{ __('general.web.category.create_category') }}
        </template>
        <template v-slot:body>
            <form v-on:submit.prevent="" class="form">
                <div class="div-form">
                    <label for="name_es">{{ __('general.web.category.name_es') }}</label>
                    <div class="div-input">
                        <input
                            name="name_es"
                            type="text"
                            id="name_es"
                            v-model="category.name_es"
                            required
                            minlength="4"
                            maxlength="60"
                        />
                        <error :errors="__e(errors, 'name_es')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="name_en">{{ __('general.web.category.name_en') }}</label>
                    <div class="div-input">
                        <input
                            name="name_en"
                            type="text"
                            id="name_en"
                            v-model="category.name_en"
                            required
                            minlength="4"
                            maxlength="60"
                        />
                        <error :errors="__e(errors, 'name_en')"></error>
                    </div>
                </div>
                <div class="form-file">
                    <label for="outstanding_image">{{ __('general.web.category.outstanding_image') }}</label>
                    <div class="div-input">
                        <input
                            name="outstanding_image"
                            type="file"
                            id="outstanding_image"
                            ref="fileupload"
                            v-on:change="onChange"
                            accept="image/png,image/jpeg,image/jpg"
                            required
                        />
                        <error :errors="__e(errors, 'outstanding_image')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="type">{{ __('general.web.category.type') }}</label>
                    <div class="div-input">
                        <select name="type" id="type" v-model="category.type" required>
                            <option value="">{{ __('general.web.select') }}</option>
                            <option value="category">{{ __('general.web.category.category') }}</option>
                            <option value="subcategory">{{ __('general.web.category.subcategory') }}</option>
                        </select>
                        <error :errors="__e(errors, 'type')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="status">{{ __('general.web.category.status') }}</label>
                    <div class="div-input">
                        <select name="status" id="status" v-model="category.status" required>
                            <option value="">{{ __('general.web.select') }}</option>
                            <option value="active">{{ __('general.web.category.active') }}</option>
                            <option value="inactive">{{ __('general.web.category.inactive') }}</option>
                        </select>
                        <error :errors="__e(errors, 'status')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="icon">{{ __('general.web.category.icon') }}</label>
                    <div class="div-input">
                        <input name="icon" type="text" id="icon" v-model="category.icon" required minlength="5" />
                        <error :errors="__e(errors, 'icon')"></error>
                    </div>
                </div>

                <div class="mx-auto mt-3 flex justify-center p-2">
                    <button
                        v-on:click="close"
                        class="border rounded border-orangePantone px-6 py-2 font-bold text-orangePantone"
                    >
                        {{ __('general.web.close') }}
                    </button>
                    <button class="rounded ml-2 bg-orangePantone px-6 py-2 text-white" v-on:click="create">
                        {{ __('general.web.save') }}
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>

<script>
import axios from 'axios';
import Modal from '../../utils/Modal';
import Error from '../../utils/Error';

function initialState() {
    return {
        category: {
            name_en: '',
            name_es: '',
            outstanding_image: '',
            type: '',
            status: '',
            icon: '',
        },
        errors: [],
    };
}

export default {
    name: 'CategoryAdd.vue',
    components: {
        Modal,
        Error,
    },
    props: {
        isOpenAdd: Boolean,
    },

    emits: ['close', 'getAllCategories'],

    data() {
        return initialState();
    },

    methods: {
        onChange(e) {
            this.category.outstanding_image = e.target.files[0];
        },
        close: function () {
            this.errors = [];
            this.$emit('close');
        },

        create: function () {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                },
            };

            let data = new FormData();
            data.append('name_es', this.category.name_es);
            data.append('name_en', this.category.name_en);
            data.append('outstanding_image', this.category.outstanding_image);
            data.append('type', this.category.type);
            data.append('status', this.category.status);
            data.append('icon', this.category.icon);

            axios
                .post('/evertec/mercatodo/public/api/admin/categories', data, config)
                .then((response) => {
                    alert(response.data.message);
                    this.reset();
                    this.$emit('getAllCategories');
                    this.close();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        reset: function () {
            Object.assign(this.$data, initialState());
            this.$refs.fileupload.value = null;
        },
    },
};
</script>
