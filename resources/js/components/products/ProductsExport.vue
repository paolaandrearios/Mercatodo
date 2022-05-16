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
            <div class="w-2/4 flex flex-col md:flex-row justify-items-center mx-auto mb-4">
                <div class="w-1/2 flex flex-col">
                    <label class="font-bold text-dimGray" for="initial-date">{{ __('general.web.initial_date') }}</label>
                    <div>
                        <input
                            v-model="initialDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="initial-date"
                            type="date"
                            required
                            placeholder="Select date"
                            class="bg-gray-300 p-2 rounded-xl focus:outline-none"
                        >
                    </div>
                </div>
                <div class="w-1/2">
                    <label class="font-bold text-dimGray" for="end-date">{{ __('general.web.end_date') }}</label>
                    <div>
                        <input
                            v-model="endDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="end-date"
                            type="date"
                            required
                            placeholder="Select date"
                            class="bg-gray-300 p-2 rounded-xl focus:outline-none"
                        >
                    </div>
                </div>
            </div>
            <div class="w-2/4 mx-auto grid grid-cols-1 md:grid-cols-2 gap-2">
                <select id="status" v-model="status" class="bg-gray-300 p-2 rounded-xl focus:outline-none truncate">
                    <option value="">{{ __('general.web.data_management.by_status') }}</option>
                    <option value="active">{{ __('general.web.data_management.active_products') }}</option>
                    <option value="inactive">{{ __('general.web.data_management.inactive_products') }}</option>
                </select>
                <select class="bg-gray-300 p-2 rounded-xl focus:outline-none" v-model="category">
                    <option value="">{{ __('general.web.data_management.by_category') }}</option>
                    <option v-for="(category, index) in categories" :key="index" :value="category.id">
                        {{ category['name_' + __locale()] }}
                    </option>
                </select>
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
           categories: [],
           initialDate: '',
           endDate: '',
        };
    },
    mounted() {
        this.getAllCategories();
    },
    methods: {
        ExportProducts: function () {

            const config = {
                headers: {
                    'content-type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                },
            };

            axios.get(`/evertec/mercatodo/public/api/admin/export/products?status=${this.status}&category=${this.category}&initial-date=${this.initialDate}&end-date=${this.endDate}`, config).then((response) => {
                alert(response.data.message)
            })
            .catch((error) => {
                let messages = ''
                let errors = error.response.data.errors
                Object.keys(errors).forEach(function(key) {
                    messages += '-' + errors[key] + '\n';
                })
                alert(messages);
            });
        },
        getAllCategories: function () {
            axios
                .get('/evertec/mercatodo/public/api/admin/categories')
                .then((response) => (this.categories = response.data.categories.data));
        },
    }
}
</script>

<style scoped>

</style>
