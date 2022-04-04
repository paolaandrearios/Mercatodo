<template>
    <div>
        <div class="relative z-10">
            <button
                @click="show = !show"
                class="focus:outline-none ml-5 flex rounded-full bg-white py-2 px-2 text-center"
            >
                <i class="fas fa-user-cog text-xl text-orangePantone"></i>
            </button>
            <div v-if="show" class="absolute left-2 mt-2 w-44 rounded-md bg-gray-100 py-2 shadow-xl">
                <a
                    @click="goDashboard"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.dashboard') }}
                </a>
                <a
                    @click="goUsers"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.users') }}
                </a>
                <a
                    @click="goCategories"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.categories') }}
                </a>
                <a
                    @click="goProducts"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.products') }}
                </a>
                <a
                    @click="goOrders"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.customer_orders') }}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: false,
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
    },
};
</script>
