# 🕳️ Fillpit – Pothole Reporting Web App

Fillpit is a web-based platform designed to empower citizens to report potholes on Indian roads. Users can upload pothole images along with location details, which are then sent to relevant authorities for review and repair. The project aims to bridge the communication gap between the public and road maintenance departments, helping create safer roads.

## 🌐 Live Demo
(If hosted, add link here. Otherwise, remove this section.)

## 📸 Features

- 📍 Upload real-time pothole images with live location.
- 📝 Collect personal and pothole details via an interactive form.
- 📊 Admin panel to view and manage all submissions.
- 🕵️ User history page to track their submissions.
- 🗺️ Map integration for accurate pothole location using Leaflet.js.
- 🔐 Login/Signup system with authentication.

## 💻 Tech Stack

| Layer       | Technologies Used                           |
|-------------|---------------------------------------------|
| Frontend    | HTML, CSS, JavaScript                       |
| Backend     | PHP                                         |
| Database    | MySQL (phpMyAdmin)                          |
| Maps        | Leaflet.js, OpenStreetMap                   |

## 📁 Project Structure

```bash
fillpit/
├── css/                  # Stylesheets
├── js/                   # JavaScript files
├── php/                  # Backend scripts (DB, logic, auth)
├── uploads/              # User-uploaded pothole images
├── index.html            # Homepage
├── dashboard.php         # Admin/user dashboard
├── history.php           # Submission history
└── ...


🚀 Getting Started
Prerequisites
XAMPP or any local server with Apache & MySQL

PHP 7.x+

A browser

Setup Instructions
1. Clone this repository:
git clone [https://github.com/your-username/Fillpit.git]

Move it to your XAMPP htdocs folder:
mv fillpit/ /xampp/htdocs/

Start Apache and MySQL via XAMPP.
Import the SQL file into phpMyAdmin:

Open localhost/phpmyadmin

Create a new database fillpit

Import the fillpit.sql file (included in repo)

Visit your site at:http://localhost/fillpit/

📦 Database Tables
usersignup
Stores user login credentials (email, password)

submissions
Stores pothole data: image, location, description, submission time

🙌 Contribution
Contributions are welcome! Feel free to fork the repo and submit a pull request.

📄 License
This project is open source under the MIT License.

Made with ❤️ in India 🇮🇳
