<template>
    <Modal :isVisible="isOpenAdd" @close="close">
        <template v-slot:title>
            {{__('general.web.product.create_product')}}
        </template>
        <template v-slot:body>
            <form v-on:submit.prevent="" class="form">
                <div class="div-form">
                    <label for="sku">{{__('general.web.product.sku')}}</label>
                    <div class="div-input">
                        <input type="text" id="sku" v-model="product.sku">
                        <error :errors="__e(errors,'sku')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="name_es">{{__('general.web.product.name_es')}}</label>
                    <div class="div-input">
                        <input type="text" id="name_es" v-model="product.name_es">
                        <error :errors="__e(errors,'name_es')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="description_es">{{__('general.web.product.description_es')}}</label>
                    <div class="div-input">
                        <textarea type="text" id="description_es" v-model="product.description_es"></textarea>
                        <error :errors="__e(errors,'description_es')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="name_en">{{__('general.web.product.name_en')}}</label>
                    <div class="div-input">
                        <input type="text" id="name_en" v-model="product.name_en">
                        <error :errors="__e(errors,'name_en')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="description_en">{{__('general.web.product.description_en')}}</label>
                    <div class="div-input">
                        <textarea type="text" id="description_en" v-model="product.description_en"></textarea>
                        <error :errors="__e(errors,'description_en')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="price">{{__('general.web.product.price')}}</label>
                    <div class="div-input">
                        <input type="number" id="price" v-model="product.price">
                        <error :errors="__e(errors,'price')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="stock">{{__('general.web.product.stock')}}</label>
                    <div class="div-input">
                        <input type="number" id="stock" v-model="product.stock">
                        <error :errors="__e(errors,'stock')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="taxes">{{__('general.web.product.taxes')}}</label>
                    <div class="div-input">
                        <input type="number" id="taxes" v-model="product.taxes">
                        <error :errors="__e(errors,'taxes')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="category">{{__('general.web.category.category')}}</label>
                    <div class="div-input">
                        <select  id="category" v-model="categoryId">
                            <option value="">{{__('general.web.select')}}</option>
                            <option v-for="category in categories" v-bind:value="category.id">
                                {{category['name_' + __locale()]}}
                            </option>
                        </select>
                        <error :errors="__e(errors,'categoryId')"></error>
                    </div>
                </div>
                <div class="div-form">
                    <label for="status">{{__('general.web.product.status')}}</label>
                    <div class="div-input">
                        <select  id="status" v-model="product.status">
                            <option value="">{{__('general.web.select')}}</option>
                            <option value="active">{{__('general.web.product.active')}}</option>
                            <option value="inactive">{{__('general.web.product.inactive')}}</option>
                        </select>
                        <error :errors="__e(errors,'status')"></error>
                    </div>
                </div>
                <div class="form-file">
                    <label for="image">{{__('general.web.product.image')}}</label>
                    <div class="div-input">
                        <input type="file" id="image" v-on:change="onChange">
                        <error :errors="__e(errors,'image')"></error>
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
import Modal from "../../Modal";

function initialState() {
    return {
        product: {
            sku: '',
            name_en: '',
            name_es: '',
            description_es: '',
            description_en: '',
            image: '',
            price: '',
            taxes: '',
            status: '',
            stock: '',
        },
        categoryId: '',
        errors: [],
        categories: [],
    }
}

export default {
    name: "ProductAdd.vue",
    components: {
        Modal
    },
    props: {
        isOpenAdd: Boolean,
    },

    emits: ['close', 'getAllCategories'],

    data() {
        return initialState();
    },
    mounted() {
        this.getAllCategories()
    },
    methods: {

        onChange(e) {
            this.product.image = e.target.files[0];
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
            data.append('sku', this.product.sku);
            data.append('name_es', this.product.name_es);
            data.append('name_en', this.product.name_en);
            data.append('description_en', this.product.description_en);
            data.append('description_es', this.product.description_es);
            data.append('image', this.product.image);
            data.append('price', this.product.price);
            data.append('taxes', this.product.taxes);
            data.append('categoryId', this.categoryId);
            data.append('status', this.product.status);
            data.append('stock', this.product.stock);


            axios.post('/evertec/mercatodo/public/api/products',
                data,
                config
            ).then(response => {
                alert(response.data.message)
                this.reset();
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
        reset: function (){
            Object.assign(this.$data, initialState());
        }
    },
}
</script>



