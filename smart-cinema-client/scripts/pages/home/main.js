import { getUserProfile } from "../../api/home/profile.js";
import { getUserTickets } from "../../api/home/tickets.js";
import { getFavoriteGenres } from "../../api/home/favoriteGenres.js";
import { updateUserProfile } from "../../api/home/updateProfile.js";
import { createUserGenre } from "../../api/home/createFavoriteGenres.js";
document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(localStorage.getItem("logged_in"));

  if (!user) {
    alert("Please log in first.");
    window.location.href = "/index.html";
    return;
  }

  document.getElementById(
    "welcomeMessage"
  ).textContent = `Welcome ${user.name} to Smart Cinema`;

  loadProfile(user.id);
  loadTickets(user.id);
  loadFavoriteGenres(user.id);

  setupEditProfileForm(user.id);
  setupSignOut();
});

async function loadProfile(userId) {
  try {
    const profile = await getUserProfile(userId);

    document.getElementById("avatarImage").src =
      profile.avatar_image || "default-avatar.png";
    document.getElementById("profileUsername").textContent =
      profile.user_profile_username;
    document.getElementById("profileEmail").textContent = profile.email;
    document.getElementById("profilePhone").textContent = profile.phone;
    document.getElementById("profileAddress").textContent = profile.address;
    document.getElementById("profileBio").textContent = profile.bio;

    // prefill edit form
    document.getElementById("editUsername").value =
      profile.user_profile_username;
    document.getElementById("editPhone").value = profile.phone;
    document.getElementById("editAddress").value = profile.address;
    document.getElementById("editBio").value = profile.bio;
    document.getElementById("editAvatar").value = profile.avatar_image;
  } catch (error) {
    console.error(error);
    alert(error.message);
  }
}

async function loadTickets(userId) {
  try {
    const tickets = await getUserTickets(userId);

    const ticketList = document.getElementById("ticketList");
    ticketList.innerHTML = "";

    if (tickets.length === 0) {
      ticketList.textContent = "No tickets booked yet.";
      return;
    }

    tickets.forEach((ticket) => {
      const li = document.createElement("li");
      li.textContent = `Ticket #${ticket.id} | Movie ID: ${ticket.movie_id} | Seat ID: ${ticket.seat_id} | Price: ${ticket.total_price} | Status: ${ticket.booking_status} | Date: ${ticket.purchase_date}`;
      ticketList.appendChild(li);
    });
  } catch (error) {
    document.getElementById("ticketList").textContent = error.message;
  }
}

async function loadFavoriteGenres(userId) {
  try {
    const genres = await getFavoriteGenres(userId);

    const listElement = document.getElementById("genre-list");
    listElement.innerHTML = "";

    if (genres.length === 0) {
      document.getElementById("error-message").textContent =
        "This user has no favorite genres.";
      return;
    }

    genres.forEach((genre) => {
      const li = document.createElement("li");
      li.textContent = genre.name;
      listElement.appendChild(li);
    });
  } catch (error) {
    document.getElementById("error-message").textContent = error.message;
  }
}

function setupEditProfileForm(userId) {
  document.getElementById("editProfileBtn").addEventListener("click", () => {
    document.getElementById("editProfileForm").style.display = "block";
  });

  document
    .getElementById("editProfileForm")
    .addEventListener("submit", async (e) => {
      e.preventDefault();

      const updatedProfile = {
        user_profile_id: userId,
        user_profile_username: document.getElementById("editUsername").value,
        phone: document.getElementById("editPhone").value,
        address: document.getElementById("editAddress").value,
        bio: document.getElementById("editBio").value,
        avatar_image: document.getElementById("editAvatar").value,
      };

      try {
        const result = await updateUserProfile(updatedProfile);

        if (result.success) {
          alert("Profile updated successfully!");
          window.location.reload();
        } else {
          alert(
            "Failed to update profile: " + (result.message || "Unknown error.")
          );
        }
      } catch (error) {
        alert(error.message);
      }
    });
}

// GENRES SELECT

const genreOptions = [
  { id: 1, name: "Action", color: "#e74c3c" },
  { id: 2, name: "Comedy", color: "#f1c40f" },
  { id: 3, name: "Drama", color: "#9b59b6" },
  { id: 4, name: "Horror", color: "#2c3e50" },
  { id: 5, name: "Science Fiction", color: "#16a085" },
  { id: 6, name: "Romance", color: "#e67e22" },
  { id: 7, name: "Documentary", color: "#34495e" },
  { id: 8, name: "Thriller", color: "#c0392b" },
  { id: 9, name: "Animation", color: "#2980b9" },
  { id: 10, name: "Adventure", color: "#27ae60" },
  { id: 11, name: "Fantasy", color: "#8e44ad" },
];

const dropdownButton = document.getElementById("dropdownButton");
const dropdownMenu = document.getElementById("dropdownMenu");
const saveGenresBtn = document.getElementById("saveGenresBtn");

const selectedGenres = new Set();

dropdownButton.addEventListener("click", () => {
  dropdownMenu.classList.toggle("show");
});

document.addEventListener("click", (event) => {
  if (
    !dropdownButton.contains(event.target) &&
    !dropdownMenu.contains(event.target)
  ) {
    dropdownMenu.classList.remove("show");
  }
});

genreOptions.forEach((genre) => {
  const label = document.createElement("label");
  label.innerHTML = `
    <input type="checkbox" value="${genre.id}"> ${genre.name}
  `;
  dropdownMenu.appendChild(label);
});

dropdownMenu.addEventListener("change", (e) => {
  const checkbox = e.target;
  const genreId = checkbox.value;
  console.log(genreId);

  if (checkbox.checked) {
    selectedGenres.add(genreId);
  } else {
    selectedGenres.delete(genreId);
  }
});

saveGenresBtn.addEventListener("click", async () => {
  if (selectedGenres.size === 0) {
    return;
  }
  console.log(selectedGenres);
  for (const genreId of selectedGenres) {
    try {
      const result = await createUserGenre({
        user_profile_id: 82,
        favorite_genres: genreId,
      });
      console.log(`Genre ${genreId} saved:`, result);
    } catch (error) {
      console.error(`Error saving genre ${genreId}:`, error);
    }
  }
});
function setupSignOut() {
  document.getElementById("signOutBtn").addEventListener("click", () => {
    if (confirm("Are you sure you want to sign out?")) {
      localStorage.removeItem("logged_in");
      localStorage.removeItem("user_id");
      window.location.href = "/index.html";
    }
  });
}
