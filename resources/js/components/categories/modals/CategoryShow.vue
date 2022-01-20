<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{__('general.web.category.category')}}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td>Id</td>
                        <td>{{category.id}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.name')}}</td>
                        <td>{{category.name}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.description')}}</td>
                        <td>{{category.description}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.outstanding_image')}}</td>
                        <td>{{category.outstanding_image}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.slug')}}</td>
                        <td>{{category.slug}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.type')}}</td>
                        <td>{{__('general.web.category.'+ category.type)}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.status')}}</td>
                        <td>{{__('general.web.category.'+ category.status)}}</td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.icon')}}</td>
                        <td>{{category.icon}}</td>
                    </tr>
                </table>
                <div class="text-center p-2 mt-3">
                    <button
                        @click="close()"
                        class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                    >
                        {{__('general.web.close')}}
                    </button>
                </div>
            </div>
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
        category: Object,
    },

    emits: ['close'],

    methods: {

        close: function() {
            this.$emit('close')
        },
    },

    watch: {
        show: function(newVal, oldVal) {
            this.isOpenShow = newVal
        }
    }
}
</script>

