<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$password = 'sahil';
$database = 'login_db';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>