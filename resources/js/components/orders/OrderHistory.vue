<template>
    <div class="font-poppins bg-white p-8 rounded-md w-full">
        <div class="flex justify-center md:justify-start items-center mb-5">
            <logo class="text-xl md:text-2xl"></logo>
            <button class="p-1 md:hover:bg-orangePantone rounded-full ml-2 focus:outline-none" @click="goHome()">
                <i class="fas fa-home text-orangePantone text-lg md:text-2xl hover:text-white m-2 cursor-pointer"></i>
            </button>
        </div>
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-2xl text-gray-600 font-semibold">{{ __('general.web.order.your_orders') }}</h2>
            </div>
        </div>
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.reference') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.address') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.city') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.total') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.date') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                {{ __('general.web.order.status') }}
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ...
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-15 h-15 items-center">
                                        <img class="w-full" :src="__asset('images/fashion.jpg')"/>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            E1DB8BC2
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Calle 45 7841</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    Medellín
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    250261.78
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    Jan 21, 2020
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden
                                          class="absolute inset-0 bg-greenTem opacity-50 rounded-full"></span>
                                     <span class="relative">Pagado</span>
                                </span>
                            </td>
                            <td>
                                <button class="p-2 bg-orangePantone rounded-xl text-xs text-white font-bold hover:bg-orange-600 focus:outline-none" @click="show">
                                    Show
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <order-history-modal :isVisible="isOpenShow" @close="close"></order-history-modal>
    </div>
</template>

<script>
import Logo from "../utils/Logo";
import OrderHistoryModal from "./modals/OrderHistoryModal";

export default {
    name: "OrderHistory",
    components: {
        Logo,
        OrderHistoryModal,
    },
    data() {
        return {
            isOpenShow: false,
        }
    },
    methods:{
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        },
        show: function() {
            this.isOpenShow = true;
        },
        close: function () {
            this.isOpenShow = false;
        },
    }
}
</script>

<style scoped>

</style>
