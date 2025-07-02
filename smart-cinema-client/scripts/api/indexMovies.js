import axios from "axios";

async function fetchMovies() {
  const response = await axios.get(
    "http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/movies/index.php"
  );
  return response.data.movies;
}

export async function renderMovies() {
  try {
    const movies = await fetchMovies();

    const nowShowingGrid = document.getElementById("nowShowingGrid");
    const comingSoonGrid = document.getElementById("comingSoonGrid");

    nowShowingGrid.innerHTML = "";
    comingSoonGrid.innerHTML = "";

    movies.forEach((movie) => {
      const card = document.createElement("div");
      card.classList.add("movie-card-wrapper");
      const randomImageUrl = `https://picsum.photos/seed/${encodeURIComponent(
        movie.title
      )}/150/225`;
      card.innerHTML = `
      <img src="${randomImageUrl}" alt="${
        movie.title
      } Poster" class="movie-poster">
      <div class="movie-card">
        <h3>${movie.title}</h3>
        <p class="description">${
          movie.description || "No description available."
        }</p>
        <p class="duration"><strong>Duration:</strong> ${
          movie.duration
        } mins</p>
        <p class="release-date"><strong>Release:</strong> ${formatDate(
          movie.release_date
        )}</p>
        <span class="status ${movie.status}">
          ${formatStatus(movie.status)}
        </span>
      </div>
      `;

      if (movie.status === "on_showtime") {
        nowShowingGrid.appendChild(card);
      } else if (movie.status === "coming_soon") {
        comingSoonGrid.appendChild(card);
      }
    });
  } catch (error) {
    console.error(error);
  }
}

function formatStatus(status) {
  if (status === "on_showtime") return "Now Showing";
  if (status === "coming_soon") return "Coming Soon";
  return "Unknown";
}

function formatDate(dateString) {
  if (!dateString) return "N/A";
  const date = new Date(dateString);
  return date.toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}
