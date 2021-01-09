<template>
  <main class="main-container">
    <h1>Les commandes</h1>
    <div class="filter-list">
      <div class="filter-list__title">Filtrer : </div>
      <div class="filter-list__content">
        <div class="filter">
          <select 
            class="filter__control select"
            v-model="filterBy"
            v-on:change="getOrderItemsBy"
          >
            <option value="date">Par date</option>
            <option value="price">Par prix</option>
            <option value="status">Par statut</option>
          </select>
        </div>
      </div>
    </div>
    <div class="card-list">
      <OrderLink
        v-for="order in orderData"
        v-bind:key="order.id"
        v-bind:orderId="order.id"
        v-bind:status="order.status"
        v-bind:price="order.price"
        v-bind:createdAt="order.createdAt"
        v-bind:orderLinesObject="order.orderLines"
        v-bind:customerObject="order.customer"
      />
    </div>
  </main>
</template>

<script>
import ApiClient from "@/services/ApiClient";
import OrderLink from "./OrderLink";

export default {
  name: "OrderList",
  components: {
    OrderLink
  },
  data() {
    return {
      orderData: [],
      filterBy: ''
    }
  },
  methods: {
    getOrderItems() {
      ApiClient.get("/orders")
        .then(response => {
          this.orderData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getOrderItemsBy() {
      if (this.filterBy === "date") {
        ApiClient.get("/ordersByDate")
          .then(response => {
            this.orderData = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      } else if (this.filterBy === "price") {
        ApiClient.get("/ordersByPrice")
          .then(response => {
            this.orderData = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      } else if (this.filterBy === "status") {
        ApiClient.get("/ordersByStatus")
          .then(response => {
            this.orderData = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  },
  mounted() {
    this.getOrderItems();
    console.log(this.filterBy);
  },
}
</script>

<style lang="scss">
.filter-list {
  margin: 1rem 0;

  &__title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    width: 100%;
  }

  &__content {
    align-items: flex-start;
    display: flex;
    flex-wrap: wrap;
  }
}
</style>