<template>
    <Modal :isVisible="isOpenAdd" @close="close">
        <template v-slot:title>
            {{__('general.web.product.create_product')}}
        </template>
        <template v-slot:body>
            <form v-on:submit.prevent="" class="form">
                <ul class="modal__tabs dark:border-gray-700">
                    <li class="mr-2">
                        <a @click="setTab(1)" aria-current="page" v-bind:class="getTabPage1">{{__('general.web.product.information')}}</a>
                    </li>
                    <li class="mr-2">
                        <a @click="setTab(2)" aria-current="page" v-bind:class="getTabPage2">{{__('general.web.product.images')}}</a>
                    </li>
                </ul>

                <div v-if="tab==1">
                    <div class="div-form mt-5">
                        <label for="sku">{{__('general.web.product.sku')}}</label>
                        <div class="div-input">
                            <input type="text" id="sku" v-model="product.sku" required minlength="5" maxlength="10">
                            <error :errors="__e(errors,'sku')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="name_es">{{__('general.web.product.name_es')}}</label>
                        <div class="div-input">
                            <input type="text" id="name_es" v-model="product.name_es" required minlength="4" maxlength="60">
                            <error :errors="__e(errors,'name_es')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="description_es">{{__('general.web.product.description_es')}}</label>
                        <div class="div-input">
                            <textarea type="text" id="description_es" v-model="product.description_es" required minlength="80" maxlength="400"></textarea>
                            <error :errors="__e(errors,'description_es')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="name_en">{{__('general.web.product.name_en')}}</label>
                        <div class="div-input">
                            <input type="text" id="name_en" v-model="product.name_en" required minlength="4" maxlength="60">
                            <error :errors="__e(errors,'name_en')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="description_en">{{__('general.web.product.description_en')}}</label>
                        <div class="div-input">
                            <textarea type="text" id="description_en" v-model="product.description_en" required minlength="80" maxlength="400"></textarea>
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
                            <input type="number" id="stock" v-model="product.stock" required>
                            <error :errors="__e(errors,'stock')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="taxes">{{__('general.web.product.taxes')}}</label>
                        <div class="div-input">
                            <input type="number" id="taxes" v-model="product.taxes" required>
                            <error :errors="__e(errors,'taxes')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="category">{{__('general.web.category.category')}}</label>
                        <div class="div-input">
                            <select  id="category" v-model="category_id" required>
                                <option value="">{{__('general.web.select')}}</option>
                                <option v-for="category in categories" v-bind:value="category.id">
                                    {{category['name_' + __locale()]}}
                                </option>
                            </select>
                            <error :errors="__e(errors,'category_id')"></error>
                        </div>
                    </div>
                    <div class="div-form">
                        <label for="status">{{__('general.web.product.status')}}</label>
                        <div class="div-input">
                            <select  id="status" v-model="product.status" required>
                                <option value="">{{__('general.web.select')}}</option>
                                <option value="active">{{__('general.web.product.active')}}</option>
                                <option value="inactive">{{__('general.web.product.inactive')}}</option>
                            </select>
                            <error :errors="__e(errors,'status')"></error>
                        </div>
                    </div>
                    <div class="flex justify-center mt-5">
                        <a @click="setTab(2)" class="modal-previous-next dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            {{__('general.web.next')}} >
                        </a>
                    </div>
                </div>
                <div v-if="tab==2">
                    <div v-show="count_images < 5" class="flex justify-end mt-3">
                        <div class="section__container--add">
                            <button v-on:click="addImage()"><i class="text-white pr-1 fas fa-plus-circle"></i>{{__('general.web.product.add')}}</button>
                        </div>
                    </div>
                    <div class="form-file mt-5 mb-10">
                        <label for="image0">{{__('general.web.product.image')}}</label>
                        <div class="div-input">
                            <input type="file" id="image0" required data-index="0" ref="fileupload0" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                            <error :errors="__e(errors,'image0')"></error>
                        </div>
                    </div>
                    <div v-if="count_images >= 2" class="form-file mt-5 mb-10">
                        <label for="image1">{{__('general.web.product.image')}}</label>
                        <div class="div-input">
                            <input type="file" id="image1" ref="fileupload1" data-index="1" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                            <error :errors="__e(errors,'image1')"></error>
                        </div>
                    </div>
                    <div v-if="count_images >= 3" class="form-file mt-5 mb-10">
                        <label for="image2">{{__('general.web.product.image')}}</label>
                        <div class="div-input">
                            <input type="file" id="image2" ref="fileupload2" data-index="2" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                            <error :errors="__e(errors,'image2')"></error>
                        </div>
                    </div>
                    <div v-if="count_images >= 4" class="form-file mt-5 mb-10">
                        <label for="image3">{{__('general.web.product.image')}}</label>
                        <div class="div-input">
                            <input type="file" id="image3" data-index="3" ref="fileupload3" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                            <error :errors="__e(errors,'image3')"></error>
                        </div>
                    </div>
                    <div v-if="count_images >= 5" class="form-file mt-5 mb-10">
                        <label for="image4">{{__('general.web.product.image')}}</label>
                        <div class="div-input">
                            <input type="file" id="image4" ref="fileupload4" data-index="4" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                            <error :errors="__e(errors,'image4')"></error>
                        </div>
                    </div>

                    <div class="flex justify-center mx-auto p-2 mt-3">
                        <a @click="setTab(1)"  class="modal-previous-next dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <{{__('general.web.previous')}}
                        </a>
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
                </div>

            </form>
        </template>
    </Modal>
</template>

<script>
import axios from "axios";
import Modal from "../../utils/Modal";
import Error from "../../utils/Error";

function initialState() {
    return {
        product: {
            sku: '',
            name_en: '',
            name_es: '',
            description_es: '',
            description_en: '',
            price: '',
            taxes: '',
            status: '',
            stock: '',
        },
        images: [{}, {}, {}, {}, {}],
        tab: 1,
        count_images: 1,
        category_id: '',
        errors: [],
        categories: [],
    }
}

export default {
    name: "ProductAdd.vue",
    components: {
        Modal,
        Error,
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
    computed: {
        getTabPage1: function() {
            return {
                'active-tab active dark:bg-dimgray dark:text-orangePantone': this.tab === 1,
                'inactive-tab dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300': this.tab !== 1,
            }
        },
        getTabPage2: function() {
            return {
                'active-tab active dark:bg-dimgray dark:text-orangePantone': this.tab === 2,
                'inactive-tab dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300': this.tab !== 2,
            }
        },
    },
    methods: {
        addImage(e) {
            this.count_images++;
        },
        setTab(tab){
          this.tab = tab
        },

        onChange(e) {
            this.images[e.target.dataset.index] = e.target.files[0];
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
            data.append('price', this.product.price);
            data.append('taxes', this.product.taxes);
            data.append('category_id', this.category_id);
            data.append('status', this.product.status);
            data.append('stock', this.product.stock);
            let i = 0
            for(let image of this.images) {
                if(image instanceof File) {
                    data.append('images[' + i + ']', image);
                }
                i++
            }
            // data.append('images', this.images);


            axios.post('/evertec/mercatodo/public/api/admin/products',
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
                .get('/evertec/mercatodo/public/api/admin/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
        reset: function (){
            Object.assign(this.$data, initialState());
            this.$refs.fileupload0.value=null;
            this.$refs.fileupload1.value=null;
            this.$refs.fileupload2.value=null;
            this.$refs.fileupload3.value=null;
            this.$refs.fileupload4.value=null;
        }
    },
}
</script>



