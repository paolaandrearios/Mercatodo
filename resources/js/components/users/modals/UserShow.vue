<template>

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
                        <h3 class="mx-auto mb-2 font-bold text-dimGray text-2xl">{{__('general.web.user.show-user')}}</h3>
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
                    <div class="mt-4">
                        <table>
                            <tr>
                                <td>Id</td>
                                <td>{{user.id}}</td>
                            </tr>
                            <tr>
                                <td>{{__('general.web.user.name')}}</td>
                                <td>{{user.name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('general.web.user.email')}}</td>
                                <td>{{user.email}}</td>
                            </tr>
                        </table>

                        <div class="text-center p-2 mt-3">
                            <button
                                @click="close()"
                                class="px-6 py-2 text-orangePantone border border-orangePantone rounded font-bold"
                            >
                                {{__('general.web.close')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>

export default {
    props: {
        show: Boolean,
        user: Object
    },
    emits: ['close'],
    data() {
       return {
           isOpenShow: false,
       }
    },

    methods: {
        close: function() {
            this.$emit('close')
        }
    },

    watch: {
        show: function(newVal, oldVal) {
            this.isOpenShow = newVal
        }
    }
}

</script>
