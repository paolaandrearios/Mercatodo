<template>
    <div>
        <img
            width="288"
            height="360"
            class="object-contain rounded-lg mx-auto"
            :src="__asset(product.images())"
            alt="Product"
        />
        {{console.log(producto.image)}}
        <div class="text-xs md:text-sm font-semibold mt-4">{{product['name_' + __locale()]}}</div>
        <div class="text-xs md:text-sm text-gray-400">
            <span class="line-through mr-2"></span>
            <span class="text-black">{{__currencyFormat(product.price)}}</span>
        </div>
        <div class="flex justify-center">
            <button
                class="text-center text-xs md:text-sm font-bold border-2 border-gray-400 rounded-full mt-1 px-4 py-1 text-gray-400 hover:text-greenTem hover:border-greenTem focus:outline-none transition-color duration-300">
                {{__('general.web.see_more')}}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductCard.vue",
    props: {
        product: Object,
    }
}
</script>

