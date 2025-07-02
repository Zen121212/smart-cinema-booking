import { updateUserProfile } from "../../api/home/updateProfile.js";
import { createUserGenre } from "../../api/home/createFavoriteGenres.js";
import { saveUserPaymentMethods } from "../../api/home/createPayPrefrences.js";
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

  // loadProfile(user.id);
  UserPaymentMethods(user.id);
  setupEditGenre(userId);

  setupEditProfileForm(user.id);
  setupSignOut();
});

function setupEditProfileForm(userId) {
  document.getElementById("editProfileBtn").addEventListener("click", () => {
    document.getElementById("editProfileForm").style.display = "block";
  });

  document
    .getElementById("editProfileForm")
    .addEventListener("submit", async (e) => {
      e.preventDefault();

      const updatedProfile = { user_profile_id: userId };

      const username = document.getElementById("editUsername").value;
      if (username !== "") updatedProfile.user_profile_username = username;

      const name = document.getElementById("editName").value;
      if (name !== "") updatedProfile.user_profile_name = name;

      const lastName = document.getElementById("editLastName").value;
      if (lastName !== "") updatedProfile.user_profile_last_name = lastName;

      const phone = document.getElementById("editPhone").value;
      if (phone !== "") updatedProfile.phone = phone;

      const address = document.getElementById("editAddress").value;
      if (address !== "") updatedProfile.address = address;

      const bio = document.getElementById("editBio").value;
      if (bio !== "") updatedProfile.bio = bio;

      const avatar = document.getElementById("editAvatar").value;
      if (avatar !== "") updatedProfile.avatar_image = avatar;

      console.log(updatedProfile);

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
function setupEditGenre(userId) {
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
          user_profile_id: userId,
          favorite_genres: genreId,
        });
        console.log(`Genre ${genreId} saved:`, result);
        alert("Selected genre(s) saved.");
      } catch (error) {
        console.error(`Error saving genre ${genreId}:`, error);
      }
    }
  });
}

// PAYMENT PREFRENCE CREATE
function UserPaymentMethods(userId) {
  const paymentMethods = [
    {
      id: 1,
      name: "Visa",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/visa.svg",
    },
    {
      id: 2,
      name: "MasterCard",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/mastercard.svg",
    },
    {
      id: 3,
      name: "American Express",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/americanexpress.svg",
    },
    {
      id: 4,
      name: "Discover",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/discover.svg",
    },
    {
      id: 5,
      name: "PayPal",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/paypal.svg",
    },
    {
      id: 6,
      name: "Apple Pay",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/applepay.svg",
    },
    {
      id: 7,
      name: "Google Pay",
      icon: "https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/googlepay.svg",
    },
  ];

  const paymentMethodsContainer = document.querySelector(".payment-methods");
  const saveBtn = document.getElementById("saveBtn");

  let selectedMethods = new Set();

  paymentMethods.forEach((method) => {
    const card = document.createElement("div");
    card.className = "payment-card";
    card.dataset.id = method.id;

    card.innerHTML = `
    <img src="${method.icon}" alt="${method.name}">
    <span>${method.name}</span>
  `;

    card.addEventListener("click", () => {
      if (card.classList.contains("selected")) {
        card.classList.remove("selected");
        selectedMethods.delete(method.id);
      } else {
        card.classList.add("selected");
        selectedMethods.add(method.id);
      }
    });

    paymentMethodsContainer.appendChild(card);
  });

  saveBtn.addEventListener("click", async () => {
    for (const methodId of selectedMethods) {
      try {
        const result = await saveUserPaymentMethods({
          user_profile_id: userId,
          payment_methods: methodId,
        });
        console.log(`Payment method ${methodId} saved:`, result.data);
      } catch (error) {
        console.error(`Error saving payment method ${methodId}:`, error);
      }
    }

    alert("All selected payment methods processed.");
  });
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
