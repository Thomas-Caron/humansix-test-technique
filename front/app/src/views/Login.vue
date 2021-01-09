<template>
  <main class="main-container">
    <h1>Connexion</h1>
    <LoginForm />
  </main>
</template>

<script>
import LoginForm from "@/components/LoginForm";

export default {
  name: "Login",
  components: {
    LoginForm
  }
};
</script>