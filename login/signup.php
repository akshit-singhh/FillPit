<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="signup.css">
    <script defer src="signup.js"></script>
</head>
<body>
    <form class="form" action="signup.php" method="POST">
        <div class="flex-column">
            <label for="email">Email</label>
        </div>
        <div class="inputForm">
            <input type="email" id="email" class="input" placeholder="Enter your Email" name="email" required>
        </div>
        
        <div class="flex-column">
            <label for="password">Password</label>
        </div>
        <div class="inputForm">
            <input type="password" id="password" class="input" placeholder="Enter your Password" name="password" required>
            <p id="password-error" class="error-message"></p>
        </div>
    
        <div class="flex-column">
            <label for="confirm-password">Confirm Password</label>
        </div>
        <div class="inputForm">
            <input type="password" id="confirm-password" class="input" placeholder="Confirm your Password" name="confirm-password" required>
        </div>
    
        <div class="progress-bar">
            <div id="progress-status"></div>
        </div>
    
        <button class="button-submit" type="submit" id="submit">Sign Up</button>
    
        <p class="p">Already have an account? <span class="span"><a href="login.php">Log In</a></span></p>
    </form>

    
    <?php
// Connect to the database
$servername = "localhost";
$username = "root";  // Update if necessary
$password = "";  // Update if necessary
$dbname = "fillpit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate password and confirm password
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Generate a unique user ID
    $user_id = 'FILLPIT_' . rand(1000, 9999); // Random number between 1000 and 9999

    // Prepare and bind the SQL statement to insert data into the usersignup table
    $stmt = $conn->prepare("INSERT INTO usersignup (user_id, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user_id, $email, $hashed_password);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Sign Up successful! Your User ID is " . $user_id . "');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>

</body>
</html>
