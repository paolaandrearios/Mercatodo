<template>
    <div>
        <div class="relative z-10">
            <button @click="showMenu" class="focus:outline-none ml-5 flex rounded-full bg-white py-2 px-2 text-center">
                <i class="fas fa-user-cog text-xl text-orangePantone"></i>
            </button>
            <div v-if="show === true" class="absolute left-2 mt-2 w-44 rounded-md bg-gray-100 py-2 shadow-xl">
                <a
                    v-if="this.role === 'administrator'"
                    @click="goDashboard"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.dashboard') }}
                </a>
                <a
                    v-if="this.role === 'administrator'"
                    @click="goUsers"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.users') }}
                </a>
                <a
                    v-if="this.role === 'administrator' || this.role === 'stock_assistant'"
                    @click="goCategories"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.categories') }}
                </a>
                <a
                    v-if="
                        this.role === 'administrator' ||
                        this.role === 'stock_assistant' ||
                        this.role === 'financial_assistant'
                    "
                    @click="goProducts"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.products') }}
                </a>
                <a
                    v-if="
                        this.role === 'administrator' ||
                        this.role === 'financial_assistant' ||
                        this.role === 'logistic_assistant'
                    "
                    @click="goOrders"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.customer_orders') }}
                </a>
                <a
                    v-if="this.role === 'administrator' || this.role === 'stock_assistant'"
                    @click="goImportProducts"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.web.data_management.import_products') }}
                </a>
                <a
                    v-if="this.role === 'administrator' || this.role === 'stock_assistant'"
                    @click="goExportProducts"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.web.data_management.export_products') }}
                </a>
                <a
                    v-if="
                        this.role === 'administrator' ||
                        this.role === 'financial_assistant' ||
                        this.role === 'marketing_assistant'
                    "
                    @click="goReports"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.web.data_management.reports') }}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            show: false,
            role: '',
        };
    },
    methods: {
        goDashboard() {
            window.location.href = '/evertec/mercatodo/public/admin/dashboard';
        },
        goUsers() {
            window.location.href = '/evertec/mercatodo/public/admin/users';
        },
        goCategories() {
            window.location.href = '/evertec/mercatodo/public/admin/categories';
        },
        goProducts() {
            window.location.href = '/evertec/mercatodo/public/admin/products';
        },
        goOrders() {
            window.location.href = '/evertec/mercatodo/public/admin/orders/index';
        },
        goImportProducts() {
            window.location.href = '/evertec/mercatodo/public/admin/import/products';
        },
        goExportProducts() {
            window.location.href = '/evertec/mercatodo/public/admin/export/products';
        },
        goReports() {
            window.location.href = '/evertec/mercatodo/public/admin/reports';
        },
        showMenu: function () {
            this.show = this.show === false;
            axios.get('/evertec/mercatodo/public/api/user').then((response) => {
                this.role = response.data.role;
            });
        },
    },
};
</script>
