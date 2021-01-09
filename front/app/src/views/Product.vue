<template>
  <ProductFull v-bind:productSku="productSku" />
</template>

<script>
import ProductFull from "@/components/product/ProductFull";

export default {
  name: "Product",
  components: {
    ProductFull
  },
  computed: {
    productSku() {
      return this.$route.params.productSku;
    }
  }
};
</script>