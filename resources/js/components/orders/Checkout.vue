<template>
    <div class="font-poppins">
        <logo-and-home></logo-and-home>
        <div class="container p-12 mx-auto">
            <div class="checkout">
                <div class="flex flex-col md:w-full">
                    <h2 class="mb-4 font-bold md:text-xl text-heading ">{{__('general.web.order.shipping_information')}}
                    </h2>
                    <form v-on:submit.prevent="" class="justify-center w-full mx-auto">
                        <div class="">
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="first_name" class="checkout__label">{{__('general.web.order.first_name')}}</label>
                                    <input name="first_name" id="first_name" type="text" :placeholder="__('general.web.order.first_name')" v-model="shipping.first_name"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                    <error :errors="__e(errors,'shipping.first_name')"></error>
                                </div>
                                <div class="w-full lg:w-1/2">
                                    <label for="last_name" class="checkout__label">{{__('general.web.order.last_name')}}</label>
                                    <input name="last_name" id="last_name" type="text" :placeholder="__('general.web.order.last_name')" v-model="shipping.last_name"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                    <error :errors="__e(errors,'shipping.last_name')"></error>
                                </div>
                            </div>
                            <div class="space-x-0 lg:flex lg:space-x-4 mt-3">
                                <div class="w-full lg:w-1/2">
                                    <label for="document_type" class="checkout__label">{{__('general.web.order.document_type')}}</label>
                                    <div class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        <select class="w-full text-gray-400" name="document_type" id="document_type" v-model="shipping.document_type">
                                            <option value="">{{__('general.web.select')}}</option>
                                            <option value="citizenship_id">{{__('general.web.order.citizenship_id')}}</option>
                                            <option value="foreigner_id">{{__('general.web.order.foreigner_id')}}</option>
                                            <option value="passport">{{__('general.web.order.passport')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <error :errors="__e(errors,'shipping.document_type')"></error>
                                <div class="w-full lg:w-1/2">
                                    <label for="document_number" class="checkout__label">{{__('general.web.order.document_number')}}</label>
                                    <input name="document_number" id="document_number" type="text" :placeholder="__('general.web.order.document_number')" v-model="shipping.document_number"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                </div>
                                <error :errors="__e(errors,'shipping.document_number')"></error>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="email" class="checkout__label">{{__('general.web.order.email')}}</label>
                                    <input name="email" id="email" type="text" :placeholder="__('general.web.order.email')" v-model="shipping.email"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                </div>
                                <error :errors="__e(errors,'shipping.email')"></error>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="address" class="checkout__label">{{__('general.web.order.address')}}</label>
                                    <textarea
                                        class="checkout__input focus:ring-1 focus:ring-blue-600"
                                        name="address" id="address" v-model="shipping.address" cols="20" rows="4" :placeholder="__('general.web.order.address')"></textarea>
                                </div>
                                <error :errors="__e(errors,'shipping.address')"></error>
                            </div>
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2 mt-3">
                                    <label for="city" class="checkout__label">{{__('general.web.order.city')}}</label>
                                    <input name="city" id="city" type="text" :placeholder="__('general.web.order.city')" v-model="shipping.city"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                </div>
                                <error :errors="__e(errors,'shipping.city')"></error>
                                <div class="w-full lg:w-1/2 mt-3">
                                    <label for="postcode" class="checkout__label">{{__('general.web.order.postcode')}}</label>
                                    <input name="postcode" id="postcode" type="text" :placeholder="__('general.web.order.postcode')" v-model="shipping.postcode"
                                           class="checkout__input focus:ring-1 focus:ring-blue-600">
                                </div>
                                <error :errors="__e(errors,'shipping.postcode')"></error>
                            </div>
                            <div class="w-full lg:w-1/2 mt-3">
                                <label for="phone" class="checkout__label">{{__('general.web.order.phone')}}</label>
                                <input name="phone" id="phone" type="text" :placeholder="__('general.web.order.phone')" v-model="shipping.phone"
                                       class="checkout__input focus:ring-1 focus:ring-blue-600">
                            </div>
                            <error :errors="__e(errors,'shipping.phone')"></error>
                            <div class="relative pt-3 xl:pt-6"><label for="note" class="checkout__label">{{__('general.web.order.notes')}}</label><textarea name="note"
                                id="note"
                                v-model="shipping.notes"
                                class="flex items-center checkout__input focus:ring-1 focus:ring-blue-600"
                                rows="4" :placeholder="__('general.web.order.notes_delivery')"></textarea>
                            </div>
                            <error :errors="__e(errors,'shipping.notes')"></error>
                            <div class="mt-4">
                                <button class="checkout__button--process"
                                        :class="cartItems.length === 0  ? 'disabled' : ''" :disabled=" cartItems.length === 0" v-on:click="create">
                                    <div v-if="show_spin">
                                        <svg class="animate-spin h-5 w-5 mr-3 text-gray-200 ..."  viewBox="0 0 100 101">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="blue"/>
                                        </svg>
                                    </div>
                                    <div>
                                        {{__('general.web.order.process')}}
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                    <a class="checkout__button--backHome" @click="goHome()">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('general.web.order.back_home') }}
                    </a>
                </div>
                <div class="flex flex-col w-full ml-0 lg:ml-12 lg:w-2/5">
                    <div class="pt-12 md:pt-0 2xl:ps-4">
                        <h2 class="text-xl font-bold">{{__('general.web.order.order_summary')}}</h2>
                        <cart-items :show_items="show_items" @changeItems="getAllItems()" :removeItems="removeItems" :cartItems="cartItems"></cart-items>
                        <order-summary v-show="cartItems.length > 0" class="items-center" :cartItems="cartItems" :show_button="show_button"></order-summary>
                    </div>
                </div>
            </div>
        </div>
        <checkout-modal :isVisible="isOpenShow" @close="close"></checkout-modal>
    </div>
</template>

<script>
import CartItems from "./CartItems";
import OrderSummary from "./OrderSummary";
import LogoAndHome from "../utils/LogoAndHome";
import Error from "../utils/Error";

export default {
    name: 'Checkout',
    components: {
        CartItems,
        OrderSummary,
        LogoAndHome,
        Error,
    },
    data() {
        return {
            removeItems: false,
            show_items: true,
            show_button: false,
            cartItems: [],
            show_spin: false,
            isOpenShow: false,
            shipping: {
                first_name: '',
                last_name: '',
                document_type: '',
                document_number: '',
                email: '',
                address: '',
                city: '',
                postcode: '',
                phone: '',
                notes: '',
            },
            errors: [],
        }
    },
    mounted() {
        this.getAllItems();
    },
    methods: {
        create: function (){
            this.show_spin = true;
            let data = {
                cartItems: this.cartItems,
                shipping: this.shipping,
            }

            axios.post('/evertec/mercatodo/public/api/client/orders',
                data,
            ).then(response => {
                this.show_spin = false;
                this.show();
                this.deleteItems();
                //alert(response.data.message)
                // this.close();
            }).catch(error => {
                this.show_spin = false;
                this.errors = error.response.data.errors;
                console.log(this.errors)
            })

        },
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
        deleteItems() {
            localStorage.removeItem('myCart');
            this.getAllItems();
        },
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        },
        show: function() {
            this.isOpenShow = true;
        },
        close: function () {
            this.isOpenShow = false;
            alert('If you want to see the order again and resume the payment, check the history in the orders section');
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
