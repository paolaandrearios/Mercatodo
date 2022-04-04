<template>
    <div>
        <div v-on:click="seeDetails">
            <img
                width="288"
                height="360"
                class="mx-auto rounded-lg object-contain"
                :src="__asset(product.images[0]['url'])"
                alt="Product"
            />
        </div>

        <div class="mt-4 text-xs font-semibold md:text-sm">{{ product['name_' + __locale()] }}</div>
        <div class="text-xs text-gray-400 md:text-sm">
            <span class="mr-2 line-through"></span>
            <span class="text-black">{{ __currencyFormat(product.price) }}</span>
        </div>
        <div class="flex justify-center">
            <button
                v-on:click="seeDetails"
                class="focus:outline-none transition-color mt-1 rounded-full border-2 border-gray-400 px-4 py-1 text-center text-xs font-bold text-gray-400 duration-300 hover:border-greenTem hover:text-greenTem md:text-sm"
            >
                {{ __('general.web.see_more') }}
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProductCard.vue',
    props: {
        product: Object,
    },

    methods: {
        seeDetails(e) {
            window.location.href = '/evertec/mercatodo/public/product/' + this.product['slug'];
        },
    },
};
</script>
