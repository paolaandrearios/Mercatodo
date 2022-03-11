<template>
    <div>
        <div class="flex items-center mr-10">
            <div class="relative" @click="showItems()" >
                <i class="fas fa-shopping-cart productDetail__header--cart"></i>
                <span v-if="this.cartItems.length !== 0" class="productDetail__header--counter">
                    {{ cartItemsCount }}
                </span>
            </div>
        </div>
        <div class="absolute z-10 right-10 top-52 md:top-28 bg-white">
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
                                    <div v-for="(item, index) in cartItems" :key="index" class="flex flex-row justify-between my-3">
                                        <div class="grid-cols-3 px-0 text-center">
                                            <img class="rounded-lg" :src="item.image" alt="product Image" width="70px" height="70px">
                                        </div>
                                        <div class="grid-cols-8 px-1 flex flex-col">
                                            <div>
                                                <span class="text-gray-500">
                                                    {{ item.title }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="text-gray-500">
                                                    {{ __currencyFormat(item.price)}} X {{ item.quantity }}
                                                </span>
                                                <span class="font-extrabold">
                                                    {{ __currencyFormat(Number(item.price) * Number(item.quantity))}}
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
                                        <div class="grid-cols-12 w-72 text-center">
                                            <div class="text-gray-500 font-bold">
                                                {{ __('general.web.order.empty_cart') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-cols-12 my-3 mx-4">
                                <button class="productDetail__cart--button" @click="seeCart(e)">
                                    {{ __('general.web.order.see_cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "CartButton.vue",
    data() {
        return {
            product: {images: [], categories: []},
            count: 1,
            index: 1,
            cartItems: [],
            show_items: false,
            accumItems: '',
        }
    },
    mounted() {
        let myCart = localStorage.getItem('myCart')
        let existingEntries = JSON.parse(localStorage.getItem("myCart"));
        if (existingEntries == null) existingEntries = [];
        this.cartItems = JSON.parse(localStorage.getItem('myCart'));
    },
    computed: {
        cartItemsCount() {
            let accumItems = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumItems += this.cartItems[i].quantity
            }
            return accumItems;
        }
    },
    methods: {
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
        },

        showItems() {
            this.show_items === true ? this.show_items = false : this.show_items = true;
        },
        seeCart(e) {
            window.location.href = '/evertec/mercatodo/public/order/cart';
        }
    },
}
</script>


