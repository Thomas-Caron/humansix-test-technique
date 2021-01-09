<template>
  <main class="main-container">
    <h1>Commander</h1>
    <OrderForm />
  </main>
</template>

<script>
import OrderForm from "@/components/order/OrderForm";

export default {
  name: "Ordered",
  components: {
    OrderForm
  }
};
</script>