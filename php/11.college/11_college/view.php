<?php
require 'db.php';
$result = $conn->query("SELECT * FROM students ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admission Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Submitted Applications</h2>
  <a href="index.php">← Back to Form</a>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>DOB</th>
      <th>Gender</th>
      <th>Course</th>
      <th>Address</th>
      <th>Submitted At</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['dob'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td><?= $row['course'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['submitted_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
