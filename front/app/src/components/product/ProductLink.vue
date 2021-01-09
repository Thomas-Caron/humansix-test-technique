<template>
    <article class="card">
    <router-link
      v-bind:to="{ name: 'single-product', params: { productSku: sku } }"
    >
      <h3>{{ name }}</h3>
      <ProductExcerpt
        v-bind:key="productId"
        v-bind:productId="productId"
        v-bind:sku="sku"
        v-bind:name="name"
        v-bind:price="price"
      />
    </router-link>
  </article>
</template>

<script>
import ProductExcerpt from "./ProductExcerpt";

export default {
  name: "ProductLink",
  components: {
    ProductExcerpt
  },
  props: {
    productId: {
        type: Number,
        required: true
    },
    sku: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    price: {
        type: Number,
        required: true
    }
  }
};
</script>

<style lang="scss">
</style>