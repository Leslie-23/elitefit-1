document.addEventListener("DOMContentLoaded", function () {
  console.log("EliteFit Gym - JavaScript Loaded!");

  // Handle form submission validation
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (event) {
      const password = document.querySelector(
        "input[name='user_password']"
      ).value;
      if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        event.preventDefault();
      }
    });
  }
});

function toggleSidebar() {
  document.querySelector(".sidebar").classList.toggle("collapsed");
}
