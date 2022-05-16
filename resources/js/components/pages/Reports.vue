<template>
    <div class="dataMa">
        <div class="dataMa__header">
            <div class="flex">
                <img :src="__asset('images/report.png')" />
                <img :src="__asset('images/pdf.png')" />
            </div>
            <p>
                {{ __('general.web.data_management.reports') }}
            </p>
        </div>
        <p class="dataMa__description">
            {{ __('general.web.data_management.reports_description') }}
        </p>
        <form class="my-8" v-on:submit.prevent="" enctype="multipart/form-data">
            <div class="dataMa__date">
                <div class="dataMa__date--moment">
                    <label for="initial-date">{{ __('general.web.initial_date') }}</label>
                    <div>
                        <input
                            v-model="initialDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="initial-date"
                            type="date"
                            required
                            placeholder="Select date"
                        />
                    </div>
                </div>
                <div class="dataMa__date--moment">
                    <label for="end-date">{{ __('general.web.end_date') }}</label>
                    <div>
                        <input
                            v-model="endDate"
                            min="2022-04-01"
                            name="initial-date"
                            id="end-date"
                            type="date"
                            required
                            placeholder="Select date"
                        />
                    </div>
                </div>
            </div>
            <div class="dataMa__report">
                <select class="dataMa__options--select" v-model="reportOption">
                    <option value="">{{ __('general.web.data_management.select_report_type') }}</option>
                    <option value="most_visited">{{ __('general.web.data_management.most_visited_products') }}</option>
                    <option value="least_visited">
                        {{ __('general.web.data_management.least_visited_products') }}
                    </option>
                    <option value="best_selling_products">
                        {{ __('general.web.data_management.best_selling_products') }}
                    </option>
                    <option value="least_sold_products">
                        {{ __('general.web.data_management.least_sold_products') }}
                    </option>
                    <option value="abandoned_carts">{{ __('general.web.data_management.abandoned_carts') }}</option>
                    <option value="best_selling_categories">
                        {{ __('general.web.data_management.best_selling_categories') }}
                    </option>
                </select>
            </div>
            <div class="dataMa__buttonContainer">
                <button @click="generateReport">
                    <span>
                        {{ __('general.web.data_management.generate_report') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Reports.vue',

    data() {
        return {
            initialDate: '',
            endDate: '',
            reportOption: '',
            currentDate: new Date(),
        };
    },
    methods: {
        generateReport: function () {
            const config = {
                headers: {
                    'content-type': 'application/pdf',
                },
            };

            axios
                .get(
                    `/evertec/mercatodo/public/api/admin/reports?initial-date=${this.initialDate}&end-date=${this.endDate}&report-option=${this.reportOption}`,
                    config
                )
                .then((response) => {
                    alert(response.data.message);
                })
                .catch((error) => {
                    let messages = '';
                    let errors = error.response.data.errors;
                    Object.keys(errors).forEach(function (key) {
                        messages += '-' + errors[key] + '\n';
                    });
                    alert(messages);
                });
        },
    },
};
</script>
