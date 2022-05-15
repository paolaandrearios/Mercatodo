<template>
    <div class="productDetail">
        <div class="productDetail__header">
            <div class="productDetail__header--logo">
                <logo class="text-xl md:text-4xl"></logo>
                <button class="productDetail__header--button" @click="goHome()">
                    <i class="fas fa-home productDetail__header--icon"></i>
                </button>
            </div>
            <div class="relative" @click="showItems()">
                <i class="fas fa-shopping-cart productDetail__header--cart"></i>
                <span v-if="this.cartItems.length !== 0" class="productDetail__header--counter">
                    {{ cartItemsCount }}
                </span>
            </div>
        </div>
        <div class="productDetail__cart">
            <div class="productDetail__cart--body">
                <div v-if="show_items === true">
                    <div class="mx-auto flex flex-col items-end">
                        <div class="flex flex-col">
                            <div class="productDetail__cart--title">
                                <span class="font-bold">
                                    {{ __('general.web.order.cart') }}
                                </span>
                            </div>
                            <div class="productDetail__cart--content">
                                <div v-if="cartItems && cartItems.length > 0">
                                    <div
                                        v-for="(item, index) in cartItems"
                                        :key="index"
                                        class="my-3 flex flex-row justify-between"
                                    >
                                        <div class="grid-cols-3 px-0 text-center">
                                            <img
                                                class="rounded-lg"
                                                :src="item.image"
                                                alt="product Image"
                                                width="70px"
                                                height="70px"
                                            />
                                        </div>
                                        <div class="flex grid-cols-8 flex-col px-1">
                                            <div>
                                                <span class="text-gray-500">
                                                    {{ item.title }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="text-gray-500">
                                                    {{ __currencyFormat(item.price) }} X {{ item.quantity }}
                                                </span>
                                                <span class="font-extrabold">
                                                    {{ calcPrice(item) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="grid-cols-1 px-1 text-gray-300 focus:text-red-600">
                                            <span @click="deleteItem(item, index)">
                                                <i class="fas fa-trash-alt hover:text-red-600"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="grid-rows-1">
                                        <div class="w-72 grid-cols-12 text-center">
                                            <div class="font-bold text-gray-500">
                                                {{ __('general.web.order.empty_cart') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-3 mx-4 grid-cols-12">
                                <button
                                    :class="cartItems.length === 0 ? 'disabled' : ''"
                                    :disabled="cartItems.length === 0"
                                    class="productDetail__cart--button"
                                    @click="seeCart()"
                                >
                                    {{ __('general.web.order.see_cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="productDetail__content">
            <div class="productDetail__content--description">
                <div class="grid-cols-12 p-0 md:grid-cols-5 md:p-2">
                    <div class="flex flex-col">
                        <div class="grid-cols-12 md:block md:px-2">
                            <div class="cursor-pointer">
                                <button
                                    v-if="product.images.length > 0"
                                    class="productDetail__content--buttonImage"
                                    @click="changeMainImage(product.images[index])"
                                >
                                    {{ index + 1 + '/' + product.images.length }}
                                </button>
                                <img
                                    :src="__asset(this.main_image)"
                                    class="relative z-0 w-full rounded-xl"
                                    @click="changeMainImage(product.images[index])"
                                />
                            </div>
                        </div>

                        <div class="hidden grid-cols-12 px-0 md:block">
                            <div class="my-4 hidden grid-cols-12 md:block">
                                <div class="flex flex-row">
                                    <div class="grid-flow-col" v-for="(image, index) in product.images" :key="index">
                                        <div class="cursor-pointer" @click="changeMainImage(image)">
                                            <img
                                                class="w-full rounded-xl p-1"
                                                v-bind:src="__asset(image['url'])"
                                                :class="main_image === image['url'] ? 'active_image' : ''"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3 grid-cols-12 text-left md:grid-cols-6">
                    <div>
                        <div>
                            <span
                                v-if="this.product['categories'].length > 0"
                                class="text-sm font-extrabold tracking-wide text-orangePantone"
                            >
                                {{ this.product['categories'][0]['name_' + __locale()] }}
                            </span>
                        </div>

                        <div class="mt-2 mb-4">
                            <span class="text-xl font-extrabold text-black md:text-4xl">
                                {{ this.product['name_' + __locale()] }}
                            </span>
                        </div>

                        <div class="my-3">
                            <span class="text-dimGray">
                                {{ this.product['description_' + __locale()] }}
                            </span>
                        </div>

                        <div class="grid grid-rows-1">
                            <div class="flex grid-cols-8 flex-row items-center md:grid-cols-12">
                                <div>
                                    <span class="text-xl font-extrabold text-black md:text-2xl">
                                        {{ __currencyFormat(product.price) }}
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="rounded mx-3 bg-orange-100 bg-orange-100 px-2 py-1 font-bold text-orangePantone"
                                    >
                                        50%
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="my-1 grid grid-cols-4 md:grid-cols-12">
                            <span class="font-bold text-gray-400 line-through">
                                {{ __currencyFormat(product.price * 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="my-3 grid grid-cols-1 grid-rows-1 gap-2 md:grid-cols-2">
                        <div class="mt-3 grid-cols-12 text-center md:grid-cols-4 md:px-0">
                            <div class="flex flex-row justify-between rounded-2xl bg-gray-200 p-4">
                                <div class="cursor-pointer text-orangePantone">
                                    <i class="fa fa-minus" @click="decrement()"></i>
                                </div>
                                <div>
                                    {{ count }}
                                </div>
                                <div class="cursor-pointer text-orangePantone">
                                    <i class="fa fa-plus" @click="increment()"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 grid-cols-12 text-center md:grid-cols-8">
                            <button
                                class="productDetail__content--addCart"
                                :class="this.count === 0 ? 'disabled' : ''"
                                :disabled="this.count === 0"
                                @click="addToCart"
                            >
                                <span class="mx-3">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </span>
                                <span>
                                    {{ __('general.web.order.add_to_cart') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <add-cart-modal :isVisible="isOpenShow" @goHome="goHome" @seeCart="seeCart"></add-cart-modal>
    </div>
</template>

<script>
import axios from 'axios';
import Logo from '../utils/Logo';

export default {
    name: 'ProductDetail.vue',
    components: {
        Logo,
    },
    data() {
        return {
            isOpenShow: false,
            product: { images: [], categories: [] },
            main_image: '',
            count: 1,
            index: 1,
            cartItems: [],
            show_items: false,
            accumItems: '',
        };
    },
    mounted() {
        this.getProduct();
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
    },
    methods: {
        getProduct: function () {
            let url = window.location.href;
            url = url.split('/').slice(-1);
            axios.get('/evertec/mercatodo/public/api/product/' + url).then((response) => {
                this.product = response.data.product;
                this.main_image = this.product.images[0]['url'];
            }).catch((error) => {
                if(error.response.status === 404){
                    window.location.href = '/evertec/mercatodo/public';
                }
            });
        },
        increment() {
            this.count += 1;
        },
        decrement() {
            if (this.count - 1 >= 0) {
                this.count -= 1;
            }
        },
        changeMainImage(image) {
            this.main_image = image['url'];
            if (this.index < this.product.images.length - 1) {
                this.index = this.index + 1;
            } else {
                this.index = 0;
            }
        },
        calcPrice(item) {
            return this.__currencyFormat(Number(item.price) * Number(item.quantity));
        },
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
        },
        addToCart() {
            let existingEntries = JSON.parse(localStorage.getItem('myCart'));
            if (existingEntries == null) existingEntries = [];
            let entry = {
                id: this.product.id,
                category: this.product.categories[0]['name_' + this.__locale()],
                title: this.product['name_' + this.__locale()],
                price: this.product.price,
                taxes: this.product.taxes,
                quantity: this.count,
                image: '/evertec/mercatodo/public' + this.product.images[0]['url'],
            };

            localStorage.setItem('latestItem', JSON.stringify(entry));

            // Save allEntries back to local storage
            for (let i = 0; i < existingEntries.length; i++) {
                if (entry.id === existingEntries[i].id) {
                    entry.quantity = existingEntries[i].quantity + entry.quantity;
                    existingEntries.splice(i, 1);
                }
            }
            existingEntries.push(entry);

            console.log(existingEntries);
            localStorage.setItem('myCart', JSON.stringify(existingEntries));
            this.cartItems = JSON.parse(localStorage.getItem('myCart'));
            this.show();
        },
        showItems() {
            this.show_items === true ? (this.show_items = false) : (this.show_items = true);
        },
        goHome() {
            this.isOpenShow = false;
            window.location.href = '/evertec/mercatodo/public/';
        },
        seeCart() {
            window.location.href = '/evertec/mercatodo/public/order/cart';
        },
        show: function () {
            this.isOpenShow = true;
        },
    },
};
</script>
