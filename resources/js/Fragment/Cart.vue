<template>
 <!-- {{ $page.props.cart }}  -->
    <div class="mb-3" v-for="c in $page.props.cart" :key="c">
        <cart-item :post="c[0]" :pcount="c[1]" />
        {{c[0].title}}
    </div>
</template>
<script>
import CartItem from "@/Fragment/CartItem.vue"

export default {
    components:{
        CartItem
    }
}
</script>