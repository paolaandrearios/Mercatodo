<template>

    <div class="users__container">
        <div class="">
            <div class="">
                <div class="">
                    <div class="users__container--title">User List</div>

                    <div class="users__tableContainer">
                        <table>
                            <thead class="users__table--header">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="users__table--body">
                                <tr v-for="user in users">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>
                                        <span v-if="user.status === 'active'">Activo</span>
                                        <span v-if="user.status === 'inactive'">Inactivo</span>
                                    </td>
                                    <td>
                                        <a v-on:click="show(user)" >
                                            <i class="fas fa-eye"></i>
                                        </a> |
                                        <a v-on:click="edit(user)" >
                                            <i class="fas fa-edit"></i>
                                        </a> |
                                        <a v-if="user.status === 'inactive'" v-on:click="setActive(user)" >
                                            <i class="far fa-check-square text-greenTem font-extrabold"></i>
                                        </a>
                                        <a v-if="user.status === 'active'" v-on:click="setInactive(user)" >
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

        <div class="container mx-auto">
            <div class="flex justify-center">

                <div
                    v-show="isOpenEdit"
                    class="
                      absolute
                      inset-0
                      flex
                      items-center
                      justify-center
                      bg-gray-700 bg-opacity-50"
                >
                    <div class="text-sm p-2 max-w-2xl p-6 bg-white rounded-md shadow-xl">
                        <div class="flex items-center justify-between">
                            <h3 class="mx-auto mb-2 text-center font-bold text-dimGray text-2xl">Edit User</h3>
                            <svg
                                @click="isOpenEdit = false"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-red-900 cursor-pointer"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <td>Id</td>
                                    <td>{{currentUser.id}}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>
                                        <input
                                            type="text"
                                            v-model="currentUser.name"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{currentUser.email}}</td>
                                </tr>

                            </table>

                            <div class="text-center p-2 mt-3">
                                <button
                                    @click="isOpenEdit = false"
                                    class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                                >
                                    Close
                                </button>
                                <button
                                    class="px-6 py-2 ml-2 text-white bg-orangePantone rounded"
                                    v-on:click="update"
                                >
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto">
            <div class="flex justify-center">

                <div
                    v-show="isOpenShow"
                    class="
                      absolute
                      inset-0
                      flex
                      items-center
                      justify-center
                      bg-gray-700 bg-opacity-50
        "
                >
                    <div class="text-sm max-w-2xl p-6 bg-white rounded-md shadow-xl">
                        <div class="flex items-center justify-between">
                            <h3 class="mx-auto mb-2 font-bold text-dimGray text-2xl">Show User</h3>
                            <svg
                                @click="isOpenShow = false"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-red-900 cursor-pointer"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div class="mt-4">
                            <table>
                                <tr>
                                    <td>Id</td>
                                    <td>{{currentUser.id}}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{currentUser.name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{currentUser.email}}</td>
                                </tr>
                            </table>

                            <div class="text-center p-2 mt-3">
                                <button
                                    @click="isOpenShow = false"
                                    class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                                >
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
export default {
    data () {
        return {
            users: [],
            currentUser: {id:'', name: ''},
            isOpenEdit: false,
            isOpenShow: false,
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getAllUsers()
    },
    methods: {
        getAllUsers:  function () {
            axios
                .get('/evertec/mercatodo/public/api/users')
                .then(response => (this.users = response.data))
        },
        edit: function(user){
            this.currentUser = user
            this.isOpenEdit = true
        },
        update: function () {
            axios.put('/evertec/mercatodo/public/api/users/' + this.currentUser.id,
                this.currentUser
            ).then(response => {
                alert(response.data.message)
                this.isOpenEdit = false
            }).catch(error => {
                alert(JSON.stringify(error.response.data.errors))
            })
        },
        setActive: function(user) {
            axios.put('/evertec/mercatodo/public/api/users/'+user.id+'/status/active').then(response => {
                this.getAllUsers()
                alert(response.data.message)
            })
        },
        setInactive: function(user) {
            axios.put('/evertec/mercatodo/public/api/users/'+user.id+'/status/inactive').then(response => {
                this.getAllUsers()
                alert(response.data.message)
            })
        },
        show: function(user){
            this.currentUser = user
            this.isOpenShow = true
        }
    }
}
</script>

