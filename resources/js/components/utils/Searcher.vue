<template>
    <div class="search">
        <i class="fas fa-search"></i>
        <input
            type="text"
            :placeholder="__('general.web.search')"
            class="search__input"
            v-model="keyword"
            @change="search()"
        />

    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Searcher.vue",
    props: {

    },
    emits: ['searchProducts'],
    data () {
        return {
            keyword: '',
        }
    },
    methods: {
        search:  function () {
            this.$emit('searchProducts', this.keyword)
        },
    }
}
</script>


