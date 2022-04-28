<template>
    <div class="m-10 text-center">
        <div class="flex items-center justify-between text-lg font-bold md:text-xl flex-col">
            <img class="mx-auto w-20 md:w-32" :src="__asset('images/import.png')" />
            <p class="mt-4 mb-2 text-sm text-dimGray md:text-xl">
                {{ __('general.web.data_management.import_products') }}
            </p>
        </div>
        <p class="mt-2 mb-5 md:mx-1/4 text-dimGray">
            {{ __('general.web.data_management.import_description') }}
        </p>
        <button class="flex mx-auto items-center text-dimGray focus:outline-none hover:text-gray-600 hover:font-bold">
            <i class="fas fa-download mr-2"></i>
            <a :href="__asset('files/example-import-products_'+ __locale() + '.xlsx')" download>{{__('general.web.download')}}</a>
        </button>
        <form v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="form-file mt-10 mb-10 flex flex-col justify-center items-center">
                <div>
                    <label class="p-2 mr-2" for="uploadFile">{{ __('general.web.file_import') }}</label>
                    <label class="bg-gray-400 hover:bg-gray-500 p-2 mr-2 rounded-xl" for="uploadFile">{{ __('general.web.choose_file') }}</label>
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
            <div class="mt-7 w-3/4 md:w-1/5 mx-auto grid grid-cols-1 grid-rows-1">
                <button @click="importProducts"
                        class="focus:outline-none w-full transform cursor-pointer rounded-2xl border-0 bg-orangePantone p-4 text-white transition-all duration-300 hover:scale-105 hover:bg-orange-600 focus:bg-orange-600">
                    <span>
                        {{ __('general.web.data_management.import_products') }}
                    </span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import axios from "axios";
import Error from "../utils/Error";

export default {
    name: "ProductsImport",
    components: {
        Error,
    },

    data() {
       return {
           fileName:'',
           importedFile:'',
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


            axios.post('/evertec/mercatodo/public/api/admin/products/import', data, config).then((response) => {
                //this.importedFile = response;
                // this.product = response.data.product;
                // this.main_image = this.product.images[0]['url'];
                console.log(JSON.stringify(response));
            })
            .catch((error)=> {
                this.errors = error.response.data.errors;
                console.log(this.errors);
            });
        },
    }
}
</script>

<style scoped>

</style>
