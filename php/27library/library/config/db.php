<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";      // Default for XAMPP
$dbname = "library"; // The database we created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
