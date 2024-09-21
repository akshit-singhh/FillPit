document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".form");
  const emailInput = document.querySelector('input[type="text"]');
  const passwordInput = document.querySelector('input[type="password"]');
  
  form.addEventListener("submit", function (event) {
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    if (!email || !password) {
      event.preventDefault(); // Prevent form submission if fields are empty
      alert("Please fill in all fields."); // Show an alert to the user
    }
  });
});
// Check if there's a login message, and show it in a popup alert
