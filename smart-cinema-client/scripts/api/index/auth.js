import axios from "axios";

function toUrlEncoded(obj) {
  const params = new URLSearchParams();
  for (const key in obj) {
    if (obj.hasOwnProperty(key)) {
      params.append(key, obj[key]);
    }
  }
  return params;
}

export async function registerUser(userData) {
  const data = toUrlEncoded(userData);
  const response = await axios.post(
    "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users/register.php",
    data,
    { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
  );
  return response.data;
}

export async function loginUser(credentials) {
  const data = toUrlEncoded(credentials);
  const response = await axios.post(
    "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/users/login.php",
    data,
    { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
  );
  return response.data;
}
