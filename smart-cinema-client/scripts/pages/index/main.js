import { registerUser, loginUser } from "../../api/index/auth.js";
import { renderMovies } from "../../api/indexMovies.js";

const openSignInBtn = document.getElementById("openSignIn");
const openLoginBtn = document.getElementById("openLogin");
const signInPopup = document.getElementById("signInPopup");
const loginPopup = document.getElementById("loginPopup");

openSignInBtn?.addEventListener("click", () => {
  signInPopup.classList.add("active");
});

openLoginBtn?.addEventListener("click", () => {
  loginPopup.classList.add("active");
});

document.querySelectorAll(".close-btn").forEach((btn) => {
  btn.addEventListener("click", () => {
    const popupId = btn.getAttribute("data-close");
    document.getElementById(popupId)?.classList.remove("active");
  });
});

[signInPopup, loginPopup].forEach((popup) => {
  popup?.addEventListener("click", (e) => {
    if (e.target === popup) {
      popup.classList.remove("active");
    }
  });
});

document.getElementById("signInForm")?.addEventListener("submit", async (e) => {
  e.preventDefault();

  const name = document.getElementById("signInName").value.trim();
  const last_name = document.getElementById("signInLastName").value.trim();
  const email = document.getElementById("signInEmail").value.trim();
  const password = document.getElementById("signInPassword").value;

  if (!name || !last_name || !email || !password) {
    alert("Please fill all fields.");
    return;
  }

  try {
    const data = await registerUser({ name, last_name, email, password });

    if (data.success) {
      alert("Registration successful! Please log in.");
      signInPopup.classList.remove("active");
      document.getElementById("signInForm").reset();
    } else {
      alert("Registration failed: " + (data.message || "Unknown error"));
    }
  } catch (error) {
    console.error(error);
    alert("An error occurred during registration.");
  }
});

document.getElementById("loginForm")?.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("loginEmail").value.trim();
  const password = document.getElementById("loginPassword").value;

  if (!email || !password) {
    alert("Please fill all fields.");
    return;
  }

  try {
    const data = await loginUser({ email, password });

    if (data.success) {
      alert("Login successful! Welcome.");
      loginPopup.classList.remove("active");
      document.getElementById("loginForm").reset();
      localStorage.setItem("logged_in", JSON.stringify(data.user));
      window.location.href =
        "http://127.0.0.1:5500/smart-cinema-client/pages/home.html";
    } else {
      alert("Login failed: " + (data.message || "Invalid credentials"));
    }
  } catch (error) {
    console.error(error);
    alert("An error occurred during login.");
  }
});

renderMovies();
