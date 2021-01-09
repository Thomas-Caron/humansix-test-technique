<template>
  <div id="app">
    <HeaderLayout />
    <router-view v-slot="{ Component }">
      <transition name="slide" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
    <FooterLayout />
  </div>
</template>

<script>
import HeaderLayout from "./components/layout/HeaderLayout";
import FooterLayout from "./components/layout/FooterLayout";

export default {
  name: "App",
  components: {
    HeaderLayout,
    FooterLayout
  },
  mounted() {
    if (sessionStorage.getItem("user")) {
      this.$store.state.user = JSON.parse(sessionStorage.getItem("user"));
    }
  }
};
</script>

<style lang="scss">
@import "./scss/main";
@import "./scss/colors";
@import "./scss/forms";
@import "./scss/card";
</style>

