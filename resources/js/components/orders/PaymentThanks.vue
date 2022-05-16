<template>
    <div class="container mx-auto my-20 w-1/2 rounded-xl bg-gray-100">
        <div v-if="this.payment.status === 'approved'" class="flex flex-col justify-center p-6">
            <div class="mx-auto text-6xl text-green-500">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="text-center">
                <h3 class="text-center text-base font-semibold text-gray-900 md:text-2xl">
                    {{ __('general.web.payment.successful_payment') }}
                </h3>
                <p class="my-2 text-gray-600">{{ __('general.web.payment.successful_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div v-if="this.payment.status === 'rejected'" class="flex flex-col justify-center p-6">
            <div class="mx-auto text-6xl text-red-600">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="text-center">
                <h3 class="text-center text-base font-semibold text-gray-900 md:text-2xl">
                    {{ __('general.web.payment.rejected_payment') }}
                </h3>
                <p class="my-2 text-gray-600">{{ __('general.web.payment.rejected_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div v-if="this.payment.status === 'pending'" class="flex flex-col justify-center p-6">
            <div class="mx-auto text-6xl text-yellow-300">
                <i class="fas fa-clock"></i>
            </div>
            <div class="text-center">
                <h3 class="text-center text-base font-semibold text-gray-900 md:text-2xl">
                    {{ __('general.web.payment.pending_payment') }}
                </h3>
                <p class="my-2 text-gray-600">{{ __('general.web.payment.pending_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div class="py-10 text-center">
            <button
                @click="goHome"
                class="focus:outline-none mx-2 my-2 transform rounded-xl bg-orangePantone px-12 py-3 font-semibold text-white transition-all duration-300 hover:scale-105 hover:bg-orange-600"
            >
                {{ __('general.web.order.back_home') }}
            </button>
            <button
                @click="seeOrders"
                class="focus:outline-none mx-2 my-2 transform rounded-xl bg-orangePantone px-12 py-3 font-semibold text-white transition-all duration-300 hover:scale-105 hover:bg-orange-600"
            >
                {{ __('general.web.order.see_orders') }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaymentThanks.vue',
    data() {
        return {
            order: { id: '' },
            payment: {},
        };
    },
    mounted() {
        this.getSyncPaymentInfo();
    },
    methods: {
        getSyncPaymentInfo() {
            let url = window.location.href;
            url = url.split('/');
            let order = url[url.length - 1];

            let data = {};
            axios.get('/evertec/mercatodo/public/api/client/payments/syncstatus/' + order, data).then((response) => {
                this.payment = response.data.payment;
            });
        },
        goHome() {
            window.location.href = '/evertec/mercatodo/public/';
        },
        seeOrders() {
            window.location.href = '/evertec/mercatodo/public/orders/history';
        },
    },
};
</script>

<style scoped></style>
