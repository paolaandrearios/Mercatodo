<template>
    <div class="m-10 text-center">
        <div class="flex items-center justify-between text-lg font-bold md:text-xl flex-col">
            <div class="flex">
                <img class="mx-auto w-20 md:w-32" :src="__asset('images/report.png')" />
                <img class="mx-auto w-20 md:w-32" :src="__asset('images/pdf.png')" />
            </div>
            <p class="mt-4 mb-2 text-sm text-dimGray md:text-xl">
                {{ __('general.web.data_management.reports') }}
            </p>
        </div>
        <p class="mt-2 mb-5 md:mx-1/4 text-dimGray">
            {{ __('general.web.data_management.reports_description') }}
        </p>
        <form class="my-8" v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="w-4/12 mx-auto grid grid-cols-1">
                <select class="bg-gray-300 p-2 rounded-xl focus:outline-none truncate">
                    <option value="">{{ __('general.web.data_management.select_report_type') }}</option>
                    <option value="most_visited">{{ __('general.web.data_management.most_visited_products') }}</option>
                    <option value="best_selling_products">{{ __('general.web.data_management.best_selling_products') }}</option>
                    <option value="least_sold_products">{{ __('general.web.data_management.least_sold_products') }}</option>
                    <option value="abandoned_carts">{{ __('general.web.data_management.abandoned_carts') }}</option>
                    <option value="best_selling_category">{{ __('general.web.data_management.best_selling_category') }}</option>
                </select>
            </div>
            <div class="mt-7 w-3/4 md:w-1/5 mx-auto grid grid-cols-1 grid-rows-1">
                <button
                        class="focus:outline-none w-full transform cursor-pointer rounded-2xl border-0 bg-orangePantone p-4 text-white transition-all duration-300 hover:scale-105 hover:bg-orange-600 focus:bg-orange-600">
                    <span>
                        {{ __('general.web.data_management.generate_report') }}
                    </span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    name: "Reports.vue",

}
</script>
