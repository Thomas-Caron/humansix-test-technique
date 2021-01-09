import { createStore } from "vuex";
import ApiClient from "@/services/ApiClient";

export default createStore({
  state: {
    user: null,
  },
  mutations: {
    authenticationSuccess(state, user) {
      state.user = user;
    },
    disconnectionSuccess(state) {
      state.user = null;
    }
  },
  actions: {
    connect(context, credentials) {
      let loginRequest = ApiClient.post(
        "/login",
        credentials
      )
        .then(response => {
          if (response.data.connected) {
            let user = response.data;
            sessionStorage.setItem("user", JSON.stringify(user));
            context.commit('authenticationSuccess', user);
          }
          return response;
        })
        .catch(error => {
          console.log(error);
        })
      return loginRequest;
    },
    disconnect(context) {
      sessionStorage.removeItem("user");
      context.commit("disconnectionSuccess");
    },
  }
});
