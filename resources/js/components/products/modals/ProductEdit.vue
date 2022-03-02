<template>
    <Modal :isVisible="isOpenEdit" @close="close">
        <template v-slot:title>
            {{__('general.web.product.edit_product')}}
        </template>
        <template v-slot:body>
            <div>
                <table>
                    <ul class="modal__tabs dark:border-gray-700">
                        <li class="mr-2">
                            <a @click="setTab(1)" aria-current="page" v-bind:class="getTabPage1">{{__('general.web.product.information')}}</a>
                        </li>
                        <li class="mr-2">
                            <a @click="setTab(2)" aria-current="page" v-bind:class="getTabPage2">{{__('general.web.product.images')}}</a>
                        </li>
                    </ul>
                    <div v-if="tab==1">
                        <tr class="mt-5">
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
                                        required
                                        minlength="5"
                                        maxlength="10"
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
                                        required
                                        minlength="4"
                                        maxlength="60"
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
                                    required
                                    minlength="80"
                                    maxlength="400"
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
                                        required
                                        minlength="4"
                                        maxlength="60"
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
                                    required
                                    minlength="80"
                                    maxlength="400"
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
                                        required
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
                                        required
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
                                        required
                                    />
                                    <error :errors="__e(errors,'taxes')"></error>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-table">{{__('general.web.category.category')}}</td>
                            <td>
                                <div v-if="!__isEmpty(product)">
                                    <select class="input-table" id="category" v-model="category_id" required>
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
                                    <select class="input-table" id="status" v-model="product.status" required>
                                        <option value="">{{__('general.web.select')}}</option>
                                        <option value="active">{{__('general.web.product.active')}}</option>
                                        <option value="inactive">{{__('general.web.product.inactive')}}</option>
                                    </select>
                                    <error :errors="__e(errors,'status')"></error>
                                </div>
                            </td>
                        </tr>
                        <div class="flex justify-center mt-5">
                            <a @click="setTab(2)" class="modal-previous-next dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                {{__('general.web.next')}} >
                            </a>
                        </div>
                    </div>
                    <div v-if="tab==2">
                        <div v-show="count_images < 1" class="flex justify-end mt-3">
                            <div class="section__container--add">
                                <button v-on:click="addImage()"><i class="text-white pr-1 fas fa-plus-circle"></i>{{__('general.web.product.add')}}</button>
                            </div>
                        </div>
                        <div v-for="(image, index) in images" :key="index">
                            <tr v-if="!__isEmpty(image)" class="mt-5 mb-10">
                                <td class="label-table">{{__('general.web.product.image')}}</td>
                                <td>
                                    <div>
                                        <img class="w-2/4 mb-2" v-bind:src="__asset(image['url'])"/>
                                        <button>
                                            <input class="overflow-x-scroll" type="file" :ref="'fileupload'+index" :data-index="index" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg" required>
                                        </button>
                                    </div>
                                    <error :errors="__e(errors,'image')"></error>
                                </td>
                            </tr>
                            <div v-show="count_images === 1">
                                <tr v-if="__isEmpty(image)" class="mt-5 mb-10">
                                    <td class="label-table">{{__('general.web.product.image')}}</td>
                                    <div class="div-input">
                                        <input type="file" id="image" :ref="'fileupload'+index" :data-index="index" v-on:change="onChange" accept="image/png,image/jpeg,image/jpg">
                                        <error :errors="__e(errors,'image')"></error>
                                    </div>
                                </tr>
                            </div>
                        </div>
                    </div>
                </table>
                <div v-if="tab==2">
                    <div class="text-center p-2 mt-3">
                        <a @click="setTab(1)"  class="modal-previous-next dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <{{__('general.web.previous')}}
                        </a>
                        <button
                            @click="close()"
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
            </div>
        </template>
    </Modal>
</template>

<script>
import axios from "axios";
import Modal from "../../utils/Modal";
import Error from "../../utils/Error";

function initialState() {
    return {
        images: [{}, {}, {}, {}, {}],
    }
}

export default {
    name: "ProductEdit.vue",
    components: {
        Modal,
        Error,
    },
    props: {
        isOpenEdit: Boolean,
        product: Object,
        category_id: Number,
    },
    data() {
        return {
            errors: [],
            categories: [],
            tab: 1,
            count_images: 0,
            images: [{}, {}, {}, {}, {}],
            updated_images: [0,0,0,0,0],
        }
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

    emits: ['close', 'getAllProducts'],

    methods: {
        addImage(e) {
            this.count_images++;
        },
        setTab(tab){
            this.tab = tab
        },

        onChange(e) {
            if(!(this.images[e.target.dataset.index] instanceof File)){
                this.updated_images[e.target.dataset.index] = this.images[e.target.dataset.index].id
            }
            this.images[e.target.dataset.index] = e.target.files[0];
        },

        close: function() {
            this.errors = [];
            this.$emit('close');
            this.reset();
        },

        update: function () {

            const config = {
                headers: {
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
            data.append('category_id', this.category_id.toString());
            data.append('status', this.product.status);
            data.append('updated_images', this.updated_images)
            let i = 0
            for(let image of this.images) {
                if(image instanceof File) {
                    data.append('images[' + i + ']', image);
                }
                i++
            }
            data.append('_method', 'PUT');

            axios.post('/evertec/mercatodo/public/api/admin/products/' + this.product.id,
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
            this.count_images= 0;
        }
    },


    watch: {
        edit: function(newVal, oldVal) {
            this.isOpenEdit = newVal;
        },
        product: function(newVal, oldVal){
            this.product.images.map((image, index) => {
                this.images[index] = image;
            })
        }
    }
}
</script>



