<template>
    <div class="orderHistory">
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-2xl text-gray-600 font-semibold">{{ __('general.sidebar.customer_orders') }}</h2>
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
                        <tbody v-for="(order, index) in orders" :key="index" >
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-15 h-15 items-center">
                                            <img alt="image-product" class="w-full" :src="__asset(order.order_details[0].product.images[0].url)"/>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ order.reference }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-gray-900 whitespace-no-wrap">{{ order.address }}</p>
                                </td>
                                <td>
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ order.city }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ __currencyFormat(order.total) }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ __dateFormat(order.updated_at) }}
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
                                    <button class="orderHistory__button" @click="show(order)">
                                        {{ __('general.web.show') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <order-index-modal :order="currentOrder" :isVisible="isOpenShow" :order_details="order_details" @close="close"></order-index-modal>
    </div>
</template>

<script>
import Logo from "../utils/Logo";
import axios from "axios";
import OrderIndexModal from "./modals/OrderIndexModal";

export default {
    name: "OrderHistory",
    components: {
        Logo,
        OrderIndexModal,
    },
    data() {
        return {
            isOpenShow: false,
            orders: [],
            currentOrder: {},
            order_details: [],
        }
    },
    mounted() {
        this.getAllOrders()
    },
    methods:{
        getAllOrders:  function () {
            axios
                .get('/evertec/mercatodo/public/api/admin/orders')
                .then(response => {
                    this.orders = response.data.orders;
                })
        },
        getOrder:  function (order) {
            axios
                .get('/evertec/mercatodo/public/api/admin/orders/order/' + order.id)
                .then(response => {
                    this.currentOrder = response.data.order;
                    this.order_details = this.currentOrder.order_details;
                })
        },
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        },
        show: function(order) {
            this.isOpenShow = true;
            this.currentOrder = order;
            this.getOrder(order);
        },
        close: function () {
            this.isOpenShow = false;
        },
    }
}
</script>

<style scoped>

</style>
