<template>
  <header class="header" v-bind:class="{ 'logo-only': userLoggedOut }">
    <div class="logo-container">
      <img class="logo" src="../../assets/humansix.png" alt="logo humansix" />
    </div>
    <div class="user" v-if="userLoggedIn">
      <span class="username">{{ userDisplayName }}</span>
      <img
        class="avatar"
        src="../../assets/avatar.png"
        v-on:click="toggleUserMenu()"
      />
      <transition name="fade">
        <div class="user-actions" v-show="userMenuVisible">
          <a v-on:click="disconnect">Déconnexion</a>
        </div>
      </transition>
    </div>
  </header>
</template>


<script>
export default {
  name: "HeaderLayout",
  data() {
    return {
      userMenuVisible: false
    };
  },
  methods: {
    toggleUserMenu() {
      this.userMenuVisible = !this.userMenuVisible;
    },
    disconnect() {
      this.$store.dispatch("disconnect");
      this.userMenuVisible = false;
      this.$router.push({ name: "login" });
    }
  },
  computed: {
    userLoggedIn() {
      return !!this.$store.state.user;
    },
    userLoggedOut() {
      return !this.userLoggedIn;
    },
    userDisplayName() {
      return this.$store.state.user.username;
    }
  }
};
</script>

<style lang="scss">
@import "../../scss/colors";
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  width: 100%;
  background-color: $primaryBackgroundColor;
  box-shadow: 0px 0px 10px rgba(20, 20, 20, 0.2);
  top: 0;
  padding-bottom: 1rem;
  line-height: 1;

  &.logo-only {
    justify-content: center;
  }

  .logo-container {
    display: flex;
    padding: 1rem;
    padding-bottom: 0;

    .logo {
      height: 2.4rem;
      vertical-align: middle;
    }
  }
}

.user {
  padding: 1rem;
  padding-bottom: 0;
  font-family: "Montserrat Bold", Arial;

  .user-badge {
    position: absolute;
    top: 1rem;
    right: 0.8rem;
  }

  .user-badge svg {
    fill: #306715;
  }

  .user-actions {
    position: fixed;
    right: 0rem;
    top: 3.5rem;
    background-color: $primaryStrongColor;
    padding: 1rem;
    box-shadow: 0px 0px 10px rgba(20, 20, 20, 0.2);

    a {
      display: block;
      line-height: 2;
      margin-bottom: 1rem;
      &:hover {
        cursor: pointer;
      }

      &:last-child {
        margin-bottom: 0;
      }
    }
  }
}

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

.user {
  text-align: center;

  .username {
    padding-right: 0.5rem;
  }

  .avatar {
    vertical-align: middle;
    display: inline-block;
    height: 2rem;
    width: 2rem;
    border-radius: 50px;
  }
}
</style>