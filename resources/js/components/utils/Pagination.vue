<template>
    <ul class="list-reset border border-grey-light rounded flex w-auto font-poppins font-bold">
        <li v-if="pagination.current_page > 1">
            <a
                class="border-r border-grey-light block cursor-pointer px-3 py-2 text-orangePantone hover:bg-orangePantone hover:text-white"
                @click.prevent="change(pagination.current_page - 1)"
            >
                {{ __('general.web.previous') }}
            </a>
        </li>
        <li v-for="page in pages" :key="page">
            <a
                :class="[
                    page == pagination.current_page
                        ? 'border-r border-orangePantone bg-orangePantone text-white'
                        : 'border-r border-grey-light text-orangePantone hover:bg-orangePantone hover:text-white',
                    'block px-3 py-2',
                ]"
                @click.stop="change(page)"
            >
                {{ page }}
            </a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <a
                class="block cursor-pointer px-3 py-2 text-orangePantone hover:bg-orangePantone hover:text-white"
                @click.prevent="change(pagination.current_page + 1)"
            >
                {{ __('general.web.next') }}
            </a>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'Pagination.vue',
    props: {
        pagination: {
            type: Object,
            required: true,
        },
        offset: {
            type: Number,
            default: 4,
        },
    },
    computed: {
        pages() {
            if (!this.pagination.to) {
                return null;
            }

            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            let pages = [];
            for (let page = from; page <= to; page++) {
                pages.push(page);
            }
            return pages;
        },
    },
    methods: {
        change: function (page) {
            this.pagination.current_page = page;
            this.$emit('paginate');
        },
    },
};
</script>
