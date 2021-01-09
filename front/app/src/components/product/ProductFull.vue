<template>
  <main class="main-container">
    <h1>{{ productData.name }}</h1>
    <article class="card card-full">
        <ProductExcerpt
            v-bind:key="productData.id"
            v-bind:productId="productData.id"
            v-bind:sku="productData.sku"
            v-bind:name="productData.name"
            v-bind:price="productData.price"
        />
    </article>
  </main>
</template>

<script>
import ApiClient from "@/services/ApiClient";
import ProductExcerpt from "./ProductExcerpt";

export default {
  name: "ProductFull",
  components: {
      ProductExcerpt
  },
  data() {
    return {
      productData: [],
    };
  },
  methods: {
    getProductData() {
      ApiClient.get("/product/" + this.productSku)
        .then(response => {
          this.productData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.getProductData();
  },
  props: {
    productSku: {
      type: String,
      required: true
    }
  }
};
</script>

<style lang="scss">
</style>