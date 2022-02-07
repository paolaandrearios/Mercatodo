<template>
    <div class="homepage__categoryList">
        <div class="homepage__categoryList--title" @click="showCategories">
            <i class="fas fa-bars"></i>
            <span>{{__('general.web.category.category')}}</span>
        </div>
        <div class="homepage__categoryList--content" v-show="show">
            <button v-for="category in categories" @click="select(category)">
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
            show: false,
        };
    },
    emit: ['setActive'],
    methods: {
        select: function(category) {
            this.$emit('setActive', category)
        },
        showCategories: function(){
            this.show = !this.show;
        },
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
    }
}
</script>
