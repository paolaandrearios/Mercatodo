<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{__('general.web.product.edit_product')}}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <tr>
                        <td class="label-table">Id</td>
                        <td class="mx-0 md:mx-auto">{{product.id}}</td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.sku')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="product.sku"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'sku')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.name_es')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="product.name_es"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'name_es')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.description_es')}}</td>
                        <td>
                            <div>
                                <textarea
                                    type="text"
                                    v-model="product.description_es"
                                    class="input-table"
                                ></textarea>
                                <error :errors="__e(errors,'description_es')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.name_en')}}</td>
                        <td>
                            <div>
                                <input
                                    type="text"
                                    v-model="product.name_en"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'name_en')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.description_en')}}</td>
                        <td>
                            <div>
                                <textarea
                                    type="text"
                                    v-model="product.description_en"
                                    class="input-table"
                                ></textarea>
                                <error :errors="__e(errors,'description_en')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.price')}}</td>
                        <td>
                            <div>
                                <input
                                    type="number"
                                    v-model="product.price"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'price')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.stock')}}</td>
                        <td>
                            <div>
                                <input
                                    type="number"
                                    v-model="product.stock"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'stock')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.taxes')}}</td>
                        <td>
                            <div>
                                <input
                                    type="number"
                                    v-model="product.taxes"
                                    class="input-table"
                                />
                                <error :errors="__e(errors,'taxes')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.category.category')}}</td>
                        <td>
                            <div>
                                <select class="input-table" id="category" v-model="product.category">
                                    <option value="">{{__('general.web.select')}}</option>
                                    <option v-for="category in categories" v-bind:value="category.id">
                                        {{category['name_' + __locale()]}}
                                    </option>
                                </select>
                                <error :errors="__e(errors,'category')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.status')}}</td>
                        <td>
                            <div>
                                <select class="input-table" id="status" v-model="product.status">
                                    <option value="">{{__('general.web.select')}}</option>
                                    <option value="active">{{__('general.web.product.active')}}</option>
                                    <option value="inactive">{{__('general.web.product.inactive')}}</option>
                                </select>
                                <error :errors="__e(errors,'status')"></error>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-table">{{__('general.web.product.image')}}</td>
                        <td>
                            <div>
                                <img class="w-2/4 mb-2" v-bind:src="__asset(product.image)"/>
                                <button>
                                    <input class="overflow-x-scroll" type="file" id="image" v-on:change="onChange">
                                </button>
                            </div>
                            <error :errors="__e(errors,'image')"></error>
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
    name: "ProductEdit.vue",
    components: {
        Modal
    },
    props: {
        isOpenEdit: Boolean,
        product: Object,
    },
    data() {
        return {
            errors: [],
            categories: [],
        }
    },
    mounted() {
        this.getAllCategories()
    },

    emits: ['close', 'getAllProducts'],

    methods: {

        onChange(e) {
            this.product.image = e.target.files[0];
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
            data.append('sku', this.product.sku);
            data.append('name_es', this.product.name_es);
            data.append('name_en', this.product.name_en);
            data.append('description_es', this.product.description_es);
            data.append('description_en', this.product.description_en);
            data.append('price', this.product.price);
            data.append('stock', this.product.stock);
            data.append('taxes', this.product.taxes);
            data.append('category', this.product.category);
            data.append('status', this.product.status);
            data.append('_method', 'PUT');

            if(typeof this.product.image === 'object') {
                data.append('image', this.product.image);
            }

            axios.post('/evertec/mercatodo/public/api/products/' + this.product.id,
                data,
                config
            ).then(response => {
                alert(response.data.message)
                this.$emit('getAllProducts');
                this.close();
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
    },


    watch: {
        edit: function(newVal, oldVal) {
            this.isOpenEdit = newVal;
        },
    }
}
</script>



