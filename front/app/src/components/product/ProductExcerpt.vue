<template>
    <div>
        <p>Référence : {{ sku }}</p>
        <p>Prix : {{ getFormatPrice }}</p>
    </div>
</template>

<script>

export default {
  name: "ProductExcerpt",
  computed: {
    getFormatPrice() {
        return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(this.price);
    }
  },
  props: {
    productId: {
        type: Number,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    price: {
        type: Number,
        required: true
    },
    sku: {
        type: String,
        required: true
    }
  }
};
</script>

<style lang="scss">
</style>