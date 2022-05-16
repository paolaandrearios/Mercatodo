<template>
    <div class="homepage">
        <header-home-page @searchProducts="searchProducts" :errors="errors"></header-home-page>
        <banner-home-page></banner-home-page>
        <category-home-page @categoryFilter="categoryFilter"></category-home-page>
        <product-grid :keyword="keyword" :category="category" @getErrors="getErrors"></product-grid>
    </div>
</template>

<script>
import HeaderHomePage from './HeaderHomePage';
import BannerHomePage from './BannerHomePage';
import CategoryHomePage from './CategoryHomePage';
import ProductGrid from '../../products/ProductGrid';

export default {
    name: 'HomePage.vue',
    components: {
        HeaderHomePage,
        BannerHomePage,
        CategoryHomePage,
        ProductGrid,
    },
    data() {
        return {
            keyword: '',
            errors: [],
            category: { id: '' },
        };
    },
    emit: ['searchProducts', 'getErrors'],
    methods: {
        searchProducts: function (keyword) {
            this.keyword = keyword;
        },
        getErrors: function (errors) {
            this.errors = errors;
        },
        categoryFilter: function (category) {
            this.category = category;
        },
    },
};
</script>
