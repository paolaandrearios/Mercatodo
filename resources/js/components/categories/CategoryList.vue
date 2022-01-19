<template>

    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{__('general.web.category.category_list')}}</div>

                    <div class="table__container">
                        <table>
                            <thead class="table__container--header">
                            <tr>
                                <th>Id</th>
                                <th>{{__('general.web.category.name')}}</th>
                                <th>{{__('general.web.category.type')}}</th>
                                <th>{{__('general.web.category.status')}}</th>
                                <th>{{__('general.web.category.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table__container--body">
                            <tr v-for="category in categories">
                                <td>{{category.id}}</td>
                                <td>{{category.name}}</td>
                                <td>
                                    <span>{{__('general.web.category.'+ category.type)}}</span>
                                </td>
                                <td>
                                    <span>{{__('general.web.category.'+ category.status)}}</span>
                                </td>
                                <td>
                                    <a v-on:click="" >
                                        <i class="fas fa-eye"></i>
                                    </a> |
                                    <a v-on:click="" >
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a v-if="category.status === 'inactive'" v-on:click="" >
                                        <i class="far fa-check-square text-greenTem font-extrabold"></i>
                                    </a>
                                    <a v-if="category.status === 'active'" v-on:click="" >
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

    name: "CategoryList",

    data () {
        return {
            categories: [],
        }
    },
    mounted() {
        this.getAllCategories()
    },
    methods: {
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories))
        },

    }
};

</script>

