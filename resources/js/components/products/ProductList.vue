<template>

    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{__('general.web.product.product_list')}}</div>
                    <div class="section__container--add">
                        <button  v-on:click=""><i class="text-white pr-1 fas fa-plus-circle"></i>{{__('general.web.category.add')}}</button>
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
                                <td>{{product.name}}</td>
                                <td>{{product.price}}</td>
                                <td>{{product.stock}}</td>
                                <td>
                                    <span>{{__('general.web.product.'+ product.status)}}</span>
                                </td>
                                <td>
                                    <a v-on:click="" >
                                        <i class="fas fa-eye"></i>
                                    </a> |
                                    <a v-on:click="" >
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a v-if="product.status === 'inactive'" v-on:click="" >
                                        <i class="far fa-check-square text-greenTem font-extrabold"></i>
                                    </a>
                                    <a v-if="product.status === 'active'" v-on:click="" >
                                        <i class="fas fa-ban text-red-600 font-extrabold"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';


export default {

    name: "ProductList",

    data () {
        return {
            products: [],
        }
    },
    mounted() {
        this.getAllProducts()
    },
    methods: {
        getAllProducts:  function () {
            axios
                .get('/evertec/mercatodo/public/api/products')
                .then(response => (this.products = response.data.products.data))
        },
    }
};

</script>

