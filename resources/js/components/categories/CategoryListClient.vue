<template>
    <div class="homepage__categoryList">
        <div class="homepage__categoryList--title">
            <i class="fas fa-bars"></i>
            <span>{{__('general.web.category.category')}}</span>
        </div>
        <div class="homepage__categoryList--content">
            <button v-for="category in categories">
                {{category['name_' + __locale()]}}
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CategoryListClient.vue",
    mounted() {
        this.getAllCategories()

    },
    data() {
        return {
            categories: [],
        };
    },

    methods: {
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
    }
}
</script>
