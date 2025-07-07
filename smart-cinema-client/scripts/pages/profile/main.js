import { getUserProfile } from "../../api/profile/profile.js";

let userId;

document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(localStorage.getItem("logged_in"));

  if (!user) {
    alert("Please log in first.");
    window.location.href = "/smart-cinema-client/index.html";
    return;
  }
  userId = user.id;
  document.getElementById(
    "welcomeMessage"
  ).textContent = `Welcome ${user.name} to Smart Cinema`;
  loadUserData(userId);
  setupSignOut();
});

async function loadUserData(userId) {
  try {
    const data = await getUserProfile(userId);
    console.log(data);
    const profile = data || {};
    document.getElementById("profileUsername").textContent =
      profile.user_profile_username || "";
    document.getElementById("profileName").textContent =
      profile.user_profile_name || "";
    document.getElementById("profileLastName").textContent =
      profile.user_profile_last_name || "";
    document.getElementById("profilePhone").textContent = profile.phone || "";
    document.getElementById("profileAddress").textContent =
      profile.address || "";
    document.getElementById("profileBio").textContent = profile.bio || "";

    renderTickets(data.tickets || []);

    renderGenres(data.genres || []);

    if (data.wallet) {
      document.getElementById(
        "walletBalance"
      ).textContent = `${data.wallet.balance} ${data.wallet.currency}`;
    } else {
      document.getElementById("walletBalance").textContent =
        "No wallet information found.";
    }
  } catch (error) {
    console.error(error);
    alert(error.message);
  }
}

function renderTickets(tickets) {
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
}

function renderGenres(genres) {
  const listElement = document.getElementById("genre-list");
  const errorMsg = document.getElementById("error-message");
  errorMsg.textContent = "";
  listElement.innerHTML = "";
  if (genres.length === 0) {
    errorMsg.textContent = "This user has no favorite genres.";
    return;
  }
  genres.forEach((genre) => {
    const li = document.createElement("li");
    li.textContent = genre.name;
    listElement.appendChild(li);
  });
}

function setupSignOut() {
  document.getElementById("signOutBtn").addEventListener("click", () => {
    if (confirm("Are you sure you want to sign out?")) {
      localStorage.removeItem("logged_in");
      window.location.href = "/smart-cinema-client/index.html";
    }
  });
}
