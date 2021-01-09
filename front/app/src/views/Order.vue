<template>
  <OrderFull v-bind:orderId="orderId" />
</template>

<script>
import OrderFull from "@/components/order/OrderFull";

export default {
  name: "Order",
  components: {
    OrderFull
  },
  computed: {
    orderId() {
      return parseInt(this.$route.params.orderId, 10);
    }
  }
};
</script>