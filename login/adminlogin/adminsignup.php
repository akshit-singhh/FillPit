<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fillpit"; // Use your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique userid
function generateUserId($conn) {
    $prefix = "FILL_ad";
    $unique = false;
    $userid = "";

    // Keep generating until a unique userid is found
    while (!$unique) {
        $randomNumber = rand(1000, 9999); // Generate a random 4-digit number
        $userid = $prefix . $randomNumber;

        // Check if the userid is already in use
        $checkQuery = "SELECT userid FROM adminsignup WHERE userid='$userid'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows == 0) {
            $unique = true;
        }
    }

    return $userid;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);

    // Check if passwords match
    if ($password === $confirmPassword) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Generate a unique userid
        $userid = generateUserId($conn);

        // Insert the new admin into the database
        $sql = "INSERT INTO adminsignup (userid, email, password) VALUES ('$userid', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "New admin created successfully with User ID: " . $userid;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Signup Page</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  <link rel="stylesheet" href="adminsignup.css">
</head>
<body>
<div class="screen-1">
  <svg class="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="300" height="300" viewbox="0 0 640 480" xml:space="preserve">
    <!-- Your existing SVG for the logo -->
  </svg>
  <div class="header">
    <h1>Admin Signup</h1>
  </div>
  <form method="POST" action="adminsignup.php">
    <div class="email">
      <label for="email">Email Address</label>
      <div class="sec-2">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="email" name="email" placeholder="Username@gmail.com" required />
      </div>
    </div>
    <div class="password">
      <label for="password">Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input class="pas" type="password" name="password" placeholder="············" required />
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <div class="password">
      <label for="confirm_password">Confirm Password</label>
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input class="pas" type="password" name="confirm_password" placeholder="············" required />
        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
      </div>
    </div>
    <button class="login" type="submit">Signup</button>
  </form>
  <div class="footer">
    <span>Already have an account? <a href="admin.php">Login</a></span>
  </div>
</div>
</body>
</html>
