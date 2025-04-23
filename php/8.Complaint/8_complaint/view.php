
<?php
require 'db.php';

$sql = "SELECT * FROM complaints ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Complaints</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>All Complaints</h2>
  <a href="index.php">Submit New</a><br><br>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Submitted At</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['subject']; ?></td>
        <td><?= $row['message']; ?></td>
        <td><?= $row['submitted_at']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
