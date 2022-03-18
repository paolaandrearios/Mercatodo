<template>
    <div class="orderHistory">
        <div class="orderHistory__header">
            <logo class="text-xl md:text-2xl"></logo>
            <button class="orderHistory__header--button" @click="goHome()">
                <i class="fas fa-home"></i>
            </button>
        </div>
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-2xl text-gray-600 font-semibold">{{ __('general.web.order.your_orders') }}</h2>
            </div>
        </div>
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="orderHistory__container">
                    <table class="orderHistory__container--table">
                        <thead>
                        <tr>
                            <th>
                                {{ __('general.web.order.reference') }}
                            </th>
                            <th>
                                {{ __('general.web.order.address') }}
                            </th>
                            <th>
                                {{ __('general.web.order.city') }}
                            </th>
                            <th>
                                {{ __('general.web.order.total') }}
                            </th>
                            <th>
                                {{ __('general.web.order.date') }}
                            </th>
                            <th>
                                {{ __('general.web.order.status') }}
                            </th>
                            <th>
                                ...
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
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
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">Calle 45 7841</p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    Medellín
                                </p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    250261.78
                                </p>
                            </td>
                            <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    Jan 21, 2020
                                </p>
                            </td>
                            <td>
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span class="absolute inset-0 bg-greenTem opacity-50 rounded-full"></span>
                                     <span class="relative">Pagado</span>
                                </span>
                            </td>
                            <td>
                                <button class="orderHistory__button" @click="show">
                                    {{ __('general.web.show') }}
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
