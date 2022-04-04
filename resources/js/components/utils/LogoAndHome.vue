<template>
    <div class="container mx-auto font-poppins">
        <div class="flex items-center justify-center md:justify-start">
            <logo class="text-xl md:text-2xl"></logo>
            <button class="focus:outline-none ml-2 rounded-full p-1 md:hover:bg-orangePantone" @click="goHome()">
                <i class="fas fa-home m-2 cursor-pointer text-lg text-orangePantone hover:text-white md:text-2xl"></i>
            </button>
        </div>
    </div>
</template>

<script>
import Logo from '../utils/Logo';

export default {
    name: 'LogoAndHome.vue',
    components: {
        Logo,
    },
    methods: {
        goHome() {
            window.location.href = '/evertec/mercatodo/public/';
        },
    },
};
</script>
