<template>
    <div class="modal">
        <div class="modal__container">
            <div
                v-if="isVisible"
                class="modal__container--bg"
            >
                <div class="modal__content">
                    <div class="modal__content--header flex-col">
                        <h3 class="text-dimGray m-0 text-sm md:text-lg">
                            {{__('general.web.order.added_successfully')}}
                        </h3>
                        <img class="w-40 mx-auto" :src="__asset('images/add-to-cart.png')"/>
                    </div>
                    <div class="flex justify-between">
                        <button class="flex justify-center w-1/2 px-4 py-2 m-2 text-white bg-orangePantone hover:bg-greenTem rounded-xl focus:bg-greenTem focus:outline-none items-center" @click="goHome">
                            <div>
                                {{__('general.web.order.continue_shopping')}}
                            </div>
                        </button>
                        <button class="flex justify-center w-1/2 px-4 py-2 m-2 text-white bg-orangePantone hover:bg-greenTem rounded-xl focus:outline-none items-center" @click="seeCart">
                            <div>
                                {{__('general.web.order.see_cart')}}
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "AddToCartModal.vue",

    props: {
        isVisible: Boolean,
    },
    emits: ['goHome', 'seeCart'],

    methods: {
        goHome(){
            this.$emit('goHome');
        },
        seeCart: function() {
            this.$emit('seeCart');
        },
    },
}
</script>

