<template>
    <div>
        <nav class="homepage__header">
            <logo class="text-2xl md:text-4xl"></logo>
            <searcher @searchProducts="searchProducts" :errors="errors"></searcher>
            <cart-button></cart-button>
        </nav>
        <error class="text-xs text-center text-orangePantone font-bold mb-5" :errors="__e(errors, 'keyword')"></error>
    </div>
</template>

<script>
import Logo from "../../utils/Logo";
import Searcher from "../../utils/Searcher";
import CartButton from "../../utils/CartButton";

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
