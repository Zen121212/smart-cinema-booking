import axios from "axios";

const BASE_URL =
  "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/movies";

export async function fetchAllMovies() {
  const response = await axios.get(`${BASE_URL}/index.php`);
  return response.data.movies;
}

export async function createMovie(movieData) {
  const payload = new URLSearchParams(movieData).toString();

  const response = await axios.post(`${BASE_URL}/create.php`, payload, {
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  });
  return response.data;
}

export async function deleteMovie(id) {
  const payload = new URLSearchParams({ id }).toString();

  const response = await axios.post(`${BASE_URL}/delete.php`, payload, {
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
  });

  return response.data;
}
