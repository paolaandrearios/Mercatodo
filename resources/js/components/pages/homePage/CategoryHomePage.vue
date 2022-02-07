<template>
    <div>
<!--        <bread-crumb></bread-crumb>-->
        <category-list-client @setActive="setActive"></category-list-client>

        <div class="homepage__categoryActive" v-show="categoryActive !== ''">
            <i class="fas fa-thumbtack"></i>
            <span>
				{{categoryActive}}
			</span>
        </div>
    </div>

</template>

<script>
import CategoryListClient from "../../categories/CategoryListClient";

export default {
    name: "CategoryHomePage.vue",
    components: {
        CategoryListClient,
    },
    data() {
        return {
            categoryActive:'',
        };
    },
    emit: ['categoryFilter'],
    methods: {
        setActive(category){
            this.categoryActive = category['name_'+window._locale];
            this.$emit('categoryFilter', category);
        }
    },

}
</script>

