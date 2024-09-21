<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fillpit";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    session_start(); // Start the session for storing user details after login

    if (isset($_POST['button-submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch the stored hashed password from the database for the entered email
        $query = "SELECT * FROM usersignup WHERE email = '$email'";
        $data = mysqli_query($conn, $query);

        // Check if the email exists in the database
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_assoc($data);
            $hashed_password = $row['password']; // The hashed password from the database

            // Use password_verify to check the entered password against the hashed password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, proceed to login
                echo "Login successful!";
                // You can now start a session or redirect the user to the dashboard
                $_SESSION['email'] = $email; // Example of setting a session variable
                header("Location: http://localhost:/fillpit/dashboard.html"); // Redirect after successful login
            } else {
                // Invalid password
                echo "Invalid password!";
            }
        } else {
            // Email does not exist
            echo "Email not found!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <form action="" method="POST" class="form">
    <div class="flex-column">
      <label>Email</label>
    </div>
    <div class="inputForm">
        <input type="text" class="input" name="email" placeholder="Enter your Email" required>
    </div>
    
    <div class="flex-column">
      <label>Password</label>
    </div>
    <div class="inputForm">
        <input type="password" class="input" name="password" placeholder="Enter your Password" required>
    </div>
    
    <div class="flex-row">
      <div>
        <input type="checkbox">
        <label>Remember me</label>
      </div>
      <span class="span">Forgot password?</span>
    </div>
    
    <button type="submit" name="button-submit" class="button-submit">Sign In</button>
    
    <p class="p">Don't have an account? <span class="span"><a href="signup.php">Sign Up</a></span></p>
    <p class="p line">Or With</p>

    <div class="flex-row">
      <button class="btn google">
        <svg version="1.1" width="20" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <path style="fill:#FBBB00;" d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
            c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
            C103.821,274.792,107.225,292.797,113.47,309.408z"></path>
          <path style="fill:#518EF8;" d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
            c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
            c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"></path>
          <path style="fill:#28B446;" d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
            c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
            c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"></path>
          <path style="fill:#F14336;" d="M419.404,58.066l-82.931,67.864c-22.762-14.536-50.391-22.932-79.808-22.932
            c-65.766,0-121.611,41.909-142.971,100.451L30.924,138.143h-0.014C73.337,57.393,158.968,0,256,0
            C318.115,0,375.068,22.126,419.404,58.066z"></path>
        </svg>
      </button>
      <button class="btn facebook">
        <svg viewBox="0 0 576 512" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.5 90.4 225.9 208 240v-167h-62v-73h62v-56.8c0-61.3 37.4-95.2 92.5-95.2c26.8 0 54.8 4.8 54.8 4.8v60h-30.9c-30.4 0-39.8 18.9-39.8 38.2V256h68l-11 73h-57v167c117.6-14.1 208-116.5 208-240z"></path></svg>
      </button>
      <button class="btn linkedin">
        <svg viewBox="0 0 1024 1024" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M511.6 0C229 0 0 228.9 0 511.6s229 511.6 511.6 511.6S1024 795.1 1024 511.6 794.2 0 511.6 0zM384.1 832H255.8V409.6h128.3V832zm-64.2-480.7h-.9c-43.1 0-70.9-29.5-70.9-66.3 0-37.5 28.6-66.3 72.6-66.3s71 28.7 71.9 66.3c0 36.8-27.9 66.3-72.7 66.3zm512 480.7H704.3V617.7c0-51.9-18.5-87.3-65.1-87.3-35.4 0-56.4 24-65.7 47.2-3.4 8.3-4.2 19.8-4.2 31.4V832H440.7s1.7-347.2 0-383.2h128.3v54.4c17.1-26.4 47.6-63.9 115.7-63.9 84.6 0 148 55.3 148 174.3V832z"></path></svg>
      </button>
    </div>
  </form>

  <script src="login.js"></script>
</body>
</html>
