<template>
    <div class="font-poppins container mx-auto">
        <div class="flex justify-center md:justify-start items-center">
            <logo class="text-xl md:text-2xl"></logo>
            <button class="p-1 md:hover:bg-orangePantone rounded-full ml-2 focus:outline-none" @click="goHome()">
                <i class="fas fa-home text-orangePantone text-lg md:text-2xl hover:text-white m-2 cursor-pointer"></i>
            </button>
        </div>
    </div>
</template>

<script>

import Logo from "../utils/Logo";

export default {
    name: "LogoAndHome.vue",
    components: {
        Logo,
    },
    methods:{
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        },
    },
}

</script>


