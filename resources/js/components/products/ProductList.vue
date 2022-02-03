<template>

    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{__('general.web.product.product_list')}}</div>
                    <div class="section__container--add">
                        <button v-on:click="add()"><i class="text-white pr-1 fas fa-plus-circle"></i>{{__('general.web.product.add')}}</button>
                    </div>
                    <div class="table__container">
                        <table>
                            <thead class="table__container--header">
                            <tr>
                                <th>Id</th>
                                <th>{{__('general.web.product.name')}}</th>
                                <th>{{__('general.web.product.price')}}</th>
                                <th>{{__('general.web.product.stock')}}</th>
                                <th>{{__('general.web.product.status')}}</th>
                                <th>{{__('general.web.product.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table__container--body">
                            <tr v-for="product in products">
                                <td>{{product.id}}</td>
                                <td>{{product['name_' + __locale()]}}</td>
                                <td>{{product.price}}</td>
                                <td>{{product.stock}}</td>
                                <td>
                                    <span>{{__('general.web.product.'+ product.status)}}</span>
                                </td>
                                <td>
                                    <a v-on:click="show(product)" >
                                        <i class="fas fa-eye"></i>
                                    </a> |
                                    <a v-on:click="edit(product)" >
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a v-if="product.status === 'inactive'" v-on:click="setActive(product)" >
                                        <i class="far fa-check-square text-greenTem font-extrabold"></i>
                                    </a>
                                    <a v-if="product.status === 'active'" v-on:click="setInactive(product)" >
                                        <i class="fas fa-ban text-red-600 font-extrabold"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :pagination="pagination" @paginate="getAllProducts" :offset="4"/>
                    </div>
                </div>
            </div>
        </div>

        <product-add :isOpenAdd="isOpenAdd" @close="close" @getAllProducts="getAllProducts"></product-add>
        <product-show :isOpenShow="isOpenShow" :product="currentProduct" @close="close" ></product-show>
        <product-edit :isOpenEdit="isOpenEdit" :product="currentProduct" :categoryId="currentCategory" @close="close" @getAllProducts="getAllProducts"></product-edit>

    </div>
</template>

<script>
import axios from 'axios';
import ProductAdd from "./modals/ProductAdd";
import ProductEdit from "./modals/ProductEdit";
import ProductShow from "./modals/ProductShow";
import Pagination from "../utils/Pagination";


export default {

    name: "ProductList",
    components: {
        ProductAdd,
        ProductEdit,
        ProductShow,
        Pagination,
    },

    data () {
        return {
            products: [],
            currentProduct: {},
            currentCategory: 0,
            isOpenAdd: false,
            isOpenEdit: false,
            isOpenShow: false,
            pagination: {},
        }
    },
    mounted() {
        this.getAllProducts()
    },
    methods: {
        getAllProducts:  function () {

            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage: 1;

            axios
                .get(`/evertec/mercatodo/public/api/products?page=${pageNum}`)
                .then(response => {
                    this.products = response.data.products.data
                    this.pagination = response.data.products

                })
        },
        add: function () {
            this.isOpenAdd = true;
        },
        edit: function(product) {
            this.currentProduct = product;
            this.currentCategory = product.categories[0].id;
            this.isOpenEdit = true;
        },
        show: function(product) {
            this.currentProduct = product;
            this.isOpenShow = true;
        },
        close: function () {
            this.isOpenAdd = false;
            this.isOpenEdit = false;
            this.isOpenShow = false;
        },
        setActive: function(product) {
            axios.put('/evertec/mercatodo/public/api/products/'+product.id+'/status/active').then(response => {
                this.getAllProducts()
                alert(response.data.message)
            })
        },
        setInactive: function(product) {
            axios.put('/evertec/mercatodo/public/api/products/'+product.id+'/status/inactive').then(response => {
                this.getAllProducts()
                alert(response.data.message)
            })
        },
    }
};

</script>

