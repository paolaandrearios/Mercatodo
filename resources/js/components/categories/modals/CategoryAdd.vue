<template>
    <Modal :isVisible="isOpenAdd" @close="close">
        <template v-slot:title>
            {{__('general.web.category.create_category')}}
        </template>
        <template v-slot:body>
            <form v-on:submit.prevent="" class="form">
                <div class="div-form">
                    <label for="name_es">{{__('general.web.category.name_es')}}</label>
                    <div class="div-input">
                        <input type="text" id="name_es" v-model="category.name_es">
                        <error :errors="__e(errors,'name_es')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="name_en">{{__('general.web.category.name_en')}}</label>
                    <div class="div-input">
                        <input type="text" id="name_en" v-model="category.name_en">
                        <error :errors="__e(errors,'name_en')"></error>
                    </div>
                </div>
                <div class="form-file">
                    <label for="outstanding_image">{{__('general.web.category.outstanding_image')}}</label>
                    <div class="div-input">
                        <input type="file" id="outstanding_image" v-on:change="onChange">
                        <error :errors="__e(errors,'outstanding_image')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="type">{{__('general.web.category.type')}}</label>
                    <div class="div-input">
                        <select  id="type" v-model="category.type">
                            <option value="">{{__('general.web.select')}}</option>
                            <option value="category">{{__('general.web.category.category')}}</option>
                            <option value="subcategory">{{__('general.web.category.subcategory')}}</option>
                        </select>
                        <error :errors="__e(errors,'type')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="status">{{__('general.web.category.status')}}</label>
                    <div class="div-input">
                        <select  id="status" v-model="category.status">
                            <option value="">{{__('general.web.select')}}</option>
                            <option value="active">{{__('general.web.category.active')}}</option>
                            <option value="inactive">{{__('general.web.category.inactive')}}</option>
                        </select>
                        <error :errors="__e(errors,'status')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="icon">{{__('general.web.category.icon')}}</label>
                    <div class="div-input">
                        <input type="text" id="icon" v-model="category.icon">
                        <error :errors="__e(errors,'icon')"></error>
                    </div>
                </div>

                <div class="flex justify-center mx-auto p-2 mt-3">
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
import Modal from "../../utils/Modal";
import Error from "../../utils/Modal";

function initialState() {
    return {
        category: {
            name_en: '',
            name_es: '',
            outstanding_image: '',
            type: '',
            status: '',
            icon: '',
        },
        errors: [],
    }
}

export default {
    name: "CategoryAdd.vue",
    components: {
        Modal,
        Error,
    },
    props: {
        isOpenAdd: Boolean,
    },

    emits: ['close', 'getAllCategories'],



    data(){
        return initialState();
    },

    methods: {

        onChange(e) {
            this.category.outstanding_image = e.target.files[0];
        },
        close: function() {
            this.errors = []
            this.$emit('close')
        },

        create: function () {

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('name_es', this.category.name_es);
            data.append('name_en', this.category.name_en);
            data.append('outstanding_image', this.category.outstanding_image);
            data.append('type', this.category.type);
            data.append('status', this.category.status);
            data.append('icon', this.category.icon);


            axios.post('/evertec/mercatodo/public/api/categories',
                data,
                config
            ).then(response => {
                alert(response.data.message)
                this.reset();
                this.$emit('getAllCategories');
                this.close();
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        },

        reset: function (){
            Object.assign(this.$data, initialState());
        }

    },
}
</script>



