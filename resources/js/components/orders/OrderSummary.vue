<template>
    <div class="font-poppins">
         <div id="summary" class="w-full px-8 py-5">
            <h1 v-if="show_button" class="font-semibold text-lg md:text-2xl border-b pb-8">{{ __('general.web.order.order_summary') }}</h1>
            <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">{{ __('general.web.order.items') }} {{ cartItemsCount }} </span>
                <span class="font-semibold text-sm text-dimGray">{{ accumTotal }}</span>
            </div>

            <div class="border-t mt-8">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>{{ __('general.web.order.taxes') }}</span>
                    <span class="text-dimGray">{{ accumTaxes }}</span>
                </div>
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>{{ __('general.web.order.subtotal') }}</span>
                    <span class="text-dimGray">{{ accumSubtotal }}</span>
                </div>
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>{{ __('general.web.order.total') }}</span>
                    <span class="text-dimGray">{{ accumTotal }}</span>
                </div>
                <div v-if="show_button" >
                    <button @click="checkout()" class="bg-orangePantone font-semibold py-3 rounded-xl text-sm text-white uppercase w-full hover:bg-orange-600 transform hover:scale-105 transition-all duration-300 focus:outline-none">{{ __('general.web.order.checkout') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "OrderSummary.vue",
    props: {
        show_button: Boolean,
        cartItems: Array,
    },
    data() {
        return {
            show_items: false,
        }
    },
    mounted() {
        this.getAllItems();
    },
    computed:{
        cartItemsCount() {
            let accumItems = 0;
            for (let i = 0; i < this.cartItems.length; i++) {
                accumItems += this.cartItems[i].quantity
            }
            return accumItems;
        },
        accumTaxes() {
            let accumTaxes = 0;
            for(let i=0; i < this.cartItems.length; i++){
                accumTaxes += this.cartItems[i].taxes/100 * this.cartItems[i].price * this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumTaxes);
        },
        accumSubtotal() {
            let accumSubtotal = 0;
            for(let i=0; i < this.cartItems.length; i++){
                accumSubtotal += (this.cartItems[i].price - this.cartItems[i].taxes/100 * this.cartItems[i].price) * this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumSubtotal);
        },
        accumTotal() {
            let accumTotal = 0;
            for(let i=0; i < this.cartItems.length; i++){
                accumTotal += this.cartItems[i].price * this.cartItems[i].quantity;
            }
            return this.__currencyFormat(accumTotal);
        }
    },
    methods:{
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
        calcPrice(item) {
            return  this.__currencyFormat(Number(item.price) * Number(item.quantity));
        },
        checkout(){
            window.location.href = '/evertec/mercatodo/public/order/checkout';
        }
    },
}

</script>


