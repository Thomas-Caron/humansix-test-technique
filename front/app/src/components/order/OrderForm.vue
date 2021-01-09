<template>
  <div>
    <section class="products">
      <div class="card product-list"
        v-for="product in productData"
        v-bind:key="product.id"
        v-bind:data-id="product.id"
      >
        <div class="excerpt">
          <p>{{ product.name }}</p>
          <p>{{  new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product.price) }}</p>
        </div>
        <div class="actions">
          <button 
            class="add"
            v-on:click="addProduct"
          >
            <img src="../../assets/add-to-cart.svg" alt="add cart">
            Ajouter au panier
          </button>
          <button 
            class="remove"
            v-on:click="removeProduct"
            style="display:none"
          >
            <img src="../../assets/remove-from-cart.svg" alt="remove cart">
            Retirer du panier
          </button>
        </div>
      </div>
    </section>

    <h2>Panier</h2>
    <section class="cart card">
      <table>
        <thead>
          <tr>
            <th>Article</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="product in cart"
            v-bind:key="product[0].id"
          >
            <td>{{ product[0].name }}</td>
            <td>{{ product[1].quantity }}</td> 
            <td>{{  new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(product[0].price * product[1].quantity) }}</td>
            <td></td>
          </tr>
        </tbody> 
        <tfoot>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Prix total : {{ calculateTotalPrice }}</td>
          </tr>
        </tfoot>   
      </table>
    </section>

    <h2>Informations</h2>
    <form v-on:submit.prevent="onSubmit">
      <fieldset>
        <div class="field">
          <label class="field__label">Prénom</label>
          <input
            class="field__input"
            type="text"
            placeholder="Votre prénom"
            v-model="firstname"
          />
        </div>
        <div class="field">
          <label class="field__label">Nom</label>
          <input
            class="field__input"
            type="text"
            placeholder="Votre nom"
            v-model="lastname"
          />
        </div>
      </fieldset>
      <button class="button">Envoyer votre commande</button>
    </form>
  </div>
</template>

<script>
import ApiClient from "@/services/ApiClient";

export default {
  name: "OrderForm",
  data() {
    return {
      productData: [],
      cart: [],
      totalPrice: 0,
      listPrice: [],
      firstname: "",
      lastname: ""
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
    },
    addProduct(event) {
      let productId = event.target.parentNode.parentNode.dataset.id;
      event.target.style.display = "none";
      event.target.parentNode.querySelector('.remove').style.display = "flex";
      this.cart.push([
        this.productData[productId - 1],
        {
          quantity: 1
        }
      ]);
      this.listPrice.push(this.productData[productId - 1].price);
    },
    removeProduct(event) {
      let productId = event.target.parentNode.parentNode.dataset.id;
      event.target.style.display = "none";
      event.target.parentNode.querySelector('.add').style.display = "flex";
      for (let i = 0; i < this.cart.length; i++) {
        if (this.cart[i][0].id == productId) {
          for(let j = 0; j < this.listPrice.length; j++) {
            if (this.listPrice[j] == this.cart[i][0].price) {
              this.listPrice.splice(j, 1);
            }
          }
          this.cart.splice(i, 1);
        }
      }
      if (this.listPrice.length == 0) {
        this.totalPrice = 0;
      }
    },
    onSubmit() {
      const orderLines = this.cart.map((product) => {
        return {
          quantity: product[1].quantity,
          product:  product[0].id
        }
      });
      const totalPrice = String(this.totalPrice);
      if (totalPrice && orderLines && this.firstname && this.lastname) {
        ApiClient.post(
          "/order",
          {
            "status": "processing",
            "price": totalPrice,
            "orderLines": orderLines,
            "customer": {
              "firstname": this.firstname,
              "lastname": this.lastname
            }
          }
        )
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
        this.$router.push({
          name: "home"
        })
      }
    }
  },
  computed: {
    calculateTotalPrice() {
      let totalPrice = 0;
      if (this.listPrice) {
        this.listPrice.map(price => (
            totalPrice += price,
            this.totalPrice = totalPrice
        ))
      }
      return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(this.totalPrice);
    }
  },
  mounted() {
    this.getProductItems();
  },
}
</script>

<style lang="scss">
@import "../../scss/colors";

.product-list {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  .excerpt {
    display: flex;
    flex: .5;
    p {
      margin: 0 1rem;
    }
  }
  .actions {
    display: flex;
    justify-content: flex-end;
    flex: .5;
    button {
      border: none;
      border-radius: 0.25rem;
      cursor: pointer;
      font-size: 1rem;
      padding: 0.5rem 1rem;
      margin: 0 .5rem;
      display: flex;
      align-items: center;
      transition: background .3s ease;
      &.add {
        background: $buttonAdd;
        &:hover {
          background: darken($buttonAdd, 10%);
        }
      }
      &.remove {
        background: $buttonRemove;
        &:hover {
          background: darken($buttonRemove, 10%);
        }
      }
      img {
        width: 1.5rem;
        margin-right: 1rem;
      }
    }
  }
}
.button {
  display: flex;
  flex: .5;
  margin: 0 auto;
}
.cart {
  margin-bottom: 2rem !important;
  table {
    width: 60%;
    margin: 0 auto;
    th, td {
      width: calc(100% / 4);
      text-align: center;
      line-height: 2;
    }
  }
}
form {
  width: 95%;
  margin: 1.5rem auto;
}
</style>