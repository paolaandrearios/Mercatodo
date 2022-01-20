<template>
    <Modal :isVisible="isOpenAdd" @close="close">
        <template v-slot:title>
            {{__('general.web.category.create_category')}}
        </template>
        <template v-slot:body>
            <form v-on:submit.prevent="">
                <div>
                    <label for="name">{{__('general.web.category.name')}}</label>
                    <input text="text" id="name" v-model="category.name">
                </div>
                <div>
                    <label for="description">{{__('general.web.category.description')}}</label>
                    <input text="text" id="description" v-model="category.description">
                </div>
                <div>
                    <label for="image">{{__('general.web.category.outstanding_image')}}</label>
                    <input text="text" id="image" v-model="category.outstanding_image">
                </div>
                <div>
                    <label for="type">{{__('general.web.category.type')}}</label>
                    <select  id="type" v-model="category.type">
                        <option value="">{{__('general.web.select')}}</option>
                        <option value="category">{{__('general.web.category.category')}}</option>
                        <option value="subcategory">{{__('general.web.category.subcategory')}}</option>
                    </select>
                </div>
                <div>
                    <label for="status">{{__('general.web.category.status')}}</label>
                    <select  id="status" v-model="category.status">
                        <option value="">{{__('general.web.select')}}</option>
                        <option value="active">{{__('general.web.category.active')}}</option>
                        <option value="inactive">{{__('general.web.category.inactive')}}</option>
                    </select>
                </div>
                <div>
                    <label for="icon">{{__('general.web.category.icon')}}</label>
                    <input text="text" id="icon" v-model="category.icon">
                </div>

                <div class="text-center p-2 mt-3">
                    <button
                        v-on:click="close"
                        class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                    >
                        {{__('general.web.close')}}
                    </button>
                    <button
                        class="px-6 py-2 ml-2 text-white bg-orangePantone rounded"
                        v-on:click="create"
                    >
                        {{__('general.web.save')}}
                    </button>
                </div>
            </form>
        </template>
    </Modal>
</template>

<script>
import axios from "axios";
import Modal from "../../Modal";


export default {
    name: "FormCategory.vue",
    components: {
        Modal
    },
    props: {
        isOpenAdd: Boolean,
    },

    emits: ['close'],

    data() {
        return {
            category: {
                name: '',
                description: '',
                outstanding_image: '',
                type: '',
                status: '',
                icon: '',
            },
        }
    },

    methods: {

        close: function() {
            this.$emit('close')
        },

        create: function () {
            axios.post('/evertec/mercatodo/public/api/categories',
                this.category
            ).then(response => {
                alert(response.data.message)
                this.close()
            }).catch(error => {
                alert(JSON.stringify(error.response.data.errors))
            })
        },
    },
}
</script>



