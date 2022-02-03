<template>
    <section class="py-2 text-gray-500">
        <a href="#" class="breadcrumb" v-for="item in breadcrumb">
            {{ item }}
        </a>
    </section>
</template>

<script>
export default {
    name: "BreadCrumb.vue",
    data() {
        return {
            breadcrumb: ["Inicio", "Oficina"],
        };
    }
}
</script>

