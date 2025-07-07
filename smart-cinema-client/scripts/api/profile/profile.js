import axios from "axios";
import { API_BASE_URL } from "../apiConfig.js";

export async function getUserProfile(userId) {
  try {
    const response = await axios.get(`${API_BASE_URL}/user/profile/${userId}`);
    return response.data.payload;
  } catch (error) {
    console.error("Error fetching user profile data:", error);
  }
}
