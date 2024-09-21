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
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="dashboard.html">Profile</a></li>
                    <li><a href="Submit/submit.html">Submit</a></li>
                    <li><a href="rewards.html">Rewards</a></li>
                    <li class="active"><a href="history.html">History</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="http://localhost/fillpit/login/adminlogin/admin.php">Logout</a>
            </div>
        </aside>

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
                        <th>ID</th>
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
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['landmark'] . "</td>";
                            echo "<td>Lat: " . $row['latitude'] . ", Long: " . $row['longitude'] . "</td>";
                            echo "<td><img src='Submit/uploads/" . $row['image'] . "' alt='Uploaded Image' class='thumbnail'></td>";
                            echo "<td>" . $row['submission_time'] . "</td>";
                            echo "<td><a href='Submit/uploads/" . $row['image'] . "' target='_blank'>View</a></td>";
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
