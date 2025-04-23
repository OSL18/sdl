<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $address = $_POST['address'];

    $sql = "INSERT INTO students (fullname, email, phone, dob, gender, course, address)
            VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$course', '$address')";

    if ($conn->query($sql)) {
        echo "<p style='color:green; text-align:center;'>Application submitted successfully!</p>";
        echo "<p style='text-align:center;'><a href='index.php'>Go Back</a></p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $conn->error . "</p>";
    }
}
?>
