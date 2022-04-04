<template>
    <div>
        <div class="relative z-10">
            <button @click="show = !show" class="focus:outline-none flex py-1 px-4 text-center">
                <i class="fas fa-bars font-bold text-orangePantone"></i>
            </button>
            <div v-if="show" class="absolute right-2 mt-2 w-44 rounded-md bg-gray-100 py-2 shadow-xl">
                <a
                    @click="goHome()"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
                    {{ __('general.sidebar.home') }}
                </a>
                <a
                    @click="orders()"
                    class="block cursor-pointer px-4 py-2 text-xs font-extrabold uppercase text-orangePantone hover:bg-orangePantone hover:text-white"
                >
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
        goHome() {
            window.location.href = '/evertec/mercatodo/public';
        },
        orders() {
            window.location.href = '/evertec/mercatodo/public/orders/history';
        },
    },
};
</script>
