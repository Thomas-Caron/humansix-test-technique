<template>
  <main class="main-container">
    <form v-on:submit.prevent="onSubmit">
      <fieldset>
        <div class="field" v-bind:class="{ 'field--error': usernameError }">
          <label class="field__label">Nom d'utilisateur</label>
          <input
            class="field__input"
            type="text"
            placeholder="Votre nom d'utilisateur"
            v-model="username"
          />
        </div>
        <div class="field" v-bind:class="{ 'field--error': passwordError }">
          <label class="field__label">Mot de passe</label>
          <input
            class="field__input"
            type="password"
            placeholder="Votre mot de passe"
            v-model="password"
          />
        </div>
      </fieldset>
      <div class="alert error" v-if="errorMessage">{{ errorMessage }}</div>
      <button class="button">Connexion</button>
    </form>
  </main>
</template>

<script>
export default {
  name: "LoginForm",
  data() {
    return {
      username: "",
      password: "",
      usernameError: false,
      passwordError: false,
      errorMessage: ""
    }
  },
  methods: {
    onSubmit() {
      this.$store.dispatch(
        "connect",
        {
          username: this.username,
          password: this.password
        }
      )
      .then((response) => {
        if (!response) {
          this.errorMessage = "";
          if (!this.username) {
            this.errorMessage = "Le nom d'utilisateur doit être renseigné";
          } else if (!this.password) {
            this.errorMessage = "Le mot de passe doit être renseigné";
          } else {
            this.errorMessage = "Le nom d'utilisateur ou le mot de passe est incorrect";
          }
        } else {
          this.errorMessage = "";
          this.$router.push({ name: "home" });
        }
      })
      .catch(error => {
        console.log(error);
      });
    }
  }
}
</script>

<style lang="scss">
</style>