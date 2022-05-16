<template>
    <div class="dataMa">
        <div class="dataMa__header">
            <img :src="__asset('images/import.png')" />
            <p>
                {{ __('general.web.data_management.import_products') }}
            </p>
        </div>
        <p class="dataMa__description">
            {{ __('general.web.data_management.import_description') }}
        </p>
        <button class="focus:outline-none mx-auto flex items-center text-dimGray hover:font-bold hover:text-gray-600">
            <i class="fas fa-download mr-2"></i>
            <a :href="__asset('files/example-import-products_' + __locale() + '.xlsx')" download>{{
                __('general.web.download')
            }}</a>
        </button>
        <form v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="dataMa__file">
                <div>
                    <label class="dataMa__file--label1" for="uploadFile">{{ __('general.web.file_import') }}</label>
                    <label class="dataMa__file--label2" for="uploadFile">{{ __('general.web.choose_file') }}</label>
                </div>
                <div class="mt-3 mb-5">
                    <div>{{ this.fileName }}</div>
                    <input
                        v-on:change="onchangeFile"
                        class="hidden"
                        type="file"
                        id="uploadFile"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    />
                </div>
                <div v-for="error in errors">
                    <error :errors="error"></error>
                </div>
            </div>
            <div class="dataMa__buttonContainer">
                <button @click="importProducts">
                    <span>
                        {{ __('general.web.data_management.import_products') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Error from '../utils/Error';

export default {
    name: 'ProductsImport',
    components: {
        Error,
    },

    data() {
        return {
            fileName: '',
            importedFile: '',
            errors: [],
        };
    },

    methods: {
        onchangeFile(e) {
            this.fileName = e.target.files[0].name;
            this.importedFile = e.target.files[0];
        },
        importProducts: function () {
            const config = {
                headers: {
                    'content-type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                },
            };

            let data = new FormData();

            data.append('products', this.importedFile);

            axios
                .post('/evertec/mercatodo/public/api/admin/import/products', data, config)
                .then((response) => {
                    alert(response.data.message);
                })
                .catch((error) => {
                    let messages = '';
                    let errors = error.response.data.errors;
                    Object.keys(errors).forEach(function (key) {
                        messages += '-' + errors[key] + '\n';
                    });
                    alert(messages);
                });
        },
    },
};
</script>

<style scoped></style>
