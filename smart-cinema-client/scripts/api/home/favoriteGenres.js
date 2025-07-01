import axios from "axios";

export async function getFavoriteGenres(userId) {
  try {
    const response = await axios.get(
      `http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users-profile/favorite-genres/index.php?user_profile_id=${userId}`
    );
    return response.data.favorite_genres || [];
  } catch (error) {
    console.error("Error fetching favorite genres:", error);
    throw new Error("Failed to load favorite genres.");
  }
}
