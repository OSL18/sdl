<?php
// db.php
$host = 'localhost';
$user = 'root';
$password = 'sahil';
$dbname = 'facebook_min';

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Database Connection Error: " . mysqli_connect_error());
}
?>