import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Products from "../views/Products.vue";
import Ordered from "../views/Ordered.vue";
import Login from "../views/Login.vue";
import Order from "../views/Order.vue";
import Product from "../views/Product.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/products",
    name: "products",
    component: Products
  },
  {
    path: "/ordered",
    name: "ordered",
    component: Ordered
  },
  {
    path: "/login",
    name: "login",
    component: Login
  },
  {
    path: "/order/:orderId",
    name: "single-order",
    component: Order
  },
  {
    path: "/product/:productSku",
    name: "single-product",
    component: Product
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
