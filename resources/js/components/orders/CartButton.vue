<template>
    <div>
        <div class="flex items-center mr-10">
            <div class="relative" @click="showItems()" >
                <i class="fas fa-shopping-cart productDetail__header--cart"></i>
                <span v-show="this.cartItems.length !== 0" class="productDetail__header--counter">
                    {{ cartItemsCount }}
                </span>
            </div>
        </div>
        <cart-items class="absolute z-10 right-10 top-52 md:top-32" :show_items="show_items" @changeItems="getAllItems()"></cart-items>
    </div>
</template>

<script>

import CartItems from "./CartItems";

export default {
    name: "CartButton.vue",
    components: {
        CartItems,
    },
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
        this.getAllItems();
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
        getAllItems(){
            let myCart = localStorage.getItem('myCart')
            let existingEntries = JSON.parse(localStorage.getItem("myCart"));
            if (existingEntries == null) existingEntries = [];
            this.cartItems = JSON.parse(localStorage.getItem('myCart'));
        },
        deleteItem(item, index) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('myCart', JSON.stringify(this.cartItems));
        },

        showItems() {
            this.show_items === true ? this.show_items = false : this.show_items = true;
        },
        seeCart() {
            window.location.href = '/evertec/mercatodo/public/order/cart';
        }
    },
}
</script>


