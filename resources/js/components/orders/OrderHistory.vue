<template>
    <div class="container mx-auto">
        <div class="orderHistory">
            <div class="orderHistory__header">
                <logo class="text-xl md:text-2xl"></logo>
                <button class="orderHistory__header--button" @click="goHome()">
                    <i class="fas fa-home"></i>
                </button>
            </div>
            <div class="flex items-center justify-between pb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-600">{{ __('general.web.order.your_orders') }}</h2>
                </div>
            </div>
            <div>
                <div class="-mx-4 overflow-x-auto px-4 py-4 sm:-mx-8 sm:px-8">
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
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody v-for="(order, index) in orders" :key="index">
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="h-15 w-15 flex-shrink-0 items-center">
                                                <img
                                                    alt="image-product"
                                                    class="w-full"
                                                    :src="__asset(order.order_details[0].product.images[0].url)"
                                                />
                                            </div>
                                            <div class="ml-3">
                                                <p class="whitespace-no-wrap text-gray-900">
                                                    {{ order.reference }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="whitespace-no-wrap text-gray-900">{{ order.address }}</p>
                                    </td>
                                    <td>
                                        <p class="whitespace-no-wrap text-gray-900">
                                            {{ order.city }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="whitespace-no-wrap text-gray-900">
                                            {{ __currencyFormat(order.total) }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="whitespace-no-wrap text-gray-900">
                                            {{ __dateFormat(order.updated_at) }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                            <span
                                                class="absolute inset-0 rounded-full"
                                                :class="
                                                    order.status === 'approved'
                                                        ? 'bg-greenTemLight'
                                                        : order.status === 'rejected'
                                                        ? 'bg-red-300'
                                                        : 'bg-yellowLight'
                                                "
                                            ></span>
                                            <span
                                                class="relative uppercase"
                                                :class="
                                                    order.status === 'approved'
                                                        ? 'text-green-600'
                                                        : order.status === 'rejected'
                                                        ? 'text-red-600'
                                                        : 'text-dimgray'
                                                "
                                                >{{ __('general.web.payment.' + order.status) }}</span
                                            >
                                        </span>
                                    </td>
                                    <td>
                                        <button class="orderHistory__button m-1" @click="show(order)">
                                            {{ __('general.web.show') }}
                                        </button>
                                        <button
                                            class="orderHistory__button m-1"
                                            @click="showEdit(order)"
                                            :class="order.status === 'approved' ? 'disabled' : ''"
                                            :disabled="order.status === 'approved'"
                                        >
                                            {{ __('general.web.edit') }}
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mx-auto my-3 flex w-1/2 justify-center">
                    <pagination :pagination="pagination" @paginate="getAllOrders" :offset="4" />
                </div>
            </div>
            <order-history-modal
                :order="currentOrder"
                :isVisible="isOpenShow"
                :order_details="order_details"
                @close="close"
                @getOrder="getOrder"
            ></order-history-modal>
            <order-edit-modal
                :order="currentOrder"
                :isVisible="isOpenShowEdit"
                :order_details="order_details"
                @close="closeEdit"
                @getOrder="getOrder"
            ></order-edit-modal>
        </div>
    </div>
</template>

<script>
import Logo from '../utils/Logo';
import OrderHistoryModal from './modals/OrderHistoryModal';
import axios from 'axios';
import Pagination from '../utils/Pagination';

export default {
    name: 'OrderHistory',
    components: {
        Logo,
        OrderHistoryModal,
        Pagination,
    },
    data() {
        return {
            isOpenShow: false,
            isOpenShowEdit: false,
            orders: [],
            currentOrder: {},
            order_details: [],
            pagination: {},
        };
    },
    mounted() {
        this.getAllOrders();
    },
    methods: {
        getAllOrders: function () {
            let currentPage = this.pagination.current_page;
            let pageNum = currentPage ? currentPage : 1;

            axios.get(`/evertec/mercatodo/public/api/client/orders?page=${pageNum}`).then((response) => {
                this.orders = response.data.orders.data;
                this.pagination = response.data.orders;
            });
        },
        getOrder: function (order) {
            axios.get('/evertec/mercatodo/public/api/client/orders/order/' + order.id).then((response) => {
                this.currentOrder = response.data.order;
                this.order_details = this.currentOrder.order_details;
            });
        },
        goHome() {
            window.location.href = '/evertec/mercatodo/public/';
        },
        show: function (order) {
            this.isOpenShow = true;
            this.currentOrder = order;
            this.getOrder(order);
        },
        showEdit: function (order) {
            this.isOpenShowEdit = true;
            this.currentOrder = order;
            this.getOrder(order);
        },
        close: function () {
            this.isOpenShow = false;
        },
        closeEdit: function () {
            this.isOpenShowEdit = false;
        },
    },
};
</script>

<style scoped></style>
