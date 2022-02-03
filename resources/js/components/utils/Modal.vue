<template>
    <div class="modal">
        <div class="modal__container">

            <div
                v-show="isVisible"
                class="modal__container--bg"
            >
                <div class="modal__content">
                    <div class="modal__content--header">
                        <h3 class="modal__content--title">
                            <slot name="title"></slot>
                        </h3>
                        <svg
                            @click="close()"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-orangePantone cursor-pointer"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>
                    <div>
                        <slot name="body"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
    name: "Modal.vue",

    props: {
        isVisible: Boolean,
    },

    emits: ['close'],
    methods: {

        close: function() {
            this.$emit('close')
        }
    },
}
</script>

