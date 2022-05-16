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
                                        class="mt-4 w-full md:mt-6"
                                    >
                                        <div
                                            class="flex flex-col items-start justify-start md:flex-row md:items-center md:space-x-6 xl:space-x-8"
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
                                                <div class="flex w-full items-center justify-between space-x-8">
                                                    <p class="text-xs leading-6 md:text-sm">
                                                        {{ __currencyFormat(detail.product.price) }}
                                                    </p>
                                                    <div class="flex w-1/5 justify-center leading-6">
                                                        <div
                                                            class="mt-3 grid-cols-12 text-center md:grid-cols-4 md:px-0"
                                                        >
                                                            <div class="cart__counter">
                                                                <div class="cursor-pointer text-orangePantone">
                                                                    <i
                                                                        class="fa fa-minus px-2"
                                                                        @click="decrement(detail)"
                                                                    ></i>
                                                                </div>
                                                                <div>
                                                                    {{ detail.quantity + count }}
                                                                </div>
                                                                <div class="cursor-pointer text-orangePantone">
                                                                    <i
                                                                        class="fa fa-plus px-2"
                                                                        @click="increment(detail)"
                                                                    ></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs font-semibold leading-6 text-gray-800 md:text-sm">
                                                        {{ calcPrice(detail) }}
                                                    </p>
                                                </div>
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
                                                <p class="text-base leading-4 text-gray-600">{{ accumTaxes }}</p>
                                            </div>
                                            <div class="flex w-full items-center justify-between">
                                                <p class="text-base leading-4 text-gray-800">
                                                    {{ __('general.web.order.taxes') }}
                                                </p>
                                                <p class="text-base leading-4 text-gray-600">{{ accumSubtotal }}</p>
                                            </div>
                                        </div>
                                        <div class="flex w-full items-center justify-between">
                                            <p class="text-base font-semibold leading-4 text-gray-800">
                                                {{ __('general.web.order.total') }}
                                            </p>
                                            <p class="text-base font-semibold leading-4 text-gray-600">
                                                {{ accumTotal }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form v-on:submit.prevent="" class="mx-auto justify-center px-4 md:p-8">
                        <h3 class="pb-15 text-xl font-semibold leading-5 text-gray-800">
                            {{ __('general.web.order.customer') }}
                        </h3>
                        <div class="">
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="first_name" class="checkout__label">{{
                                        __('general.web.order.first_name')
                                    }}</label>
                                    <input
                                        name="first_name"
                                        id="first_name"
                                        type="text"
                                        v-model="order.first_name"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                    <error :errors="__e(errors, 'shipping.first_name')"></error>
                                </div>
                                <div class="w-full lg:w-1/2">
                                    <label for="last_name" class="checkout__label">{{
                                        __('general.web.order.last_name')
                                    }}</label>
                                    <input
                                        name="last_name"
                                        id="last_name"
                                        type="text"
                                        v-model="order.last_name"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                    <error :errors="__e(errors, 'shipping.last_name')"></error>
                                </div>
                            </div>
                            <div class="mt-3 space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="document_type" class="checkout__label">{{
                                        __('general.web.order.document_type')
                                    }}</label>
                                    <div
                                        class="border rounded focus:outline-none focus:ring-1 focus:ring-blue-600 w-full border-gray-300 px-4 py-3 text-sm lg:text-sm"
                                    >
                                        <select
                                            class="w-full text-gray-400"
                                            name="document_type"
                                            id="document_type"
                                            v-model="order.document_type"
                                        >
                                            <option value="">{{ __('general.web.select') }}</option>
                                            <option value="citizenship_id">
                                                {{ __('general.web.order.citizenship_id') }}
                                            </option>
                                            <option value="foreigner_id">
                                                {{ __('general.web.order.foreigner_id') }}
                                            </option>
                                            <option value="passport">{{ __('general.web.order.passport') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <error :errors="__e(errors, 'shipping.document_type')"></error>
                                <div class="w-full lg:w-1/2">
                                    <label for="document_number" class="checkout__label">{{
                                        __('general.web.order.document_number')
                                    }}</label>
                                    <input
                                        name="document_number"
                                        id="document_number"
                                        type="text"
                                        v-model="order.document_number"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                </div>
                                <error :errors="__e(errors, 'shipping.document_number')"></error>
                            </div>
                            <div class="mt-3 space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="email" class="checkout__label">{{
                                        __('general.web.order.email')
                                    }}</label>
                                    <input
                                        name="email"
                                        id="email"
                                        type="text"
                                        v-model="order.email"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                </div>
                                <error :errors="__e(errors, 'shipping.email')"></error>
                                <div class="w-full lg:w-1/2">
                                    <label for="address" class="checkout__label">{{
                                        __('general.web.order.address')
                                    }}</label>
                                    <textarea
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                        name="address"
                                        id="address"
                                        v-model="order.address"
                                        cols="10"
                                        rows="2"
                                    ></textarea>
                                </div>
                                <error :errors="__e(errors, 'shipping.address')"></error>
                            </div>
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="mt-3 w-full lg:w-1/2">
                                    <label for="city" class="checkout__label">{{ __('general.web.order.city') }}</label>
                                    <input
                                        name="city"
                                        id="city"
                                        type="text"
                                        v-model="order.city"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                </div>
                                <error :errors="__e(errors, 'shipping.city')"></error>
                                <div class="mt-3 w-full lg:w-1/2">
                                    <label for="postcode" class="checkout__label">{{
                                        __('general.web.order.postcode')
                                    }}</label>
                                    <input
                                        name="postcode"
                                        id="postcode"
                                        type="text"
                                        v-model="order.postcode"
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                    />
                                </div>
                                <error :errors="__e(errors, 'shipping.postcode')"></error>
                            </div>
                            <div class="mt-3 w-full lg:w-1/2">
                                <label for="phone" class="checkout__label">{{ __('general.web.order.phone') }}</label>
                                <input
                                    name="phone"
                                    id="phone"
                                    type="text"
                                    v-model="order.phone"
                                    class="checkout__input focus:ring-1 focus:ring-blue-600"
                                />
                            </div>
                            <error :errors="__e(errors, 'shipping.phone')"></error>
                            <div class="relative pt-3 xl:pt-6">
                                <label for="note" class="checkout__label">{{ __('general.web.order.notes') }}</label
                                ><textarea
                                    name="note"
                                    id="note"
                                    v-model="order.notes"
                                    class="checkout__input focus:ring-1 focus:ring-blue-600 flex items-center"
                                    rows="4"
                                ></textarea>
                            </div>
                            <error :errors="__e(errors, 'shipping.notes')"></error>
                        </div>
                        <div class="mt-5 flex w-full items-center justify-center">
                            <button
                                @click="update(order)"
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 mx-2 mt-6 w-36 rounded-xl bg-orangePantone py-4 text-base font-bold leading-4 text-white hover:bg-greenTemLight hover:text-green-500 md:mt-0"
                            >
                                {{ __('general.web.save') }}
                            </button>
                            <button
                                @click="close"
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 mx-2 mt-6 w-36 rounded-xl bg-gray-500 py-4 text-base font-bold leading-4 text-white hover:bg-gray-700 md:mt-0"
                            >
                                {{ __('general.web.close') }}
                            </button>
                        </div>
                    </form>
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
            count: 0,
            errors: [],
        };
    },
    computed: {
        accumTaxes() {
            let accumTaxes = 0;
            for (let i = 0; i < this.order_details.length; i++) {
                accumTaxes +=
                    (this.order_details[i].product.taxes / 100) *
                    this.order_details[i].product.price *
                    this.order_details[i].quantity;
            }
            return this.__currencyFormat(accumTaxes);
        },
        accumSubtotal() {
            let accumSubtotal = 0;
            for (let i = 0; i < this.order_details.length; i++) {
                accumSubtotal +=
                    (this.order_details[i].product.price -
                        (this.order_details[i].product.taxes / 100) * this.order_details[i].product.price) *
                    this.order_details[i].quantity;
            }
            return this.__currencyFormat(accumSubtotal);
        },
        accumTotal() {
            let accumTotal = 0;
            for (let i = 0; i < this.order_details.length; i++) {
                accumTotal += this.order_details[i].product.price * this.order_details[i].quantity;
            }
            return this.__currencyFormat(accumTotal);
        },
    },
    methods: {
        update: function (order) {
            let cartItems = [];
            let shipping = {};

            shipping.first_name = order.first_name;
            shipping.last_name = order.last_name;
            shipping.document_type = order.document_type;
            shipping.document_number = order.document_number;
            shipping.email = order.email;
            shipping.address = order.address;
            shipping.city = order.city;
            shipping.postcode = order.postcode;
            shipping.phone = order.phone;
            shipping.notes = order.notes;

            cartItems = order.order_details;

            let data = {
                cartItems: cartItems,
                shipping: shipping,
            };
            console.log('cartItems', cartItems);
            console.log('shipping', shipping);

            axios
                .patch('/evertec/mercatodo/public/api/client/orders/order/' + order.id, data)
                .then((response) => {
                    alert(response.data.message);
                    this.close();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        increment(detail) {
            if (detail.id) {
                this.count += 1;
                detail.quantity = detail.quantity + this.count;
                this.count = 0;
            }
            this.calcPrice(detail);
        },
        decrement(detail) {
            if (detail.id) {
                this.count = detail.quantity;
                if (this.count - 1 >= 0) {
                    this.count = 1;
                    detail.quantity = detail.quantity - this.count;
                    if (detail.quantity === 0) {
                        detail.quantity = 1;
                    }
                    this.count = 0;
                }
                this.calcPrice(detail);
            }
        },
        calcPrice(detail) {
            return this.__currencyFormat(Number(detail.product.price) * Number(detail.quantity));
        },
        closeModal: function () {
            this.isOpenShow = false;
        },
        close: function () {
            this.errors = [];
            this.$emit('close');
        },
        show: function () {
            this.isOpenShow = true;
        },
    },
};
</script>
