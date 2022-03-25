<template>
    <div class="modal">
        <div class="modal__container">
            <div
                v-if="isVisible"
                class="modal__container--bg"
            >
                <div class="modal__content">
                    <div class="modal__content--header flex-col">
                        <h3 class="text-dimGray mx-auto text-sm md:text-lg">
                            {{__('general.web.order.our_payment_gateway')}}
                        </h3>
                        <img class="w-40 mx-auto" :src="__asset('images/evertec.png')"/>
                    </div>
                    <p class="mx-5 mb-4 text-sm text-center">
                        {{__('general.web.order.click_button_gateway')}} <br>
                    </p>
                    <p class="text-greenTem font-bold my-5 text-center">
                        {{__('general.web.order.pay_with_confidence')}}
                    </p>
                    <div class="flex justify-between">
                        <button class="flex justify-center w-1/2 px-4 py-2 m-2 text-white bg-orangePantone hover:bg-orange-600 rounded-xl hover:bg-greenTem focus:bg-greenTem focus:outline-none items-center" @click="pay">
                            <div v-if="show_spin">
                                <svg class="animate-spin h-5 w-5 mr-3 text-gray-200 ..."  viewBox="0 0 100 101">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="blue"/>
                                </svg>
                            </div>
                            <div>
                                {{__('general.web.order.continue_payment')}}
                            </div>
                        </button>
                        <button class="flex justify-center w-1/2 px-4 py-2 m-2 text-white bg-gray-400 hover:bg-gray-600 rounded-xl hover:bg-gray-400 focus:outline-none items-center" @click="close()">
                            <div>
                                {{__('general.web.order.cancel')}}
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "Modal.vue",

    props: {
        isVisible: Boolean,
        payment: Object,
    },
    emits: ['close'],
    data() {
        return {
            show_spin: false,
        }
    },
    methods: {
        pay(){
            this.show_spin = true;
            window.location.href = this.payment.url;
        },
        close: function() {
            this.$emit('close')
        },
    },
}
</script>

