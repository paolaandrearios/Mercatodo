<template>
    <div>
        <div class="bg-white">
            <div class="productDetail__cart--body">
                <div v-if="show_items">
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
                                <button class="productDetail__cart--button" @click="seeCart()"
                                        :class="cartItems.length === 0  ? 'disabled' : ''" :disabled=" cartItems.length === 0">
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
    props: {
        show_items: Boolean,
    },
    data() {
        return {
            product: {images: [], categories: []},
            cartItems: [],
            count: 1,
            index: 1,
            accumItems: '',
        }
    },
    mounted() {
        this.getAllItems();
    },
    emit: ['changeItems'],
    methods: {
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
            this.$emit('changeItems');
        },
        seeCart() {
            window.location.href = '/evertec/mercatodo/public/order/cart';
        },
        getAllItems(){
            let myCart = localStorage.getItem('myCart');
            let existingEntries = JSON.parse(localStorage.getItem("myCart"));
            if (existingEntries == null) existingEntries = [];
            this.cartItems = JSON.parse(localStorage.getItem('myCart'));
        },
    },
}
</script>


