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
                                ID
                            </th>
                            <th>
                                {{ __('general.web.order.reference') }}
                            </th>
                            <th>
                                {{ __('general.web.order.customer') }}
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
                                    <p class="text-gray-900 whitespace-no-wrap">{{ order.id }}</p>
                                </td>
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
                                    <p class="text-gray-900 whitespace-no-wrap">{{ order.first_name }} {{ order.last_name }}  </p>
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
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span class="absolute inset-0 rounded-full" :class="order.status === 'approved'  ? 'bg-greenTemLight' : order.status === 'rejected' ? 'bg-red-300': 'bg-yellowLight'"></span>
                                         <span class="relative uppercase">{{ __('general.web.payment.' + order.status) }}</span>
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
            <div class="flex justify-center w-1/2 mx-auto my-3">
                <pagination :pagination="pagination" @paginate="getAllOrders" :offset="4"/>
            </div>
        </div>
        <order-index-modal :order="currentOrder" :isVisible="isOpenShow" :order_details="order_details" @close="close"></order-index-modal>
    </div>
</template>

<script>
import Logo from "../utils/Logo";
import axios from "axios";
import OrderIndexModal from "./modals/OrderIndexModal";
import Pagination from "../utils/Pagination";

export default {
    name: "OrderHistory",
    components: {
        Logo,
        OrderIndexModal,
        Pagination,
    },
    data() {
        return {
            isOpenShow: false,
            orders: [],
            currentOrder: {},
            order_details: [],
            pagination: {},
        }
    },
    mounted() {
        this.getAllOrders()
    },
    methods:{
        getAllOrders:  function () {

            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage: 1;

            axios
                .get(`/evertec/mercatodo/public/api/admin/orders?page=${pageNum}`)
                .then(response => {
                    this.orders = response.data.orders.data;
                    this.pagination = response.data.orders;
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
