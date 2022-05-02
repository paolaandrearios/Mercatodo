<template>
    <div class="m-10 text-center">
        <div class="flex items-center justify-between text-lg font-bold md:text-xl flex-col">
            <img class="mx-auto w-20 md:w-32" :src="__asset('images/export.png')" />
            <p class="mt-4 mb-2 text-sm text-dimGray md:text-xl">
                {{ __('general.web.data_management.export_products') }}
            </p>
        </div>
        <p class="mt-2 mb-5 md:mx-1/4 text-dimGray">
            {{ __('general.web.data_management.export_description') }}
       </p>
        <form class="my-8" v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="w-2/4 mx-auto grid grid-cols-1 md:grid-cols-2 gap-2">
                <select id="status" v-model="status" class="bg-gray-300 p-2 rounded-xl focus:outline-none">
                    <option value="">{{ __('general.web.select') }}</option>
                    <option value="all">{{ __('general.web.data_management.all_products') }}</option>
                    <option value="active">{{ __('general.web.data_management.active_products') }}</option>
                    <option value="inactive">{{ __('general.web.data_management.inactive_products') }}</option>
                </select>
<!--                <select class="bg-gray-300 p-2 rounded-xl focus:outline-none">-->
<!--                    <option value="">{{ __('general.web.select') }}</option>-->
<!--                    <option value="all">{{ __('general.web.data_management.all_products') }}</option>-->
<!--                    <option value="active">{{ __('general.web.data_management.active_products') }}</option>-->
<!--                    <option value="inactive">{{ __('general.web.data_management.inactive_products') }}</option>-->
<!--                </select>-->
            </div>
            <div class="mt-7 w-3/4 md:w-1/5 mx-auto grid grid-cols-1 grid-rows-1">
                <button @click="ExportProducts"
                        class="focus:outline-none w-full transform cursor-pointer rounded-2xl border-0 bg-orangePantone p-4 text-white transition-all duration-300 hover:scale-105 hover:bg-orange-600 focus:bg-orange-600">
                    <span>
                        {{ __('general.web.data_management.export_products') }}
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
    name: "ProductsExport",
    components: {
        Error,
    },

    data() {
       return {
           products: [],
           errors: [],
           status: '',
           category: '',
        };
    },

    methods: {
        ExportProducts: function () {

            let date = (new Date()).toISOString().split('T')[0];

            const config = {
                headers: {
                    'content-type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                },
                responseType: 'blob',
            };

            axios.get(`/evertec/mercatodo/public/api/admin/export/products?status=${this.status}`, config).then((response) => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', date + '_' + this.status + '_products.xlsx');
                document.body.appendChild(fileLink);

                fileLink.click();
            })
            .catch((error)=> {
                this.errors = error.response.data.errors;
                alert(error.response.data.message);
            });
        },
    }
}
</script>

<style scoped>

</style>
