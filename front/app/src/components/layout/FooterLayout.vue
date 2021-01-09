<template>
  <footer class="footer">
    <nav class="nav">
      <router-link v-bind:to="{ name: 'home' }">Commandes</router-link>
      <router-link v-bind:to="{ name: 'products' }">Produits</router-link>
      <router-link v-if="userLoggedIn" v-bind:to="{ name: 'ordered' }">Commander</router-link>
      <router-link v-if="userLoggedOut" v-bind:to="{ name: 'login' }">Login</router-link>
    </nav>
  </footer>
</template>

<script>
export default {
  name: "FooterLayout",
  computed: {
    userLoggedIn() {
      return !!this.$store.state.user;
    },
    userLoggedOut() {
      return !this.userLoggedIn;
    }
  }
};
</script>

<style lang="scss">
@import "../../scss/colors";
.footer {
  position: fixed;
  width: 100%;
  background-color: $mainBackgroundColor;
  box-shadow: 0px 0px 10px rgba(20, 20, 20, 0.2);
  bottom: 0;

  .nav {
    align-items: center;
    display: flex;
    justify-content: space-around;
    padding: 1rem;

    a {
      font-weight: bold;
      color: #2c3e50;

      &.router-link-exact-active {
        color: #42b983;
      }
    }
  }
}
</style>