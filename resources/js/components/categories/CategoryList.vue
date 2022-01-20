<template>

    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{__('general.web.category.category_list')}}</div>
                    <div class="section__container--add">
                        <button  v-on:click="add()"><i class="text-white pr-1 fas fa-plus-circle"></i>{{__('general.web.category.add')}}</button>
                    </div>
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
                                    <a v-on:click="show(category)" >
                                        <i class="fas fa-eye"></i>
                                    </a> |
                                    <a v-on:click="edit(category)" >
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a v-if="category.status === 'inactive'" v-on:click="setActive(category)" >
                                        <i class="far fa-check-square text-greenTem font-extrabold"></i>
                                    </a>
                                    <a v-if="category.status === 'active'" v-on:click="setInactive(category  )" >
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

        <category-form :isOpenAdd="isOpenAdd" @close="close"></category-form>
        <category-show :isOpenShow="isOpenShow" :category="currentCategory" @close="close"></category-show>
        <category-edit :isOpenEdit="isOpenEdit" :category="currentCategory" @close="close" @getAllCategories="getAllCategories"></category-edit>

    </div>
</template>

<script>
import axios from 'axios';
import CategoryForm from "./modals/CategoryForm";
import CategoryShow from "./modals/CategoryShow";
import CategoryEdit from "./modals/CategoryEdit";

export default {

    name: "CategoryList",
    components: {
        CategoryForm,
        CategoryShow,
        CategoryEdit,
    },

    data () {
        return {
            categories: [],
            currentCategory: {},
            isOpenAdd: false,
            isOpenShow: false,
            isOpenEdit: false,
        }
    },
    mounted() {
        this.getAllCategories()
    },
    methods: {
        getAllCategories:  function () {
            axios
                .get('/evertec/mercatodo/public/api/categories')
                .then(response => (this.categories = response.data.categories.data))
        },
        add: function () {
            this.isOpenAdd = true
        },
        show: function(category) {
            this.currentCategory = category
            this.isOpenShow = true
        },
        edit: function(category) {
            this.currentCategory = category
            this.isOpenEdit = true
        },
        close: function () {
            this.isOpenAdd = false;
            this.isOpenShow = false;
            this.isOpenEdit = false;
        },
        setActive: function(category) {
            axios.put('/evertec/mercatodo/public/api/categories/'+category.id+'/status/active').then(response => {
                this.getAllCategories()
                alert(response.data.message)
            })
        },
        setInactive: function(category) {
            axios.put('/evertec/mercatodo/public/api/categories/'+category.id+'/status/inactive').then(response => {
                this.getAllCategories()
                alert(response.data.message)
            })
        },

    }
};

</script>

