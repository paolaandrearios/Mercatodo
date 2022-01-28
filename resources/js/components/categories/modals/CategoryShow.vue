<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{__('general.web.category.category')}}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td class="label-table">Id</td>
                        <td>{{category.id}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.name_es')}}</td>
                        <td>{{category.name_es}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.name_en')}}</td>
                        <td>{{category.name_en}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.slug')}}</td>
                        <td>{{category.slug}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.type')}}</td>
                        <td>{{__('general.web.category.'+ category.type)}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.status')}}</td>
                        <td>{{__('general.web.category.'+ category.status)}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.icon')}}</td>
                        <td>{{category.icon}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.outstanding_image')}}</td>
                        <td>
                            <img class="w-5/6" v-bind:src="__asset(category.outstanding_image)"/>
                        </td>
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

