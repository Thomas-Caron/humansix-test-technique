<template>
  <main class="main-container">
    <h1>Commande {{ orderId }}</h1>
    <article class="card card-full">
      <OrderExcerpt
          v-bind:orderId="orderData.id"
          v-bind:customerObject="orderData.customer"
          v-bind:createdAt="orderData.createdAt"
          v-bind:status="orderData.status"
          v-bind:price="orderData.price"
          v-bind:orderLinesObject="orderData.orderLines"
      />
    </article>
  </main>
</template>

<script>
import ApiClient from "@/services/ApiClient";
import OrderExcerpt from "./OrderExcerpt";

export default {
  name: "OrderFull",
  components: {
      OrderExcerpt
  },
  data() {
    return {
      orderData: [],
    };
  },
  methods: {
    getOrderData() {
      ApiClient.get("/order/" + this.orderId)
        .then(response => {
          this.orderData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.getOrderData();
  },
  props: {
    orderId: {
      type: Number,
      required: true
    }
  }
};
</script>

<style lang="scss">
</style>