<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{__('general.web.category.edit_category')}}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td class="label-table">Id</td>
                        <td class="mx-0 md:mx-auto">{{category.id}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.name_es')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="category.name_es"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'name_es')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.name_en')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="category.name_en"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'name_en')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.type')}}</td>
                        <td>
                            <div>
                                <select class="input-table" id="type" v-model="category.type">
                                    <option value="">{{__('general.web.select')}}</option>
                                    <option value="category">{{__('general.web.category.category')}}</option>
                                    <option value="subcategory">{{__('general.web.category.subcategory')}}</option>
                                </select>
                                <error :errors="__e(errors,'type')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.icon')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="category.icon"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'icon')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.outstanding_image')}}</td>
                        <td>
                            <div>
                                <img class="w-2/4 mb-2" v-bind:src="__asset(category.outstanding_image)"/>
                                <button>
                                    <input class="overflow-x-scroll" type="file" id="outstanding_image" v-on:change="onChange">
                                </button>
                            </div>
                            <error :errors="__e(errors,'outstanding_image')"></error>
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
    data() {
        return {
            errors: [],
        }
    },

    emits: ['close', 'getAllCategories'],

    methods: {

        onChange(e) {
            this.category.outstanding_image = e.target.files[0];
        },

        close: function() {
            this.$emit('close')
        },

        update: function () {

            const config = {
                headers: {
                    'accept': 'application/json',
                    'Accept-Language': 'en-US,en;q=0.8',
                    'Content-Type': 'multipart/form-data',
                }
            }

            let data = new FormData();
            data.append('name_es', this.category.name_es);
            data.append('name_en', this.category.name_en);
            data.append('type', this.category.type);
            data.append('status', this.category.status);
            data.append('icon', this.category.icon);
            data.append('_method', 'PUT');

            if(typeof this.category.outstanding_image === 'object') {
                data.append('outstanding_image', this.category.outstanding_image);
            }

            axios.post('/evertec/mercatodo/public/api/categories/' + this.category.id,
                data,
                config
            ).then(response => {
                alert(response.data.message)
                this.$emit('getAllCategories');
                this.close();
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        },
    },


    watch: {
        edit: function(newVal, oldVal) {
            this.isOpenEdit = newVal;
        },
    }
}
</script>



