<template>
    <div class="mt-3 flex h-96 w-screen flex-col justify-between bg-culturedGray font-poppins md:h-72">
        <div class="block items-center align-middle md:flex md:justify-between">
            <div class="mx-auto w-full sm:w-1/3 md:w-4/12">
                <logo class="text-lg text-black md:text-2xl"></logo>
                <p class="mx-5 text-center text-xs text-dimGray">{{ __('general.welcome.welcome_description') }}</p>
            </div>
            <div class="mx-auto flex w-full flex-col sm:w-1/3">
                <p class="m-8 text-center font-bold text-dimGray">{{ __('general.web.follow_us') }}</p>
                <div class="flex justify-center">
                    <img class="h-10 w-10" :src="__asset('images/facebook.png')" />
                    <img class="h-10 w-10" :src="__asset('images/instagram.png')" />
                    <img class="h-10 w-10" :src="__asset('images/twitter.png')" />
                </div>
            </div>
            <div class="mx-auto flex w-full flex-col sm:w-1/3">
                <img class="mx-auto w-40" :src="__asset('images/evertec.png')" />
                <div class="mb-10 flex justify-center">
                    <img class="h-10 w-10" :src="__asset('images/pse.png')" />
                    <img class="h-10 w-10" :src="__asset('images/visa.png')" />
                    <img class="h-10 w-10" :src="__asset('images/maestro.png')" />
                    <img class="h-10 w-10" :src="__asset('images/american-express.png')" />
                </div>
            </div>
        </div>
        <div class="mx-auto w-5/6 text-center text-xs text-dimGray">
            <hr />
            <div class="mb-5">
                <i class="far fa-copyright"></i>
                <span>Ecommerce by MercaTodo</span>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from './Logo';

export default {
    name: 'FooterPage.vue',
    components: {
        Logo,
    },
};
</script>
