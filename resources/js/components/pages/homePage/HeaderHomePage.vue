<template>
    <nav
        class="homepage__header"
    >
        <logo></logo>
        <searcher @searchProducts="searchProducts"></searcher>
        <cart-button></cart-button>
    </nav>

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
    emit: ['searchProducts'],
    methods: {
        searchProducts: function (keyword) {
            this.$emit('searchProducts', keyword)
        }
    }

}
</script>

<style scoped>

</style>
