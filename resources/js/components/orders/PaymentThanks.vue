<template>
    <div>
        {{}}
    </div>
</template>

<script>
export default {
    name: "PaymentThanks.vue",
    data(){
        return {
            order: {id: ''}
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
                console.table(response.data)
                // this.payment = response.data.payment;
                // this.show_spin = false;
                // this.show();
                // this.$emit('getOrder', this.order)
            }).catch(error => {
                // this.show_spin = false;
                // this.errors = error.response.data.errors;
            })
        },
    }
}
</script>

<style scoped>

</style>
