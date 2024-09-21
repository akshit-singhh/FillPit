<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fillpit";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) 
{
    // Connection failed, display error message
    echo "Connection failed: " . mysqli_connect_error();
}
else
{
    // Connection successful
    echo "Connection successful!";
}

?>
