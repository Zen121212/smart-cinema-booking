import axios from "axios";
import { API_BASE_URL } from "../apiConfig.js";

function encodeData(data) {
  const params = new URLSearchParams();

  for (const key in data) {
    if (Array.isArray(data[key])) {
      data[key].forEach((val) => params.append(`${key}[]`, val));
    } else {
      params.append(key, data[key]);
    }
  }

  return params;
}

export async function updateUserProfile(updatedProfile) {
  try {
    const data = encodeData(updatedProfile);

    const response = await axios.post(
      `${API_BASE_URL}/users-profile/update.php`,
      data,
      {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      }
    );

    return response.data;
  } catch (error) {
    console.error("Error updating profile:", error);
    throw new Error(
      error.response?.data?.message || "Failed to update profile."
    );
  }
}
