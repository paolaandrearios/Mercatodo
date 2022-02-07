<template>
    <div>
        <bread-crumb></bread-crumb>
        <category-list-client></category-list-client>

        <div class="homepage__categoryActive">
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
            categoryActive:'Tecnología',
        };
    },
}
</script>

