<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listado de Usuarios</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Id</td>
                                <td>Nombre</td>
                                <td>Email</td>
                                <td>Estado</td>
                                <td>Acción</td>
                            </tr>
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
                                        <i class="far fa-check-square"></i>
                                    </a>
                                    <a v-if="user.status === 'active'" v-on:click="setInactive(user)" >
                                        <i class="fas fa-ban"></i>
                                    </a>
                                </td>
                            </tr>
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
          bg-gray-700 bg-opacity-50
        "
                >
                    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl">Editar usuario</h3>
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
                        <div class="mt-4">
                            <table>
                                <tr>
                                    <td>Id</td>
                                    <td>{{currentUser.id}}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>
                                        <input
                                            type="text"
                                            v-model="currentUser.name"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{currentUser.email}}</td>
                                </tr>
                            </table>
                            <button
                                @click="isOpenEdit = false"
                                class="px-6 py-2 text-blue-800 border border-blue-600 rounded"
                            >
                                Cerrar
                            </button>
                            <button
                                class="px-6 py-2 ml-2 text-blue-100 bg-blue-600 rounded"
                                v-on:click="update"
                            >
                                Guardar
                            </button>
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
                    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl">Ver usuario</h3>
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
                                    <td>Nombre</td>
                                    <td>{{currentUser.name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{currentUser.email}}</td>
                                </tr>
                            </table>
                            <button
                                @click="isOpenShow = false"
                                class="px-6 py-2 text-blue-800 border border-blue-600 rounded"
                            >
                                Cerrar
                            </button>
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
