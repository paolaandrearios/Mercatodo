<template>
    <div class="container rounded-xl bg-gray-100 mx-auto my-20 w-1/2">
        <div v-if="this.payment.status === 'approved'" class="flex flex-col justify-center p-6">
            <div class="text-6xl text-green-500 mx-auto">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">{{ __('general.web.payment.successful_payment') }}</h3>
                <p class="text-gray-600 my-2">{{ __('general.web.payment.successful_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div v-if="this.payment.status === 'rejected'" class="flex flex-col justify-center p-6">
            <div class="text-6xl text-red-600 mx-auto">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">{{ __('general.web.payment.rejected_payment') }}</h3>
                <p class="text-gray-600 my-2">{{ __('general.web.payment.rejected_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div v-if="this.payment.status === 'pending'" class="flex flex-col justify-center p-6">
            <div class="text-6xl text-yellow-300 mx-auto">
                <i class="fas fa-clock"></i>
            </div>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">{{ __('general.web.payment.pending_payment') }}</h3>
                <p class="text-gray-600 my-2">{{ __('general.web.payment.pending_description') }}</p>
                <p>{{ __('general.web.payment.great_day') }}</p>
            </div>
        </div>
        <div class="py-10 text-center">
            <button @click="goHome" class="px-12 bg-orangePantone text-white font-semibold py-3 rounded-xl transform transition-all duration-300  hover:scale-105 hover:bg-orange-600 focus:outline-none ">
                {{ __('general.web.order.back_home') }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentThanks.vue",
    data(){
        return {
            order: {id: ''},
            payment: {},
        }
    },
    mounted() {
        this.getSyncPaymentInfo();
    },
    methods: {
        getSyncPaymentInfo() {
            let url = window.location.href;
            url = url.split('/')
            let order = url[url.length - 1]

            // this.show_spin = true;
            let data = {}
            axios.get('/evertec/mercatodo/public/api/client/payments/syncstatus/'+order,
                data,
            ).then(response => {
                this.payment = response.data.payment;
                console.table(response.data.payment.status)
                // this.payment = response.data.payment;
                // this.show_spin = false;
                // this.show();
                // this.$emit('getOrder', this.order)
            }).catch(error => {
                // this.show_spin = false;
                // this.errors = error.response.data.errors;
            })
        },
        goHome(){
            window.location.href = '/evertec/mercatodo/public/';
        },
    }
}
</script>

<style scoped>

</style>
