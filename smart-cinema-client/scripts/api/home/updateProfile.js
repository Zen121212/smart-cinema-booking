import axios from "axios";

export async function updateUserProfile(updatedProfile) {
  try {
    const data = new URLSearchParams(updatedProfile).toString();

    const response = await axios.post(
      "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users-profile/update.php",
      data,
      {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
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
