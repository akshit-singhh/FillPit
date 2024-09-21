<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";  // Add your password if needed
$dbname = "fillpit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the 'submissions' table
$sql = "SELECT `id`, `description`, `landmark`, `latitude`, `longitude`, `image`, `submission_time` FROM `submissions`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission History</title>
    <link rel="stylesheet" href="history.css">
    <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
  />
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav>
            <div class="logo-name">
              <div class="logo-image">
                <img src="9720009.jpg" alt="Logo Image" />
              </div>
              <span class="logo_name">FILLPIT Admin</span>
            </div>
      
            <div class="menu-items">
              <ul class="nav-links">
                <li>
                  <a href="panel.html">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                  </a>
                </li>
                <li>
                  <a href="history.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Submissions</span>
                  </a>
                </li>
                <li>
                  <a href="analytics.html">
                    <i class="uil uil-chart"></i>
                   <span class="link-name">Analytics</a></span
                    > 
                </li>
              </ul>
      
              <ul class="logout-mode">
                <li>
                  <a href="http://localhost/fillpit/login/adminlogin/admin.php">
                    <!-- Correct logout link -->
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                  </a>
                </li>
      
                <li class="mode">
                  <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                  </a>
      
                  <div class="mode-toggle">
                    <span class="switch"></span>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
<script>
     const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
</script>
        <!-- Main Content -->
        <section class="main-content">
            <!-- History Heading -->
            <div class="history-heading">
                <h1>Submission History</h1>
                <p>You have submitted <span id="total-requests">
                    <?php echo $result->num_rows; ?> <!-- Display number of requests -->
                </span> requests.</p>
            </div>

            <!-- History Table -->
            <table class="history-table">
                <thead>
                    <tr>
                        <th>USER_ID</th>
                        <th>Description</th>
                        <th>Landmark</th>
                        <th>Coordinates</th>
                        <th>Uploaded Image</th>
                        <th>Submission Date</th>
                        <th>View Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Loop through and output the data
                        while($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['landmark'] . "</td>";
                            echo "<td>Lat: " . $row['latitude'] . ", Long: " . $row['longitude'] . "</td>";
                            echo "<td><img src='Submit\uploads" . $row['image'] . "' alt='Uploaded Image' class='thumbnail'></td>";
                            echo "<td>" . $row['submission_time'] . "</td>";
                            echo "<td><a href='Submit\uploads" . $row['image'] . "' target='_blank'>View</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No submissions found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
