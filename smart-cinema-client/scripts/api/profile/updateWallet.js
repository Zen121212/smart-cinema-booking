import axios from "axios";

function toUrlEncoded(obj) {
  const params = new URLSearchParams();
  for (const key in obj) {
    if (obj.hasOwnProperty(key)) {
      if (Array.isArray(obj[key])) {
        obj[key].forEach((val) => params.append(`${key}[]`, val));
      } else {
        params.append(key, obj[key]);
      }
    }
  }
  return params;
}

export async function addFundsToWallet(amount, userId) {
  try {
    const walletData = {
      user_id: userId,
      amount: parseFloat(amount),
      type: "credit",
    };

    console.log(walletData);

    const payload = toUrlEncoded(walletData);

    const response = await axios.post(
      "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/wallets/update.php",
      payload,
      {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }
    );

    return response.data;
  } catch (error) {
    console.error("Error adding funds:", error);
    throw new Error(error.response?.data?.message || "Failed to add funds.");
  }
}
