<template>
    <div>
        <div class="relative z-10">
            <button
                @click="show = !show"
                class="flex text-center ml-5 py-2 px-2 focus:outline-none bg-white rounded-full">
                <i class="fas fa-user-cog text-orangePantone text-xl"></i>
            </button>
            <div v-if="show" class="absolute left-2 py-2 mt-2 bg-gray-100 rounded-md shadow-xl w-44">
                <a @click="goDashboard" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.sidebar.dashboard') }}
                </a>
                <a @click="goUsers" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.sidebar.users') }}
                </a>
                <a @click="goCategories" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.sidebar.categories') }}
                </a>
                <a @click="goProducts" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.sidebar.products') }}
                </a>
                <a @click="goOrders" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
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
        goDashboard(){
            window.location.href = '/evertec/mercatodo/public/admin/dashboard';
        },
       goUsers(){
            window.location.href = '/evertec/mercatodo/public/admin/users';
        },
        goCategories(){
            window.location.href = '/evertec/mercatodo/public/admin/categories';
        },
        goProducts(){
            window.location.href = '/evertec/mercatodo/public/admin/products';
        },
        goOrders(){
            window.location.href = '/evertec/mercatodo/public/admin/orders/index';
        },
    }
};
</script>
