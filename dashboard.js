// Chart.js for Appointment History Graph
const ctx = document.getElementById("submissionGraph").getContext("2d");
const chart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
    ],
    datasets: [
      {
        label: "Submitted",
        data: [5, 6, 10, 6, 8, 15, 6, 10],
        borderColor: "#22327c",
        backgroundColor: "rgba(34, 50, 124, 0.2)", // Add transparency to the background
        fill: true,
      },
    ],
  },
  options: {
    responsive: true,
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});

// Array of patient data
const patients = [
  {
    name: "Akshit Singh",
    age: 18,
    address: "Saharanpur",
    status: "Pending", // Changed from 'Status' to 'status'
    email: "test123@gmail.com",
    phone: "123-456-7890", // Added missing phone field
  },
  // Add more patient objects as needed
];

// Function to populate patient data in the table
function populatePatientTable() {
  const tableBody = document
    .getElementById("detailTable")
    .getElementsByTagName("tbody")[0];

  patients.forEach((patient) => {
    const newRow = tableBody.insertRow(); // Create a new row

    // Insert cells and assign values from the patient object
    const nameCell = newRow.insertCell(0);
    const ageCell = newRow.insertCell(1);
    const addressCell = newRow.insertCell(2);
    const statusCell = newRow.insertCell(3); // Changed from phoneCell to statusCell
    const emailCell = newRow.insertCell(4);
    const phoneCell = newRow.insertCell(5); // Added phoneCell for correct population

    nameCell.innerHTML = patient.name;
    ageCell.innerHTML = patient.age;
    addressCell.innerHTML = patient.address;
    statusCell.innerHTML = patient.status; // Correctly populate status
    emailCell.innerHTML = patient.email;
    phoneCell.innerHTML = patient.phone; // Populate phone number
  });
}

// Call the function to populate the table when the page loads
window.onload = populatePatientTable;

// Function to switch between pages
function switchPage(pageId) {
  // Hide all pages
  const pages = document.querySelectorAll(".page");
  pages.forEach((page) => {
    page.style.display = "none"; // Hide each page
  });

  // Show the selected page
  const activePage = document.getElementById(pageId);
  activePage.style.display = "block"; // Show the active page
}

// Function to update the active menu item (optional)
const menuItems = document.querySelectorAll(".menu ul li a");
menuItems.forEach((item) => {
  item.addEventListener("click", function () {
    menuItems.forEach((link) => link.parentElement.classList.remove("active")); // Remove active class
    this.parentElement.classList.add("active"); // Add active class to clicked item
  });
});
