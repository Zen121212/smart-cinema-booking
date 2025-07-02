import { getUserProfile } from "../../api/profile/profile.js";
import { getUserTickets } from "../../api/profile/tickets.js";
import { getFavoriteGenres } from "../../api/profile/favoriteGenres.js";
import { getWalletByUserId } from "../../api/profile/getWallet.js";
document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(localStorage.getItem("logged_in"));

  if (!user) {
    alert("Please log in first.");
    window.location.href = "/smart-cinema-client/index.html";
    return;
  }
  const userId = user.id;
  document.getElementById(
    "welcomeMessage"
  ).textContent = `Welcome ${user.name} to Smart Cinema`;

  loadProfile(user.id);
  loadTickets(user.id);
  loadFavoriteGenres(user.id);
  loadWallet(user.id);
  setupSignOut();
});

async function loadProfile(userId) {
  try {
    const profile = await getUserProfile(userId);
    document.getElementById("profileUsername").textContent =
      profile.user_profile_username;
    document.getElementById("profileName").textContent =
      profile.user_profile_name;
    document.getElementById("profileLastName").textContent =
      profile.user_profile_last_name;
    document.getElementById("profilePhone").textContent = profile.phone;
    document.getElementById("profileAddress").textContent = profile.address;
    document.getElementById("profileBio").textContent = profile.bio;
    console.log(profile);
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
    console.log(genres);
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

async function loadWallet(userId) {
  console.log(userId);
  try {
    const wallet = await getWalletByUserId(userId);
    console.log("wallet", wallet);
    if (!wallet) {
      document.getElementById("walletBalance").textContent =
        "No wallet information found.";
      return;
    }

    document.getElementById(
      "walletBalance"
    ).textContent = `${wallet.balance} ${wallet.currency}`;
  } catch (error) {
    console.error(error);
    document.getElementById("walletBalance").textContent =
      "Error loading wallet.";
  }
}

function setupSignOut() {
  document.getElementById("signOutBtn").addEventListener("click", () => {
    if (confirm("Are you sure you want to sign out?")) {
      localStorage.removeItem("logged_in");
      localStorage.removeItem("user_id");
      window.location.href = "/smart-cinema-client/index.html";
    }
  });
}
