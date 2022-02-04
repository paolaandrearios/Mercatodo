<template>
    <div class="flex flex-col justify-between mt-3 h-96 md:h-72 w-screen bg-culturedGray font-poppins">
        <div class="block items-center md:flex md:justify-between align-middle">
            <div class="w-full sm:w-1/3 md:w-4/12 mx-auto">
                <logo class="text-lg md:text-2xl text-black"></logo>
                <p class="text-xs text-dimGray text-center mx-5">{{__('general.welcome.welcome_description')}}</p>
            </div>
            <div class="flex flex-col w-full sm:w-1/3 mx-auto">
                <p class="text-center m-8 text-dimGray font-bold">{{__('general.web.follow_us')}}</p>
                 <div class="flex justify-center">
                     <img class="w-10 h-10" :src="__asset('images/facebook.png')"/>
                     <img class="w-10 h-10" :src="__asset('images/instagram.png')"/>
                     <img class="w-10 h-10" :src="__asset('images/twitter.png')"/>
                 </div>
            </div>
            <div class="flex flex-col w-full sm:w-1/3 mx-auto">
                <img class="w-40 mx-auto" :src="__asset('images/evertec.png')"/>
                <div class="flex justify-center mb-10">
                    <img class="w-10 h-10" :src="__asset('images/pse.png')"/>
                    <img class="w-10 h-10" :src="__asset('images/visa.png')"/>
                    <img class="w-10 h-10" :src="__asset('images/maestro.png')"/>
                    <img class="w-10 h-10" :src="__asset('images/american-express.png')"/>
                </div>
            </div>
        </div>
        <div class="w-5/6 mx-auto text-dimGray text-xs text-center">
            <hr>
            <div class="mb-5">
                <i class="far fa-copyright"></i>
                <span>Ecommerce by MercaTodo</span>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "./Logo";

export default {
    name: "FooterPage.vue",
    components: {
      Logo,
    },
}
</script>
