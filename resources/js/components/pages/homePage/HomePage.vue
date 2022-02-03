<template>
    <div class="homepage">
        <header-home-page></header-home-page>
        <banner-home-page></banner-home-page>
        <category-home-page></category-home-page>
        <product-grid></product-grid>
    </div>
</template>

<script>
import HeaderHomePage from "./HeaderHomePage";
import BannerHomePage from "./BannerHomePage";
import CategoryHomePage from "./CategoryHomePage";
import ProductGrid from "../../products/ProductGrid";

export default {
    name: "HomePage.vue",
    components: {
        HeaderHomePage,
        BannerHomePage,
        CategoryHomePage,
        ProductGrid,
    },

};
</script>

<style lang="scss">
html {
    font-family: "Source Sans Pro", sans-serif !important;
}
</style>
