import axios from "axios";

export async function getWalletByUserId(userId) {
  try {
    const response = await axios.post(
      "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/wallets/index.php",
      { user_id: userId },
      { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
    );
    console.log("hello", response.data);
    return response.data.wallet;
  } catch (error) {
    console.error("Error fetching wallet:", error);
    throw new Error("Failed to load wallet.");
  }
}
