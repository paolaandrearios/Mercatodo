<template>
    <button class="cartButton">
        <i class="fas fa-shopping-cart"></i>
        <div v-if="count > 0" class="cartButton__counter">
            {{ count }}
        </div>
    </button>
</template>

<script>
export default {
    name: "CartButton.vue",
    data() {
        return {
            count:1,
        };
    }
}
</script>


