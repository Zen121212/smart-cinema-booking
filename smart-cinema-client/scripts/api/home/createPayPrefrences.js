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

export async function saveUserPaymentMethods(data) {
  console.log(data);

  const payload = toUrlEncoded(data);
  const response = await axios.post(
    "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users-profile/payment-methods/create.php",
    payload,
    { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
  );
  return response.data;
}
