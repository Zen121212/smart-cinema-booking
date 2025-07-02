import {
  fetchAllMovies,
  createMovie,
  deleteMovie,
} from "../../api/dashboard/getMovies.js";

document.addEventListener("DOMContentLoaded", () => {
  loadMovies();

  const form = document.getElementById("createMovieForm");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const movieData = Object.fromEntries(formData.entries());

    try {
      await createMovie(movieData);
      alert("Movie created successfully!");
      form.reset();
      loadMovies();
    } catch (error) {
      console.error(error);
      alert("Error creating movie.");
    }
  });
});

async function loadMovies() {
  try {
    const movies = await fetchAllMovies();
    renderMovies(movies);
  } catch (error) {
    console.error(error);
    alert("Error fetching movies.");
  }
}

function renderMovies(movies) {
  const grid = document.getElementById("moviesGrid");
  grid.innerHTML = "";

  movies.forEach((movie) => {
    const card = document.createElement("div");
    card.classList.add("movie-card");

    const randomImageUrl = `https://picsum.photos/seed/${encodeURIComponent(
      movie.title
    )}/300/200`;

    card.innerHTML = `
      <img src="${randomImageUrl}" alt="${movie.title}" />
      <h3>${movie.title}</h3>
      <p>${movie.description || "No description."}</p>
      <p><strong>Duration:</strong> ${movie.duration} mins</p>
      <p><strong>Release Date:</strong> ${movie.release_date || "N/A"}</p>
      <p><strong>Status:</strong> ${movie.status}</p>
      <button data-id="${movie.id}" class="delete-btn">Delete</button>
    `;

    const deleteBtn = card.querySelector(".delete-btn");
    deleteBtn.addEventListener("click", async () => {
      if (confirm(`Delete movie: ${movie.title}?`)) {
        try {
          await deleteMovie(movie.id);
          alert("Movie deleted.");
          loadMovies();
        } catch (error) {
          console.error(error);
          alert("Failed to delete movie.");
        }
      }
    });

    grid.appendChild(card);
  });
}
