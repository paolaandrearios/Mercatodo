<template>
    <Modal :isVisible="isOpenShow" @close="close">
        <template v-slot:title>
            {{__('general.web.user.show-user')}}
        </template>
        <template v-slot:body>
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
        </template>
    </Modal>

</template>

<script>

import Modal from "../../Modal";

export default {
    props: {
        show: Boolean,
        user: Object
    },
    components: {
        Modal
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
