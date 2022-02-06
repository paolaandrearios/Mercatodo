<template>
    <div>
        <div v-show="isProductNotFound" class="text-3xl text-dimGray text-center font-bold m-10">{{__('general.web.product.not_found')}}</div>
        <div v-if="keyword">
            <p v-if="this.products.length == 1" class="text-xs text-dimGray ml-5">{{this.products.length}} {{__('general.web.product.product_found')}}</p>
            <p v-if="this.products.length > 1" class="text-xs text-dimGray ml-5">{{this.products.length}} {{__('general.web.product.products_found')}}</p>
        </div>
        <div class="homepage__productGrid">
            <div v-for="product in products" class="homepage__productGrid--content">
                <product-card :product="product"></product-card>
            </div>
        </div>
        <div class="flex justify-center w-1/2 mx-auto">
            <pagination class="text-sm" :pagination="pagination" @paginate="getAllProducts" :offset="4"/>
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
    props: {
        keyword: String,
    },
    data () {
        return {
            products: [],
            currentProduct: {},
            pagination: {},
            isProductNotFound: false,
        }
    },
    mounted() {
        this.getAllProducts()
    },
    emit: ['getErrors'],

    methods: {
        getAllProducts:  function () {

            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage: 1;

            axios
                .get(`/evertec/mercatodo/public/api/products?page=${pageNum}&keyword=${this.keyword}`)
                .then(response => {
                    this.products = response.data.products.data;
                    this.pagination = response.data.products;
                    if(this.products.length === 0){
                        this.isProductNotFound = true;
                    } else {
                        this.isProductNotFound = false;
                    }
                }).catch(error => {
                this.$emit('getErrors', error.response.data.errors);
            })
        },
    },
    watch: {
        keyword: function(newVal, oldVal) {
            this.getAllProducts();
        },
    }
}
</script>

<style scoped>

</style>
