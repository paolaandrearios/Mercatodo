<template>
    <div>
        <div class="relative z-10">
            <button
                @click="show = !show"
                class="flex text-center py-1 px-4 focus:outline-none">
                <i class="fas fa-bars text-orangePantone font-bold"></i>
            </button>
            <div v-if="show" class="absolute right-2 py-2 mt-2 bg-gray-100 rounded-md shadow-xl w-44">
                <a @click="goHome()" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.sidebar.home') }}
                </a>
                <a @click="orders()" class="block px-4 py-2 text-xs font-extrabold text-orangePantone hover:bg-orangePantone hover:text-white uppercase cursor-pointer">
                    {{ __('general.web.order.your_orders') }}
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
        goHome(){
            window.location.href = '/evertec/mercatodo/public';
        },
        orders(){
            window.location.href = '/evertec/mercatodo/public/orders/history';
        }
    }
};
</script>
