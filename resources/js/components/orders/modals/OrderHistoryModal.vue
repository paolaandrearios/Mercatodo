<template>
    <div class="">
        <div class="modal__container font-poppins">
            <div
                v-if="isVisible"
                class="modal__container--bg"
            >
                <div class="text-xs md:text-sm p-2 overflow-x-hidden p-6 bg-white rounded-md shadow-xl overflow-y-scroll w-5/6 h-11/12 mx-auto">
                    <div class="py-14 px-4 md:px-6 2xl:px-20">

                        <div class="flex justify-start item-start space-y-2 flex-col">
                            <h1 class="text-xl lg:text-2xl font-semibold leading-7 lg:leading-9 text-gray-800">Order 911AF8B8</h1>
                            <p class="text-base font-medium leading-6 text-gray-600">2022-03-17</p>
                        </div>
                        <div class="mt-10 flex flex-col xl:flex-row justify-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                                <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                                    <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">Customer’s Cart</p>
                                    <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                        <div class="pb-4 md:pb-8 w-full md:w-32">
                                            <img class="w-full" :src="__asset('images/fashion.jpg')"/>
                                        </div>
                                        <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                            <div class="w-full flex flex-col justify-start items-start space-y-8">
                                                <h3 class="text-sm font-semibold leading-6 text-gray-800">Gym T-shirt</h3>
                                                <div class="flex justify-start items-start flex-col">
                                                    <p class="text-sm leading-none text-gray-800">Sport</p>
                                                </div>
                                            </div>
                                            <div class="flex justify-between space-x-8 items-start w-full">
                                                <p class="text-base xl:text-sm leading-6">$25000</p>
                                                <p class="text-base xl:text-sm leading-6 text-gray-800">1</p>
                                                <p class="text-base xl:text-sm font-semibold leading-6 text-gray-800">$25000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Summary</h3>
                                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                                            <div class="flex justify-between w-full">
                                                <p class="text-base leading-4 text-gray-800">Subtotal</p>
                                                <p class="text-base leading-4 text-gray-600">$22000</p>
                                            </div>
                                            <div class="flex justify-between items-center w-full">
                                                <p class="text-base leading-4 text-gray-800">Taxes</p>
                                                <p class="text-base leading-4 text-gray-600">$3000</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center w-full">
                                            <p class="text-base font-semibold leading-4 text-gray-800">Total</p>
                                            <p class="text-base font-semibold leading-4 text-gray-600">$25000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                                <h3 class="text-xl font-semibold leading-5 text-gray-800">Customer</h3>
                                <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                                    <div class="flex flex-col justify-start items-start flex-shrink-0">
                                        <div class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                            <div class="flex justify-start items-start flex-col space-y-2">
                                                <p class="text-base font-semibold leading-4 text-left text-gray-800">Andrea Ramírez</p>
                                            </div>
                                        </div>

                                        <div class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                            <i class="fas fa-envelope text-orangePantone"></i>
                                            <p class="text-sm leading-5 ">prueba@gmail.com</p>
                                            <i class="fas fa-mobile-alt text-orangePantone font-bold"></i>
                                            <p class="cursor-pointer text-sm leading-5 ">3149887454</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                                        <div class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                                            <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                                                <p class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">Shipping Address</p>
                                                <p class="w-48 lg:w-full xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600">Calle 35 44 39<span class="m-2"> - Medellín</span></p>
                                            </div>
                                            <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4">
                                                <p class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">Note (for delivery)</p>
                                                <p class="w-48 lg:w-full xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600">Building next to school</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 md:px-6 2xl:px-20">
                        <div class="flex justify-start item-start space-y-2 flex-col mb-3">
                            <h1 class="text-xl lg:text-2xl font-semibold leading-7 lg:leading-9 text-gray-800">Payment Records</h1>
                        </div>
                        <div class="flex w-full justify-end mr-10">
                            <button @click="show" class="mt-6 md:mt-0 py-5 bg-greenTem opacity-75 hover:bg-greenTem hover:opacity-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 w-1/5 text-base font-bold leading-4 text-black">Retry Payment</button>
                        </div>
                        <div class="mx-auto px-4 sm:px-8 py-4 overflow-x-auto w-5/6">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full w-5/6 leading-normal">
                                    <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('general.web.order.date') }}
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('general.web.payment.payment_attempt') }}
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('general.web.order.total') }}
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('general.web.order.status') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">Jan 21, 2020</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">AOFNHD357</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">$25000</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Rejected
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full justify-center items-center mt-5">
                        <button @click="close" class="mt-6 md:mt-0 py-5 bg-orangePantone hover:bg-orange-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 w-96 2xl:w-full text-base font-bold leading-4 text-white">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <checkout-modal :isVisible="isOpenShow" @close="closeModal"></checkout-modal>
    </div>

</template>

<script>

import CheckoutModal from "./CheckoutModal";

export default {
    name: "OrderHistoryModal.vue",

    components: {
        CheckoutModal,
    },
    props: {
        isVisible: Boolean,
    },
    emits: ['close'],
    data() {
        return {
            isOpenShow: false,
        }
    },
    methods: {
        show: function() {
            this.isOpenShow = true;
        },
        closeModal: function () {
            this.isOpenShow = false;
        },
        close: function() {
            this.$emit('close')
        },
    },
}
</script>

