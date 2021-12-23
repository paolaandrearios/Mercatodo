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
                            </tr>
                            <tr v-for="user in users">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                            </tr>
                        </table>
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
        }
    },
    mounted() {
        console.log('Component mounted.')
        axios
            .get('/evertec/mercatodo/public/api/users')
            .then(response => (this.users = response.data))
    }
}
</script>
