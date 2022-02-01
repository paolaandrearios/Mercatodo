<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{__('general.web.product.product')}}
        </template>
        <template v-slot:body>
            <div>
                <table v-if="!__isEmpty(product)">
                    <tr>
                        <td class="label-table">Id</td>
                        <td>{{product.id}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.sku')}}</td>
                        <td>{{product.sku}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.name_es')}}</td>
                        <td>{{product.name_es}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.description_es')}}</td>
                        <td>{{product.description_es}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.name_en')}}</td>
                        <td>{{product.name_en}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.description_en')}}</td>
                        <td>{{product.description_en}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.price')}}</td>
                        <td>{{product.price}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.stock')}}</td>
                        <td>{{product.stock}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.taxes')}}</td>
                        <td>{{product.taxes}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.category')}}</td>
                        <td>
                            {{ product.categories[0]['name_' + __locale()]}}
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.status')}}</td>
                        <td>{{__('general.web.product.'+ product.status)}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.image')}}</td>
                        <td>
                            <img class="w-5/6" v-bind:src="__asset(product.image)"/>
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
import axios from "axios";

export default {
    name: "ProductShow.vue",
    components: {
        Modal
    },
    props: {
        isOpenShow: Boolean,
        product: Object,
    },
    data() {
        return {
            categories: [],
        }
    },

    mounted() {
        this.getAllCategories()
    },
    emits: ['close'],

    methods: {

        close: function() {
            this.$emit('close')
        },
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
    },

    watch: {
        show: function(newVal, oldVal) {
            this.isOpenShow = newVal
        }
    }
}
</script>

