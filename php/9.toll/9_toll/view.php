<?php
require 'db.php';
$result = $conn->query("SELECT * FROM toll_records ORDER BY entry_time DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Toll Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Toll History</h2>
  <a href="index.php">← New Entry</a>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Vehicle No.</th>
      <th>Type</th>
      <th>Amount</th>
      <th>Entry Time</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['vehicle_number']; ?></td>
        <td><?= $row['vehicle_type']; ?></td>
        <td>₹<?= $row['toll_amount']; ?></td>
        <td><?= $row['entry_time']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
