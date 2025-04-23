<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $subject = $conn->real_escape_string($_POST['subject']);
  $message = $conn->real_escape_string($_POST['message']);

  $sql = "INSERT INTO complaints (name, email, subject, message)
          VALUES ('$name', '$email', '$subject', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "Complaint submitted successfully. <a href='index.php'>Back</a>";
  } else {
    echo "Error: " . $conn->error;
  }
}

$conn->close();
?>
