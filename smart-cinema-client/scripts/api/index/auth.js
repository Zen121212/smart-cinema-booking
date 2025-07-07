import axios from "axios";
import { API_BASE_URL } from "../apiConfig.js";

export async function registerUser(userData) {
  const response = await axios.post(`${API_BASE_URL}/register`, userData, {
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
  });
  return response.data;
}

export async function loginUser(credentials) {
  console.log(credentials);
  const response = await axios.post(`${API_BASE_URL}/login`, credentials, {
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
  });
  console.log(response);
  return response.data;
}
