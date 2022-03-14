<template>
    <div class="font-poppins">
        <logo-and-home></logo-and-home>
        <div class="container p-12 mx-auto">
            <div class="flex flex-col w-full px-0 mx-auto md:flex-row">
                <div class="flex flex-col md:w-full">
                    <h2 class="mb-4 font-bold md:text-xl text-heading ">{{__('general.web.order.shipping_information')}}
                    </h2>
                    <form class="justify-center w-full mx-auto">
                        <div class="">
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="first_name" class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.first_name')}}</label>
                                    <input name="first_name" id="first_name" type="text" :placeholder="__('general.web.order.first_name')" v-model="shipping.first_name"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                                <div class="w-full lg:w-1/2 ">
                                    <label for="last_name" class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.last_name')}}</label>
                                    <input name="last_name" id="last_name" type="text" :placeholder="__('general.web.order.last_name')" v-model="shipping.last_name"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="email"
                                           class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.email')}}</label>
                                    <input name="email" id="email" type="text" :placeholder="__('general.web.order.email')" v-model="shipping.email"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="address"
                                           class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.address')}}</label>
                                    <textarea
                                        class="w-full px-4 py-3 text-xs border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600"
                                        name="address" id="address" v-model="shipping.address" cols="20" rows="4" :placeholder="__('general.web.order.address')"></textarea>
                                </div>
                            </div>
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="city"
                                           class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.city')}}</label>
                                    <input name="city" id="city" type="text" :placeholder="__('general.web.order.city')" v-model="shipping.city"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                                <div class="w-full lg:w-1/2 ">
                                    <label for="postcode" class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.postcode')}}</label>
                                    <input name="postcode" id="postcode" type="text" :placeholder="__('general.web.order.postcode')" v-model="shipping.postcode"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 mt-3">
                                <label for="phone" class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.phone')}}</label>
                                <input name="phone" id="phone" type="text" :placeholder="__('general.web.order.phone')" v-model="shipping.phone"
                                       class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                            <div class="relative pt-3 xl:pt-6"><label for="note" class="block mb-3 text-sm font-semibold text-gray-500">{{__('general.web.order.notes')}}</label><textarea name="note"
                                                            id="note"
                                                            v-model="shipping.notes"
                                                            class="flex items-center w-full px-4 py-3 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-600"
                                                            rows="4" :placeholder="__('general.web.order.notes_delivery')"></textarea>
                            </div>
                            <div class="mt-4">
                                <button class="w-full px-6 py-2 text-white font-bold bg-orangePantone hover:bg-orange-600 rounded-xl transform hover:scale-105 transition-all duration-300 focus:outline-none"
                                        :class="cartItems.length === 0  ? 'disabled' : ''" :disabled=" cartItems.length === 0">
                                    {{__('general.web.order.process')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex flex-col w-full ml-0 lg:ml-12 lg:w-2/5">
                    <div class="pt-12 md:pt-0 2xl:ps-4">
                        <h2 class="text-xl font-bold">{{__('general.web.order.order_summary')}}</h2>
                        <cart-items :show_items="show_items" @changeItems="getAllItems()"></cart-items>
                        <order-summary v-show="cartItems.length > 0" class="items-center" :cartItems="cartItems" :show_button="show_button" ></order-summary>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CartItems from "./CartItems";
import OrderSummary from "./OrderSummary";
import LogoAndHome from "../utils/LogoAndHome";

export default {
    name: 'Checkout',
    components: {
        CartItems,
        OrderSummary,
        LogoAndHome,
    },
    data() {
        return {
            show_items: true,
            show_button: false,
            cartItems: [],
            shipping: {
                first_name: '',
                last_name: '',
                email: '',
                address: '',
                city: '',
                postcode: '',
                phone: '',
                notes: '',
            },
        }
    },
    mounted() {
        this.getAllItems();
    },
    methods: {
        getAllItems() {
            let existingEntries = JSON.parse(localStorage.getItem("myCart"));
            if (existingEntries == null) existingEntries = [];

            let myCart = localStorage.getItem('myCart')
            let items = []
            if(myCart){
                items = JSON.parse(myCart)
            }
            this.cartItems = items;
        },
    },
}
</script>

<style lang="scss">
.disabled {
    background-color: hsl(24, 91%, 86%);
    @apply hover:scale-100 cursor-default;
}
.disabled:hover {
    background-color: hsl(24, 91%, 86%);
    @apply hover:scale-100 cursor-default;
}
</style>
