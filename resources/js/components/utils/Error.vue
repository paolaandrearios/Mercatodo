<template>
    <div v-show="errors && errors.length > 0">
        <p class="modal-error" v-for="error in errors">* {{error}}</p>
    </div>
</template>

<script>
export default {
    name: "Error.vue",

    props: {
        errors: Array,
    },
}
</script>
