import axios from "axios";

export async function getUserProfile(userId) {
  try {
    const response = await axios.get(
      `http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users-profile/index.php?user_profile_id=${userId}`
    );
    return response.data.user_profile;
  } catch (error) {
    console.error("Error fetching profile:", error);
    throw new Error("Failed to load user profile.");
  }
}
