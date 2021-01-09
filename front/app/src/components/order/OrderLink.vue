<template>
  <article class="card">
    <router-link
      v-bind:to="{ name: 'single-order', params: { orderId: orderId } }"
    >
        <h2>Commande {{ orderId }}</h2>
        <OrderExcerpt
            v-bind:orderId="orderId"
            v-bind:status="status"
            v-bind:price="price"
            v-bind:createdAt="createdAt"
            v-bind:orderLinesObject="orderLinesObject"
            v-bind:customerObject="customerObject"
        />
    </router-link>
  </article>
</template>

<script>
import OrderExcerpt from "./OrderExcerpt";

export default {
  name: "OrderLink",
  components: {
      OrderExcerpt
  },
  props: {
    orderId: {
        type: Number,
        required: true
    },
    status: {
        type: String,
        required: true
    },
    price: {
        type: Number,
        required: true
    },
    createdAt: {
        type: String,
        required: true
    },
    orderLinesObject: {
        type: Object,
        required: true
    },
    customerObject: {
        type: Object,
        required: true
    }
  },
};
</script>

<style>
</style>
