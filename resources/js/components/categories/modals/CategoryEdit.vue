<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{__('general.web.category.edit_category')}}
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
                        <td>
                            <input
                                type="text"
                                v-model="category.name"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.description')}}</td>
                        <td>
                            <input
                                type="text"
                                v-model="category.description"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.outstanding_image')}}</td>
                        <td>
                            <input
                                type="text"
                                v-model="category.outstanding_image"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.type')}}</td>
                        <td>
                            <select  id="type" v-model="category.type">
                                <option value="">{{__('general.web.select')}}</option>
                                <option value="category">{{__('general.web.category.category')}}</option>
                                <option value="subcategory">{{__('general.web.category.subcategory')}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('general.web.category.icon')}}</td>
                        <td>
                            <input
                                type="text"
                                v-model="category.icon"
                            />
                        </td>
                    </tr>
                </table>
                <div class="text-center p-2 mt-3">
                    <button
                        @click="isOpenEdit = false"
                        class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                    >
                        {{__('general.web.close')}}
                    </button>
                    <button
                        class="px-6 py-2 ml-2 text-white bg-orangePantone rounded"
                        v-on:click="update"
                    >
                        {{__('general.web.save')}}
                    </button>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script>
import axios from "axios";
import Modal from "../../Modal";


export default {
    name: "CategoryEdit.vue",
    components: {
        Modal
    },
    props: {
        isOpenEdit: Boolean,
        category: Object,
    },

    emits: ['close', 'getAllCategories'],

    methods: {

        close: function() {
            this.$emit('close')
        },

        update: function () {
            axios.put('/evertec/mercatodo/public/api/categories/' + this.category.id,
                this.category
            ).then(response => {
                alert(response.data.message)
                this.$emit('getAllCategories');
                this.close()
            }).catch(error => {
                alert(JSON.stringify(error.response.data.errors))
            })
        },
    },

    watch: {
        edit: function(newVal, oldVal) {
            this.isOpenEdit = newVal
        }
    }
}
</script>



