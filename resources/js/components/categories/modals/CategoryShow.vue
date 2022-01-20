<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{__('general.web.category.create_category')}}
        </template>
        <template v-slot:body>

        </template>
    </Modal>

</template>

<script>
import Modal from "../../Modal";

export default {
    name: "CategoryShow.vue",
    components: {
        Modal
    },
    props: {
        isOpenShow: Boolean,
    },

    emits: ['close'],

    data() {
        return {

        }
    },

    methods: {

        close: function() {
            this.$emit('close')
        },

    },
}
</script>

