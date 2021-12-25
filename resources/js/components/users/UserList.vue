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
                                <td>Name</td>
                                <td>Email</td>
                                <td>Acción</td>
                            </tr>
                            <tr v-for="user in users">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>
                                    <a v-on:click="edit(user)" >Editar</a>
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
                    v-show="isOpen"
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
                                @click="isOpen = false"
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
                                @click="isOpen = false"
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

    </div>
</template>

<script>
import axios from 'axios'
export default {
    data () {
        return {
            users: [],
            currentUser: {id:'', name: ''},
            isOpen: false,
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
            this.isOpen = true
        },
        update: function () {
            axios.put('/evertec/mercatodo/public/api/users/' + this.currentUser.id,
                this.currentUser
            ).then(response => {
                alert(response.data.message)

            }).catch(error => {
                alert(JSON.stringify(error.response.data.errors))
            })
        }
    }
}
</script>
