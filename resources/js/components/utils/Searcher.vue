<template>
    <div class="search">
        <i class="fas fa-search"></i>
        <input
            type="text"
            :placeholder="__('general.web.search_sentence')"
            class="search__input"
            v-model="keyword"
            @change="search()"
        />
        <button class="search__button" @click="search()">{{__('general.web.search')}}</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Searcher.vue",
    emits: ['searchProducts'],
    data () {
        return {
            keyword: '',
            errors: [],
        }
    },
    methods: {
        search:  function () {
            this.$emit('searchProducts', this.keyword)
        },
    }
}
</script>


