<template>
    <div class="modal">
        <div class="modal__container">
            <div v-if="isVisible" class="modal__container--bg">
                <div class="modal__content">
                    <div class="modal__content--header flex-col">
                        <h3 class="m-0 text-sm text-dimGray md:text-lg">
                            {{ __('general.web.order.added_successfully') }}
                        </h3>
                        <img class="mx-auto w-40" :src="__asset('images/add-to-cart.png')" />
                    </div>
                    <div class="flex justify-between">
                        <button
                            class="focus:outline-none m-2 flex w-1/2 items-center justify-center rounded-xl bg-orangePantone px-4 py-2 text-white hover:bg-greenTemLight hover:text-green-900 focus:bg-greenTem"
                            @click="goHome"
                        >
                            <div>
                                {{ __('general.web.order.continue_shopping') }}
                            </div>
                        </button>
                        <button
                            class="focus:outline-none m-2 flex w-1/2 items-center justify-center rounded-xl bg-orangePantone px-4 py-2 text-white hover:bg-greenTemLight hover:text-green-900"
                            @click="seeCart"
                        >
                            <div>
                                {{ __('general.web.order.see_cart') }}
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
    name: 'AddToCartModal.vue',

    props: {
        isVisible: Boolean,
    },
    emits: ['goHome', 'seeCart'],

    methods: {
        goHome() {
            this.$emit('goHome');
        },
        seeCart: function () {
            this.$emit('seeCart');
        },
    },
};
</script>
