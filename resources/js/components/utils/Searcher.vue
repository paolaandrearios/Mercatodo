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

import Error from "./Error";

export default {
    name: "Searcher.vue",
    components: {
        Error,
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
    },
}
</script>


