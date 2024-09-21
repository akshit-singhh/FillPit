<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change as necessary
$password = ""; // Change as necessary
$dbname = "fillpit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $landmark = isset($_POST['landmark']) ? $_POST['landmark'] : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';

    // Validate latitude and longitude
    $query = "INSERT INTO submissions (latitude, longitude) VALUES (?, ?)";

    // File upload (image handling)
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $image = $_FILES['imageUpload']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO submissions (description, landmark, latitude, longitude, image) 
                    VALUES ('$description', '$landmark', '$latitude', '$longitude', '$image')";

            if ($conn->query($sql) === TRUE) {
                echo "Submission successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Please upload an image.";
    }
}

$conn->close();
?>
