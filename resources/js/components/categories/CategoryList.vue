<template>
    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{ __('general.web.category.category_list') }}</div>
                    <div class="section__container--add">
                        <button v-on:click="add()">
                            <i class="fas fa-plus-circle pr-1 text-white"></i>{{ __('general.web.category.add') }}
                        </button>
                    </div>
                    <div class="table__container">
                        <table>
                            <thead class="table__container--header">
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('general.web.category.name') }}</th>
                                    <th>{{ __('general.web.category.type') }}</th>
                                    <th>{{ __('general.web.category.status') }}</th>
                                    <th>{{ __('general.web.category.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table__container--body">
                                <tr v-for="category in categories">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category['name_' + __locale()] }}</td>
                                    <td>
                                        <span>{{ __('general.web.category.' + category.type) }}</span>
                                    </td>
                                    <td>
                                        <span>{{ __('general.web.category.' + category.status) }}</span>
                                    </td>
                                    <td>
                                        <a v-on:click="show(category)">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        |
                                        <a v-on:click="edit(category)">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        |
                                        <a v-if="category.status === 'inactive'" v-on:click="setActive(category)">
                                            <i class="far fa-check-square font-extrabold text-greenTem"></i>
                                        </a>
                                        <a v-if="category.status === 'active'" v-on:click="setInactive(category)">
                                            <i class="fas fa-ban font-extrabold text-red-600"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-auto my-3 flex w-1/2 justify-center">
                        <pagination :pagination="pagination" @paginate="getAllCategories" :offset="4" />
                    </div>
                </div>
            </div>
        </div>

        <category-add :isOpenAdd="isOpenAdd" @close="close" @getAllCategories="getAllCategories"></category-add>
        <category-show :isOpenShow="isOpenShow" :category="currentCategory" @close="close"></category-show>
        <category-edit
            :isOpenEdit="isOpenEdit"
            :category="currentCategory"
            @close="close"
            @getAllCategories="getAllCategories"
        ></category-edit>
    </div>
</template>

<script>
import axios from 'axios';
import CategoryAdd from './modals/CategoryAdd';
import CategoryShow from './modals/CategoryShow';
import CategoryEdit from './modals/CategoryEdit';
import Pagination from '../utils/Pagination';

export default {
    name: 'CategoryList',
    components: {
        CategoryAdd,
        CategoryShow,
        CategoryEdit,
        Pagination,
    },

    data() {
        return {
            categories: [],
            currentCategory: {},
            isOpenAdd: false,
            isOpenShow: false,
            isOpenEdit: false,
            pagination: {},
        };
    },
    mounted() {
        this.getAllCategories();
    },
    methods: {
        getAllCategories: function () {
            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage : 1;

            axios.get(`/evertec/mercatodo/public/api/admin/categories?page=${pageNum}`).then((response) => {
                this.categories = response.data.categories.data;
                this.pagination = response.data.categories;
            });
        },
        add: function () {
            this.isOpenAdd = true;
        },
        show: function (category) {
            this.currentCategory = category;
            this.isOpenShow = true;
        },
        edit: function (category) {
            this.currentCategory = category;
            this.isOpenEdit = true;
        },
        close: function () {
            this.isOpenAdd = false;
            this.isOpenShow = false;
            this.isOpenEdit = false;
        },
        setActive: function (category) {
            axios
                .put('/evertec/mercatodo/public/api/admin/categories/' + category.id + '/status/active')
                .then((response) => {
                    this.getAllCategories();
                    alert(response.data.message);
                });
        },
        setInactive: function (category) {
            axios
                .put('/evertec/mercatodo/public/api/admin/categories/' + category.id + '/status/inactive')
                .then((response) => {
                    this.getAllCategories();
                    alert(response.data.message);
                });
        },
    },
};
</script>
