<template>
    <div class="cart">
        <div class="cart__header">
            <logo class="cart__header--logo"></logo>
            <button class="cart__header--button" @click="goHome()">
                <i class="fas fa-home"></i>
            </button>
        </div>
        <div class="mt-0 bg-gray-100">
            <div class="my-10 block shadow-md md:flex">
                <div class="cart__container">
                    <div class="cart__container--header">
                        <h1>{{ __('general.web.order.cart') }}</h1>
                        <h2>{{ cartItemsCount }} {{ __('general.web.order.items') }}</h2>
                    </div>
                    <div class="cart__titles">
                        <h3 class="cart__titles--details">{{ __('general.web.order.product_details') }}</h3>
                        <h3 class="cart__titles--priceQuantity">{{ __('general.web.order.quantity') }}</h3>
                        <h3 class="cart__titles--priceQuantity">{{ __('general.web.order.price') }}</h3>
                        <h3 class="cart__titles--total">{{ __('general.web.order.total') }}</h3>
                    </div>
                    <div v-if="cartItems && cartItems.length > 0">
                        <div v-for="(item, index) in cartItems" :key="index" class="cart__content">
                            <div class="block w-2/5 md:flex">
                                <div class="w-20 md:w-32">
                                    <img class="rounded-lg" :src="item.image" alt="product Image" />
                                </div>
                                <div class="cart__productDescription">
                                    <span class="cart__productDescription--title">{{ item.title }}</span>
                                    <span class="cart__productDescription--category">{{ item.category }}</span>
                                    <div class="cart__productDescription--delete">
                                        <span @click="deleteItem(item, index)">
                                            <i class="fas fa-trash-alt hover:text-red-600"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-1/5 justify-center">
                                <div class="mt-3 grid-cols-12 text-center md:grid-cols-4 md:px-0">
                                    <div class="cart__counter">
                                        <div class="cursor-pointer text-orangePantone">
                                            <i class="fa fa-minus px-2" @click="decrement(item)"></i>
                                        </div>
                                        <div>
                                            {{ item.quantity + count }}
                                        </div>
                                        <div class="cursor-pointer text-orangePantone">
                                            <i class="fa fa-plus px-2" @click="increment(item)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span
                                class="hidden w-1/5 text-center text-xs font-semibold text-gray-500 md:block md:text-sm"
                            >
                                {{ __currencyFormat(item.price) }}
                            </span>
                            <span class="w-1/5 text-center text-sm font-semibold">{{ calcPrice(item) }}</span>
                        </div>
                    </div>
                    <a class="cart__button" @click="goHome()">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('general.web.order.continue_shopping') }}
                    </a>
                </div>
                <order-summary
                    v-show="cartItems.length > 0"
                    :cartItems="cartItems"
                    :show_button="show_button"
                ></order-summary>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from '../utils/Logo';
import axios from 'axios';

export default {
    name: 'Cart.vue',
    components: {
        Logo,
    },
    data() {
        return {
            product: { images: [], categories: [] },
            count: 0,
            index: 1,
            cartItems: [],
            show_items: false,
            accumItems: '',
            show_button: true,
        };
    },
    mounted() {
        let existingEntries = JSON.parse(localStorage.getItem('myCart'));
        if (existingEntries == null) existingEntries = [];

        let myCart = localStorage.getItem('myCart');
        let items = [];
        if (myCart) {
            items = JSON.parse(myCart);
        }
        this.cartItems = items;
    },
    computed: {
        cartItemsCount() {
            let accumItems = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumItems += this.cartItems[i].quantity;
            }
            return accumItems;
        },
        accumTaxes() {
            let accumTaxes = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumTaxes += (this.cartItems[i].taxes / 100) * this.cartItems[i].price * this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumTaxes);
        },
        accumSubtotal() {
            let accumSubtotal = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumSubtotal +=
                    (this.cartItems[i].price - (this.cartItems[i].taxes / 100) * this.cartItems[i].price) *
                    this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumSubtotal);
        },
        accumTotal() {
            let accumTotal = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumTotal += this.cartItems[i].price * this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumTotal);
        },
    },
    methods: {
        increment(item) {
            if (item.id) {
                this.count += 1;
                item.quantity = item.quantity + this.count;
                this.count = 0;
            }
            this.addToCart(item);
        },
        decrement(item) {
            if (item.id) {
                this.count = item.quantity;
                if (this.count - 1 >= 0) {
                    this.count = 1;
                    item.quantity = item.quantity - this.count;
                    this.count = 0;
                }
                this.addToCart(item);
            }
        },
        calcPrice(item) {
            return this.__currencyFormat(Number(item.price) * Number(item.quantity));
        },
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
        },
        addToCart(item) {
            let existingEntries = JSON.parse(localStorage.getItem('myCart'));
            if (existingEntries == null) existingEntries = [];

            let entry = {
                id: item.id,
                category: item.category,
                title: item.title,
                price: item.price,
                taxes: item.taxes,
                quantity: item.quantity,
                image: item.image,
            };

            localStorage.setItem('latestItem', JSON.stringify(entry));

            // Save allEntries back to local storage
            for (let i = 0; i < existingEntries.length; i++) {
                if (entry.id === existingEntries[i].id) {
                    existingEntries.splice(i, 1, entry);
                }
            }

            localStorage.setItem('myCart', JSON.stringify(existingEntries));
            this.cartItems = JSON.parse(localStorage.getItem('myCart'));
        },
        showItems() {
            this.show_items === true ? (this.show_items = false) : (this.show_items = true);
        },
        goHome() {
            window.location.href = '/evertec/mercatodo/public/';
        },
        checkout() {
            window.location.href = '/evertec/mercatodo/public/order/checkout';
        },
    },
};
</script>
