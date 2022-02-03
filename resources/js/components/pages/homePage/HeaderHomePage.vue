<template>
    <nav
        class="homepage__header"
    >
        <logo></logo>
        <searcher></searcher>
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
    }
}
</script>

<style scoped>

</style>
