<template>
    <div class="font-poppins container mx-auto">
        <div class="flex justify-center md:justify-start items-center">
            <logo class="text-xl md:text-2xl"></logo>
            <button class="p-1 md:hover:bg-orangePantone rounded-full ml-2 focus:outline-none" @click="goHome()">
                <i class="fas fa-home text-orangePantone text-lg md:text-2xl hover:text-white m-2 cursor-pointer"></i>
            </button>
        </div>
        <div class="bg-gray-100 mt-0">
            <div class="block md:flex shadow-md my-10">
                <div class="w-full md:w-3/4 bg-white px-10 py-5">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-extrabold text-xl md:text-3xl">{{ __('general.web.order.cart') }}</h1>
                        <h2 class="font-semibold text-lg md:text-2xl">{{ cartItemsCount }} {{ __('general.web.order.items') }}</h2>
                    </div>
                    <div class="flex justify-between md:justify-center mt-10 mb-5">
                        <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">{{ __('general.web.order.product_details') }}</h3>
                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">{{ __('general.web.order.quantity') }}</h3>
                        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">{{ __('general.web.order.price') }}</h3>
                        <h3 class="hidden md:block font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">{{ __('general.web.order.total') }}</h3>
                    </div>
                    <div v-if="cartItems && cartItems.length > 0">
                        <div v-for="(item, index) in cartItems" :key="index" class="flex justify-between md:justify-center items-start md:items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="block md:flex w-2/5">
                                <div class="w-20 md:w-32">
                                    <img class="rounded-lg" :src="item.image" alt="product Image">
                                </div>
                                <div class="block md:flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-xs md:text-sm">{{ item.title }}</span>
                                    <span class="hidden md:block text-orangePantone text-xs">{{ item.category}}</span>
                                    <div class="grid-cols-1 px-1 text-gray-300 focus:text-red-600">
                                        <span @click="deleteItem(item, index)">
                                          <i class="fas fa-trash-alt hover:text-red-600"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5">
                                <div class="grid-cols-12 md:grid-cols-4 text-center md:px-0 mt-3">
                                    <div class="bg-gray-200 rounded-2xl text-xs md:text-sm p-2 md:p-3 flex flex-row justify-between hover:bg-gray-300">
                                        <div class="text-orangePantone cursor-pointer">
                                            <i class="fa fa-minus px-2" @click="decrement(item)"></i>
                                        </div>
                                        <div>
                                            {{ item.quantity + count }}
                                        </div>
                                        <div class="text-orangePantone cursor-pointer">
                                            <i class="fa fa-plus px-2" @click="increment(item)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="hidden md:block text-gray-500 text-center w-1/5 font-semibold text-xs md:text-sm">
                                {{ __currencyFormat(item.price)}}
                            </span>
                            <span class="text-center w-1/5 font-semibold text-sm">{{ calcPrice(item) }}</span>
                        </div>

                    </div>
                    <a class="flex font-semibold text-orangePantone text-sm mt-10 text-center cursor-pointer items-center" @click="goHome()">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('general.web.order.continue_shopping') }}
                    </a>
                </div>

                <div id="summary" class="w-full md:w-1/4 px-8 py-5">
                    <h1 class="font-semibold text-lg md:text-2xl border-b pb-8">{{ __('general.web.order.order_summary') }}</h1>
                    <div class="flex justify-between mt-10 mb-5">
                        <span class="font-semibold text-sm uppercase">{{ __('general.web.order.items') }} {{ cartItemsCount }} </span>
                        <span class="font-semibold text-sm">590$</span>
                    </div>

                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>{{ __('general.web.order.taxes') }}</span>
                            <span>$600</span>
                        </div>
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>{{ __('general.web.order.subtotal') }}</span>
                            <span>$600</span>
                        </div>
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>{{ __('general.web.order.total') }}</span>
                            <span>$600</span>
                        </div>

                        <button class="bg-orangePantone font-semibold hover:bg-orange-600 py-3 rounded-xl text-sm text-white uppercase w-full">{{ __('general.web.order.checkout') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

import Logo from "../utils/Logo";
import axios from "axios";

export default {
    name: "Cart.vue",
    components: {
        Logo,
    },
    data() {
        return {
            product: {images: [], categories:[]},
            count: 0,
            index: 1,
            cartItems: [],
            show_items: false,
            accumItems: '',
        }
    },
    mounted() {
        let existingEntries = JSON.parse(localStorage.getItem("myCart"));
        if (existingEntries == null) existingEntries = [];

        let myCart = localStorage.getItem('myCart')
        let items = []
        if(myCart){
            items = JSON.parse(myCart)
        }
        this.cartItems = items;
    },
    computed:{
        cartItemsCount() {
            let accumItems = 0;
            for(let i=0; i < this.cartItems.length; i++){
                accumItems += this.cartItems[i].quantity
            }
            return accumItems;
        }
    },
    methods:{
        increment(item) {
            if(item.id){
                this.count += 1;
                item.quantity = item.quantity + this.count;
                this.count = 0;
            }
            this.addToCart(item);
        },
        decrement(item) {
            if(item.id){
                this.count = item.quantity ;
                if (this.count - 1 >= 0) {
                    this.count = 1;
                    item.quantity = item.quantity - this.count;
                    this.count = 0;
                }
                this.addToCart(item);
            }
        },
        calcPrice(item) {
            return  this.__currencyFormat(Number(item.price) * Number(item.quantity));
        },
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
        },
        addToCart(item) {
            let existingEntries = JSON.parse(localStorage.getItem("myCart"));
            if (existingEntries == null) existingEntries = [];

            let entry = {
                id: item.id,
                category: item.category,
                title: item.title,
                price: item.price,
                quantity: item.quantity,
                image: item.image,
            };

            localStorage.setItem("latestItem", JSON.stringify(entry));

            // Save allEntries back to local storage
            for(let i=0; i < existingEntries.length; i++){
                if(entry.id === existingEntries[i].id){
                    existingEntries.splice(i,1,entry);
                }
            }

            localStorage.setItem("myCart", JSON.stringify(existingEntries));
            this.cartItems = JSON.parse(localStorage.getItem('myCart'));
        },
        showItems(){
            this.show_items === true ? this.show_items = false : this.show_items = true;
        },
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        }
    },
}

</script>


