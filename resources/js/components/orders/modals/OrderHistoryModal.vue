<template>
    <div class="">
        <div class="modal__container font-poppins">
            <div v-if="isVisible" class="modal__container--bg">
                <div
                    class="mx-auto h-11/12 w-5/6 overflow-x-hidden overflow-y-scroll rounded-md bg-white p-2 p-6 text-xs shadow-xl md:text-sm"
                >
                    <div class="2xl:px-20 py-14 px-4 md:px-6">
                        <div class="item-start flex flex-col justify-start space-y-2">
                            <h1 class="text-xl font-semibold leading-7 text-gray-800 lg:text-2xl lg:leading-9">
                                {{ __('general.web.order.order') }} - {{ order.reference }}
                            </h1>
                            <p class="text-base font-medium leading-6 text-gray-600">
                                {{ __dateFormat(order.updated_at) }}
                            </p>
                        </div>
                        <div
                            class="mt-10 flex w-full flex-col items-stretch justify-center space-y-4 md:space-y-6 xl:flex-row xl:space-x-8 xl:space-y-0"
                        >
                            <div
                                class="flex w-full flex-col items-start justify-start space-y-4 md:space-y-6 xl:space-y-8"
                            >
                                <div
                                    class="flex w-full flex-col items-start justify-start bg-gray-50 px-4 py-4 md:p-6 md:py-6 xl:p-8"
                                >
                                    <p class="text-lg font-semibold leading-6 text-gray-800 md:text-xl xl:leading-5">
                                        {{ __('general.web.order.customer_cart') }}
                                    </p>
                                    <div
                                        v-for="(detail, index) in order_details"
                                        :key="index"
                                        class="mt-4 flex w-full flex-col items-start justify-start md:mt-6 md:flex-row md:items-center md:space-x-6 xl:space-x-8"
                                    >
                                        <div class="w-full pb-4 md:w-32 md:pb-6">
                                            <img class="w-full" :src="__asset(detail.product.images[0].url)" />
                                        </div>
                                        <div
                                            class="border-b flex w-full flex-col items-start justify-between space-y-4 border-gray-200 pb-8 md:flex-row md:space-y-0"
                                        >
                                            <div class="flex w-full flex-col items-start justify-start space-y-6">
                                                <h3 class="text-sm font-semibold leading-6 text-gray-800">
                                                    {{ detail.product['name_' + __locale()] }}
                                                </h3>
                                                <div class="flex flex-col items-start justify-start">
                                                    <p class="text-sm leading-none text-gray-800">
                                                        {{ detail.product.categories[0]['name_' + __locale()] }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex w-full items-start justify-between space-x-8">
                                                <p class="text-xs leading-6 md:text-sm">
                                                    {{ __currencyFormat(detail.product.price) }}
                                                </p>
                                                <p class="text-xs leading-6 text-gray-800 md:text-sm">
                                                    {{ detail.quantity }}
                                                </p>
                                                <p class="text-xs font-semibold leading-6 text-gray-800 md:text-sm">
                                                    {{ __currencyFormat(detail.total) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex w-full flex-col flex-col items-stretch justify-center space-y-4 md:flex-row md:space-y-0 md:space-x-6 xl:space-x-8"
                                >
                                    <div class="flex w-full flex-col space-y-6 bg-gray-50 px-4 py-6 md:p-6 xl:p-8">
                                        <h3 class="text-xl font-semibold leading-5 text-gray-800">
                                            {{ __('general.web.order.order_summary') }}
                                        </h3>
                                        <div
                                            class="border-b flex w-full flex-col items-center justify-center space-y-4 border-gray-200 pb-4"
                                        >
                                            <div class="flex w-full justify-between">
                                                <p class="text-base leading-4 text-gray-800">
                                                    {{ __('general.web.order.subtotal') }}
                                                </p>
                                                <p class="text-base leading-4 text-gray-600">
                                                    {{ __currencyFormat(order.subtotal) }}
                                                </p>
                                            </div>
                                            <div class="flex w-full items-center justify-between">
                                                <p class="text-base leading-4 text-gray-800">
                                                    {{ __('general.web.order.taxes') }}
                                                </p>
                                                <p class="text-base leading-4 text-gray-600">
                                                    {{ __currencyFormat(order.taxes) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex w-full items-center justify-between">
                                            <p class="text-base font-semibold leading-4 text-gray-800">
                                                {{ __('general.web.order.total') }}
                                            </p>
                                            <p class="text-base font-semibold leading-4 text-gray-600">
                                                {{ __currencyFormat(order.total) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex w-full flex-col items-center justify-between bg-gray-50 px-4 py-6 md:items-start md:p-6 xl:w-96 xl:p-8"
                            >
                                <h3 class="text-xl font-semibold leading-5 text-gray-800">
                                    {{ __('general.web.order.customer') }}
                                </h3>
                                <div
                                    class="flex h-full w-full flex-col items-stretch justify-start md:flex-row md:space-x-6 lg:space-x-8 xl:flex-col xl:space-x-0"
                                >
                                    <div class="flex flex-shrink-0 flex-col items-start justify-start">
                                        <div
                                            class="border-b flex w-full items-center justify-center space-x-4 border-gray-200 py-8 md:justify-start"
                                        >
                                            <div class="flex flex-col items-start justify-start space-y-2">
                                                <p class="text-left text-base font-semibold leading-4 text-gray-800">
                                                    {{ order.first_name + ' ' + order.last_name }}
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="border-b block w-full content-start items-center space-x-4 border-gray-200 py-4 text-gray-800 md:flex md:justify-start md:justify-center"
                                        >
                                            <div class="flex items-center">
                                                <i class="fas fa-envelope mr-2 text-orangePantone"></i>
                                                <p class="text-sm leading-5">{{ order.email }}</p>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-mobile-alt mr-2 font-bold text-orangePantone"></i>
                                                <p class="cursor-pointer text-sm leading-5">{{ order.phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-6 flex w-full flex-col items-stretch justify-between md:mt-0 xl:h-full"
                                    >
                                        <div
                                            class="flex flex-col items-center justify-center space-y-4 md:flex-row md:items-start md:justify-start md:space-x-6 md:space-y-0 lg:space-x-8 xl:flex-col xl:space-x-0 xl:space-y-12"
                                        >
                                            <div
                                                class="flex flex-col items-center justify-center space-y-4 md:items-start md:justify-start xl:mt-8"
                                            >
                                                <p
                                                    class="text-center text-base font-semibold leading-4 text-gray-800 md:text-left"
                                                >
                                                    {{ __('general.web.order.shipping_address') }}
                                                </p>
                                                <p
                                                    class="w-48 text-center text-sm leading-5 text-gray-600 md:text-left lg:w-full xl:w-48"
                                                >
                                                    {{ order.address }}<span class="m-2"> - {{ order.city }}</span>
                                                </p>
                                            </div>
                                            <div
                                                class="flex flex-col items-center justify-center space-y-4 md:items-start md:justify-start"
                                            >
                                                <p
                                                    class="text-center text-base font-semibold leading-4 text-gray-800 md:text-left"
                                                >
                                                    {{ __('general.web.order.notes_delivery') }}
                                                </p>
                                                <p
                                                    class="w-48 text-center text-sm leading-5 text-gray-600 md:text-left lg:w-full xl:w-48"
                                                >
                                                    {{ order.notes }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="2xl:px-20 px-4 md:px-6">
                        <div class="item-start mb-3 flex flex-col justify-start space-y-2">
                            <h1 class="mx-5 text-xl font-semibold leading-7 text-gray-800 lg:leading-9">
                                {{ __('general.web.payment.payment_record') }}
                            </h1>
                        </div>
                        <div class="mr-10 flex w-full justify-center md:justify-end" v-if="order.status !== 'approved'">
                            <button
                                @click="retryPay"
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 mt-6 w-36 min-w-max-content rounded-xl bg-greenTem p-4 py-2 text-sm text-base font-bold leading-4 text-black opacity-75 hover:bg-greenTem hover:opacity-100 md:mt-0"
                            >
                                {{ __('general.web.payment.retry_payment') }}
                            </button>
                        </div>
                        <div class="mx-auto w-5/6 overflow-x-auto px-4 py-4 sm:px-8">
                            <div class="shadow inline-block min-w-full overflow-hidden rounded-lg">
                                <table class="w-5/6 min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600"
                                            >
                                                ID
                                            </th>
                                            <th
                                                class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600"
                                            >
                                                {{ __('general.web.order.date') }}
                                            </th>
                                            <th
                                                class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600"
                                            >
                                                {{ __('general.web.payment.reference') }}
                                            </th>
                                            <th
                                                class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600"
                                            >
                                                {{ __('general.web.order.total') }}
                                            </th>
                                            <th
                                                class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600"
                                            >
                                                {{ __('general.web.order.status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="payment in order.payments" :key="payment.id">
                                        <tr>
                                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                <p class="whitespace-no-wrap text-center text-gray-900">
                                                    {{ payment.id }}
                                                </p>
                                            </td>
                                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                <p class="whitespace-no-wrap text-center text-gray-900">
                                                    {{ __dateFormatWithHour(payment.created_at) }}
                                                </p>
                                            </td>
                                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                <p class="whitespace-no-wrap text-center text-gray-900">
                                                    {{ payment.reference }}
                                                </p>
                                            </td>
                                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                <p class="whitespace-no-wrap text-center text-gray-900">
                                                    {{ __currencyFormat(payment.total) }}
                                                </p>
                                            </td>
                                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                <p
                                                    class="whitespace-no-wrap rounded-xl py-1 px-0.5 text-center text-xs font-bold uppercase"
                                                    :class="
                                                        payment.status === 'approved'
                                                            ? 'bg-greenTemLight text-green-600'
                                                            : payment.status === 'rejected'
                                                            ? 'bg-red-300 text-red-600'
                                                            : 'bg-yellowLight text-gray-900'
                                                            ? payment.status === 'cancelled'
                                                                ? 'text-dimgray bg-gray-400'
                                                                : 'bg-yellowLight text-gray-900'
                                                            : ''
                                                    "
                                                >
                                                    {{ __('general.web.payment.' + payment.status) }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex w-full items-center justify-center">
                        <button
                            @click="close"
                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 mt-6 w-36 rounded-xl bg-orangePantone py-4 text-base font-bold leading-4 text-white hover:bg-orange-600 md:mt-0"
                        >
                            {{ __('general.web.close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <checkout-modal :isVisible="isOpenShow" @close="closeModal" :payment="payment"></checkout-modal>
    </div>
</template>

<script>
import CheckoutModal from './CheckoutModal';

export default {
    name: 'OrderHistoryModal.vue',

    components: {
        CheckoutModal,
    },
    props: {
        isVisible: Boolean,
        order: Object,
        order_details: Array,
    },
    emits: ['close', 'getOrder'],
    data() {
        return {
            isOpenShow: false,
            payment: {},
            paymentUrl: '',
        };
    },
    methods: {
        retryPay: function () {
            this.show_spin = true;
            let data = {};
            axios
                .post('/evertec/mercatodo/public/api/client/payments/store/' + this.order.id, data)
                .then((response) => {
                    this.payment = response.data.payment;
                    this.show_spin = false;
                    this.show();
                    this.$emit('getOrder', this.order);
                    //this.deleteItems();
                    //alert(response.data.message)
                    // this.close();
                })
                .catch((error) => {
                    this.show_spin = false;
                    this.errors = error.response.data.errors;
                });
        },
        closeModal: function () {
            this.isOpenShow = false;
        },
        close: function () {
            this.$emit('close');
        },
        show: function () {
            this.isOpenShow = true;
        },
    },
};
</script>
