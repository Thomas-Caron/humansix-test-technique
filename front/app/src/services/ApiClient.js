import axios from "axios";

const ApiClient = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL
});

export default ApiClient;
