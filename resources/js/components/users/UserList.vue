<template>
    <div class="section__container">
        <div>
            <div>
                <div>
                    <div class="section__container--title">{{ __('general.web.user.user_list') }}</div>

                    <div class="table__container">
                        <table>
                            <thead class="table__container--header">
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('general.web.user.name') }}</th>
                                    <th>{{ __('general.web.user.email') }}</th>
                                    <th>{{ __('general.web.user.status') }}</th>
                                    <th>{{ __('general.web.user.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table__container--body">
                                <tr v-for="user in users">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span>{{ __('general.web.user.' + user.status) }}</span>
                                    </td>
                                    <td>
                                        <a v-on:click="show(user)">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        |
                                        <a v-on:click="edit(user)">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        |
                                        <a v-if="user.status === 'inactive'" v-on:click="setActive(user)">
                                            <i class="far fa-check-square font-extrabold text-greenTem"></i>
                                        </a>
                                        <a v-if="user.status === 'active'" v-on:click="setInactive(user)">
                                            <i class="fas fa-ban font-extrabold text-red-600"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-auto my-3 flex w-1/2 justify-center">
                        <pagination :pagination="pagination" @paginate="getAllUsers" :offset="4" />
                    </div>
                </div>
            </div>
        </div>

        <user-edit :edit="isOpenEdit" :user="currentUser" @close="close"></user-edit>
        <user-show :show="isOpenShow" :user="currentUser" @close="close"></user-show>
    </div>
</template>

<script>
import axios from 'axios';
import UserEdit from './modals/UserEdit';
import UserShow from './modals/UserShow';
import Pagination from '../utils/Pagination';

export default {
    name: 'UserList',

    components: {
        UserShow,
        UserEdit,
        Pagination,
    },
    data() {
        return {
            users: [],
            currentUser: { id: '', name: '' },
            isOpenEdit: false,
            isOpenShow: false,
            pagination: {},
        };
    },
    mounted() {
        this.getAllUsers();
    },
    methods: {
        getAllUsers: function () {
            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage : 1;

            axios.get(`/evertec/mercatodo/public/api/admin/users?page=${pageNum}`).then((response) => {
                this.users = response.data.data;
                this.pagination = response.data;
            });
        },

        edit: function (user) {
            this.currentUser = user;
            this.isOpenEdit = true;
        },

        show: function (user) {
            this.currentUser = user;
            this.isOpenShow = true;
        },

        close: function () {
            this.isOpenShow = false;
            this.isOpenEdit = false;
        },

        setActive: function (user) {
            axios.put('/evertec/mercatodo/public/api/admin/users/' + user.id + '/status/active').then((response) => {
                this.getAllUsers();
                alert(response.data.message);
            });
        },
        setInactive: function (user) {
            axios.put('/evertec/mercatodo/public/api/admin/users/' + user.id + '/status/inactive').then((response) => {
                this.getAllUsers();
                alert(response.data.message);
            });
        },
    },
};
</script>
