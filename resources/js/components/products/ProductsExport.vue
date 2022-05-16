<template>
    <div class="dataMa">
        <div class="dataMa__header">
            <img :src="__asset('images/export.png')" />
            <p>
                {{ __('general.web.data_management.export_products') }}
            </p>
        </div>
        <p class="dataMa__description">
            {{ __('general.web.data_management.export_description') }}
        </p>
        <form class="my-8" v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="dataMa__date">
                <div class="dataMa__date--moment">
                    <label for="initial-date">{{ __('general.web.initial_date') }}</label>
                    <div>
                        <input
                            v-model="initialDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="initial-date"
                            type="date"
                            required
                            placeholder="Select date"
                        />
                    </div>
                </div>
                <div class="dataMa__date--moment">
                    <label for="end-date">{{ __('general.web.end_date') }}</label>
                    <div>
                        <input
                            v-model="endDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="end-date"
                            type="date"
                            required
                            placeholder="Select date"
                        />
                    </div>
                </div>
            </div>
            <div class="dataMa__options">
                <select id="status" v-model="status" class="dataMa__options--select">
                    <option value="">{{ __('general.web.data_management.by_status') }}</option>
                    <option value="active">{{ __('general.web.data_management.active_products') }}</option>
                    <option value="inactive">{{ __('general.web.data_management.inactive_products') }}</option>
                </select>
                <select class="dataMa__options--select" v-model="category">
                    <option value="">{{ __('general.web.data_management.by_category') }}</option>
                    <option v-for="(category, index) in categories" :key="index" :value="category.id">
                        {{ category['name_' + __locale()] }}
                    </option>
                </select>
            </div>
            <div class="dataMa__buttonContainer">
                <button @click="ExportProducts">
                    <span>
                        {{ __('general.web.data_management.export_products') }}
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
    name: 'ProductsExport',
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

            axios
                .get(
                    `/evertec/mercatodo/public/api/admin/export/products?status=${this.status}&category=${this.category}&initial-date=${this.initialDate}&end-date=${this.endDate}`,
                    config
                )
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
        getAllCategories: function () {
            axios
                .get('/evertec/mercatodo/public/api/admin/categories')
                .then((response) => (this.categories = response.data.categories.data));
        },
    },
};
</script>

<style scoped></style>
