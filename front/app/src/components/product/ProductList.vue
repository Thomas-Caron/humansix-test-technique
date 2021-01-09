<template>
  <main class="main-container">
    <h1>Les produits</h1>
    <div class="card-list">
      <ProductLink
        v-for="product in productData"
        v-bind:key="product.id"
        v-bind:productId="product.id"
        v-bind:sku="product.sku"
        v-bind:name="product.name"
        v-bind:price="product.price"
      />
    </div>
  </main>
</template>

<script>
import ApiClient from "@/services/ApiClient";
import ProductLink from "./ProductLink";

export default {
  name: "ProductList",
  components: {
    ProductLink
  },
  data() {
    return {
      productData: []
    }
  },
  methods: {
    getProductItems() {
      ApiClient.get("/products")
        .then(response => {
          this.productData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.getProductItems();
  },
}
</script>

<style lang="scss">
</style>