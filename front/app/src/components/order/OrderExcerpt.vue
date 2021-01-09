<template>
    <div>
        <section>
            <h3>Status : {{ status }}</h3>
            <p>Commande effectuée le {{ getFormatDate }}</p>
            <p>Par {{ getFirstNameAndLastName }}</p>
        </section>
        <section>
            <h3>Détail :</h3>
            <div 
                class="cart"
                v-for="orderLines in orderLinesObject"
                v-bind:key="orderLines.id"
            >
                <router-link
                    v-bind:to="{ name: 'single-product', params: { productSku: orderLines.product.sku } }"
                >
                    <p>{{ orderLines.product.name }}</p>
                    <p>Référence : {{ orderLines.product.sku }}</p>
                    <p>Prix : {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(orderLines.product.price) }}</p>
                    <p>Quantité : {{ orderLines.quantity }}</p>
                </router-link>
            </div>
        </section>
        <section>
            <h3>Prix total :</h3>
            <p>{{ getFormatPriceTotal }}</p>
        </section>
    </div>
</template>

<script>
import moment from 'moment';
import 'moment/locale/fr';

export default {
  name: "OrderExcerpt",
  computed: {
    getFormatDate() {
        return moment(this.createdAt).format('DD MMMM YYYY à HH:mm');
    },
    getFormatPriceTotal() {
        return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(this.price);
    },
    getFirstNameAndLastName() {
        if (this.customerObject) {
            return this.customerObject.firstname + " " + this.customerObject.lastname;
        }
        return ": non renseigné";
    }
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
  }
};
</script>

<style lang="scss">
.cart {
    &:not(last-of-type) {
        margin-bottom: .5rem;
    }
    p:first-of-type {
    text-decoration: underline;
    }
}
</style>
