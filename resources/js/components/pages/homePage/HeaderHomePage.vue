<template>
    <div>
        <nav class="homepage__header">
            <logo class="text-xl md:text-2xl"></logo>
            <div class="flex w-full items-center" >
                <searcher @searchProducts="searchProducts" :errors="errors"></searcher>
                <cart-button class="ml-2"></cart-button>
            </div>
        </nav>
        <error class="text-xs text-center text-orangePantone font-bold mb-5" :errors="__e(errors, 'keyword')"></error>
    </div>
</template>

<script>
import Logo from "../../utils/Logo";
import Searcher from "../../utils/Searcher";
import CartButton from "../../orders/CartButton";

export default {
    name: "HeaderHomePage.vue",
    components: {
        Logo,
        Searcher,
        CartButton,
    },
    props: {
      errors: Array,
    },
    emit: ['searchProducts', 'getErrors'],
    methods: {
        searchProducts: function (keyword) {
            this.$emit('searchProducts', keyword)
        },
    }

}
</script>
