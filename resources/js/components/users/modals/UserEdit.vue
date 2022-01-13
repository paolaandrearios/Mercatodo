<template>

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
                        <h3 class="mx-auto mb-2 text-center font-bold text-dimGray text-2xl">{{__('general.web.user.edit-user')}}</h3>
                        <svg
                            @click="close()"
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
                                <td>{{user.id}}</td>
                            </tr>
                            <tr>
                                <td>{{__('general.web.user.name')}}</td>
                                <td>
                                    <input
                                        type="text"
                                        v-model="user.name"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('general.web.user.email')}}</td>
                                <td>{{user.email}}</td>
                            </tr>

                        </table>

                        <div class="text-center p-2 mt-3">
                            <button
                                @click="isOpenEdit = false"
                                class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                            >
                                {{__('general.web.close')}}
                            </button>
                            <button
                                class="px-6 py-2 ml-2 text-white bg-orangePantone rounded"
                                v-on:click="update"
                            >
                                {{__('general.web.save')}}
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

    props: {
        edit: Boolean,
        user: Object,
    },
    emits: ['close'],
    data() {
        return {
            isOpenEdit: false,
        }
    },

    methods: {

        close: function() {
            this.$emit('close')
        },

        update: function () {
            axios.put('/evertec/mercatodo/public/api/users/' + this.user.id,
                this.user
            ).then(response => {
                alert(response.data.message)
                this.close()
            }).catch(error => {
                alert(JSON.stringify(error.response.data.errors))
            })
        },
    },

    watch: {
        edit: function(newVal, oldVal) {
            this.isOpenEdit = newVal
        }
    }
}

</script>


