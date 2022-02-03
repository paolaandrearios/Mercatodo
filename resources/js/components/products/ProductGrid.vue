<template>
    <div>
        <div class="homepage__productGrid">
            <div v-for="product in products" class="homepage__productGrid--content">
                <product-card :product="product"></product-card>
            </div>
        </div>
        <div class="flex justify-center">
            <pagination :pagination="pagination" @paginate="getAllProducts" :offset="4"/>
        </div>
    </div>
</template>

<script>
import ProductCard from "./ProductCard";
import axios from "axios";
import Pagination from "../utils/Pagination";

export default {
    name: "ProductGrid.vue",
    components: {
      ProductCard,
      Pagination,
    },
    data () {
        return {
            products: [],
            currentProduct: {},
            pagination: {},
        }
    },
    mounted() {
        this.getAllProducts()
    },
    methods: {
        getAllProducts:  function () {

            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage: 1;

            axios
                .get(`/evertec/mercatodo/public/api/products?page=${pageNum}`)
                .then(response => {
                    this.products = response.data.products.data;
                    this.pagination = response.data.products;
                })
        },
    }
}
</script>

<style scoped>

</style>
